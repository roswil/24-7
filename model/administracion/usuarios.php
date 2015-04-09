<?php
include '../db/db.php';
require '../../libs/rest/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$slim_app = new \Slim\Slim();

$slim_app->post('/doLogin','doLogin');
$slim_app->get('/isLogin','isLogin');
$slim_app->get('/logout','logout');
$slim_app->get('/listaUsuarios','listaUsuarios');


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
function listaUsuarios() {
	$sql = "SELECT id_usuario, usuario, concat(nombres,' ',paterno,' ',materno) as persona,
					clave
			FROM _bp_usuarios as u INNER JOIN _bp_personas as p ON p.id_persona=u.id_persona ";
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
?>
