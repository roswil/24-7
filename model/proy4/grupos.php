<?php
include '../db/db.php';
require '../../libs/rest/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$slim_app = new \Slim\Slim();


$slim_app->get('/isLogin','isLogin');
$slim_app->get('/logout','logout');
$slim_app->get('/loadUsers','loadUsers');
$slim_app->get('/loadGrupos','loadGrupos');
$slim_app->get('/editGrupos/:uid','editGrupos');

$slim_app->post('/newUser','newUser');
$slim_app->post('/editUser','editUser');
$slim_app->get('/loadEditGrupos/:eid','loadEditGrupos');
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



function loadUsers() {
	$sql = "SELECT grupo_id as id,grupo_descripcion,grupo_imagen, grupo_estado FROM sa_grupos";
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
function loadGrupos() {
	$sql = "SELECT grupo_id as id,grupo_descripcion,grupo_imagen, grupo_estado FROM sa_grupos";
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

function loadEditGrupos($eid) {
	$sql = "SELECT grupo_id as id,grupo_descripcion,grupo_imagen, grupo_estado FROM sa_grupos WHERE grupo_id=:id";
	try {		
		//print_r($sql);
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

function editGrupos($uid)
{
	$request = \Slim\Slim::getInstance()->request();
	$produto = json_decode($request->getBody());
	$sql = "UPDATE sa_grupos SET grupo_descripcion=:grupo_descripcion,grupo_imagen=:grupo_imagen WHERE  grupo_id=:id";
	try {
	$db = getDB('mysql');
	$stmt = $db->prepare($sql);  
	$stmt->bindValue(':id', $uid);	
	$stmt->bindParam("grupo_descripcion",$update->grupo_descripcion);
	$stmt->bindParam("grupo_imagen",$update->grupo_imagen);
	$stmt->execute();
	$db = null;
			echo '{"status":'.$status.'}';
		} catch(PDOException $e) {		
			echo '{"error":{"text":'. $e->getMessage() .'}}'; 
		}

}
function editUser() {
	$request = \Slim\Slim::getInstance()->request();
	$update = json_decode($request->getBody());
	
	$sql = "UPDATE users SET name = :name, email = :email, mobile = :mobile WHERE id = :id";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $update->name);
		$stmt->bindParam("email", $update->email);
		$stmt->bindParam("mobile", $update->mobile);
		$stmt->bindParam("id", $update->id);		
		$status = $stmt->execute();	
		$db = null;
		echo '{"status":'.$status.'}';
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

function newUser() {
	$request = \Slim\Slim::getInstance()->request();
	$insert = json_decode($request->getBody());
	
	$sql = "INSERT INTO users (name, email, mobile) VALUES (:name, :email, :mobile)";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("name", $insert->name);
		$stmt->bindParam("email", $insert->email);
		$stmt->bindParam("mobile", $insert->mobile);		
		$status = $stmt->execute();	
		$db = null;
		echo '{"status":'.$status.'}';
	} catch(PDOException $e) {		
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}


?>
