<?php
include '../db/db.php';
require '../../libs/rest/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$slim_app = new \Slim\Slim();

$slim_app->post('/doLogin','doLogin');
$slim_app->get('/isLogin','isLogin');
$slim_app->get('/logout','logout');
$slim_app->get('/loadUsers','loadUsers');
$slim_app->get('/listaAnimales','listaAnimales');
$slim_app->post('/nuevoAnimal','nuevoAnimal');
$slim_app->post('/editAnimales','editAnimales');
$slim_app->get('/CargarAnimal/:eid','CargarAnimal');
$slim_app->delete('/deleteUser/:did','deleteUser');


$slim_app->run();

function isLogin() {
	session_start();
	if(isset($_SESSION['username']) && !empty($_SESSION['username']))
		echo '{"isLogin": true}';
	else
		echo '{"isLogin": false}';
}
function logout() {
	session_start();
	session_destroy();
}
function dd(){
	echo "hola mundo";
}
function doLogin() {
	$request = \Slim\Slim::getInstance()->request();
	$update = json_decode($request->getBody());	
	
	try {
		$db = getDB();		
		$stmt = $db->prepare("SELECT * FROM admin WHERE username=:username1 AND password=:password1");
		$stmt->bindValue(':username1', $update->username, PDO::PARAM_INT);
		$stmt->bindValue(':password1', $update->password, PDO::PARAM_STR);
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);		
		$db = null;
		
		if(count($rows)) {			
			session_start();
			$_SESSION['username'] =  $update->username;
			echo '{"status": "success"}';
		}
		else
			echo '{"status": "failed"}';
	} catch(PDOException $e) {	    
		echo '{"error":{"msg":'. $e->getMessage() .'}}'; 
	}
	
}

function loadUsers() {
	$sql = "SELECT uid as id,name,email, phone as mobile FROM customers_auth ORDER BY uid asc";
	try {
		$db = getDB('mysql');
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($users);
		
	} catch(PDOException $e) {
	    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function listaAnimales() {
	$sql = "SELECT ANIMAL_ID, ANIMAL_NOMBRE, ANIMAL_RAZA, ANIMAL_COLOR, ANIMAL_REGISTRO, ANIMAL_MODIFICACION, ANIMAL_USUARIO, ANIMAL_ESTADO 
			FROM animales ";
	try {
		$db = getDB('mysql');
		$stmt = $db->query($sql);  
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($users);
		
	} catch(PDOException $e) {
	    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteUser($did) {   
	$sql = "DELETE FROM users WHERE id=:delete_id";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("delete_id", $did);
		$stmt->execute();
		$db = null;
		//echo true;
		loadUsers();
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}	
}

function nuevoAnimal() {
	
	$request = \Slim\Slim::getInstance()->request();
	$insert = json_decode($request->getBody());
	
	$sql = "INSERT INTO animales (ANIMAL_NOMBRE, ANIMAL_RAZA, ANIMAL_COLOR, ANIMAL_REGISTRO, ANIMAL_MODIFICACION, ANIMAL_USUARIO, ANIMAL_ESTADO) 
			VALUES (:nombre, :raza, :color,curdate(),curdate(),'admin','ACTIVO')";
			
	try {
		$db = getDB('mysql');
		$stmt = $db->prepare($sql); 
		$stmt->bindParam("nombre", $insert->ANIMAL_NOMBRE);
		$stmt->bindParam("color", $insert->ANIMAL_COLOR);
		$stmt->bindParam("raza", $insert->ANIMAL_RAZA);
			

		$status = $stmt->execute();	
		$db = null;
		echo '{"status":'.$status.'}';
	} catch(PDOException $e) {		
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function CargarAnimal($eid) {
	$sql = "SELECT ANIMAL_ID, ANIMAL_NOMBRE, ANIMAL_RAZA, ANIMAL_COLOR FROM animales WHERE ANIMAL_ID=:id";
	try {		
		$db = getDB('mysql');		
		$stmt = $db->prepare($sql);
		$stmt->bindValue(':id', $eid);		
		$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);		
		$db = null;
		echo json_encode($rows);
	} catch(PDOException $e) {
	    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function editAnimales() {
	$request = \Slim\Slim::getInstance()->request();
	$update = json_decode($request->getBody());
	
	$sql = "UPDATE animales SET ANIMAL_NOMBRE = :nombre, ANIMAL_RAZA = :raza, ANIMAL_COLOR = :color WHERE ANIMAL_ID = :id";
	print_r($sql);
	try {
		$db = getDB('mysql');
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("nombre", $update->ANIMAL_NOMBRE);
		$stmt->bindParam("color", $update->ANIMAL_COLOR);
		$stmt->bindParam("raza", $update->ANIMAL_RAZA);
		$stmt->bindParam("id", $update->id);		
		$status = $stmt->execute();	
		$db = null;
		echo '{"status":'.$status.'}';
	} catch(PDOException $e) {		
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
?>
