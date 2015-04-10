<?php
include_once '../db/db.php';
require '../../libs/rest/Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$slim_app = new \Slim\Slim();
/*
$slim_app->post('/doLogin','doLogin');
$slim_app->get('/isLogin','isLogin');
$slim_app->get('/logout','logout');
$slim_app->get('/loadUsers','loadUsers');
$slim_app->post('/newUser','newUser');
$slim_app->post('/editUser','editUser');
$slim_app->get('/loadEditUser/:eid','loadEditUser');
$slim_app->delete('/deleteUser/:did','deleteUser');

$slim_app->get('/listaGrupos/:id','listaGrupos');
$slim_app->get('/listarOpciones/:id','listarOpciones');
*/
$slim_app->get('/categories','categories'); 

$slim_app->run();

function reemplazarUrl($url){    
    $url = str_replace("../","",$url);
    $url = str_replace("/","|",$url);
    return ($url);
}

function categories() { 
    $db = getDB('mysql');
    //$rows = $db->select("categories","category cat_id,parent,description",array('parent'=>0),"ORDER BY description");
    $sql = "SELECT DISTINCT (gr.id_grupo) as id, gr.grupo 
                                    FROM _bp_accesos ac   
                                    INNER JOIN _bp_opciones op ON ac.id_opcion = op.id_opcion
                                    INNER JOIN _bp_grupos gr ON gr.id_grupo = op.id_grupo
                                    WHERE ac.id_rol = (SELECT id_usuario_rol FROM _bp_usuarios_roles 
                                    WHERE id_usuario ='1' ) and ac._estado ='A'";
	try {
		$a = array();
		$stmt = $db->prepare($sql);
        $stmt->execute($a);
        $rowss = $stmt->fetchAll(PDO::FETCH_ASSOC);
		$categories  = array();
		$rows["data"] = $rowss;
		foreach ($rows["data"] as $row) {
			$id_grupo = $row["id"];
			//consulta a grupos
			$sql2="SELECT distinct op.id_grupo, gr.grupo, op.id_opcion, op.opcion, op.contenido, op.imagen 
					FROM _bp_accesos ac
			            INNER JOIN _bp_opciones op  ON ac.id_opcion = op.id_opcion 
			            INNER JOIN _bp_grupos gr ON gr.id_grupo = op.id_grupo
			            WHERE ac.id_rol = (	SELECT id_usuario_rol 
			            FROM _bp_usuarios_roles
			            WHERE id_usuario_rol = '1') AND ac._estado = 'A' 
			            and op._estado = 'A' and op.id_grupo=$id_grupo order by gr.grupo";
			$b = array();
			$stmts = $db->prepare($sql2);
	        $stmts->execute($b);
	        $rowsss = $stmts->fetchAll(PDO::FETCH_ASSOC);
			$category = array();
			//$userss = $crs->fetchAll(PDO::FETCH_OBJ);
			$cr["data"] = $rowsss;
	        $category["id_grupo"] = $row["id"];
	        $category["grupo"] = $row["grupo"];
	        $category["sub_categories"] = array(); // subcategories again an array
	        foreach ($cr["data"] as $srow) {
	        	$subcat = array(); // temp array
	            $subcat["id_opcion"] = $srow['id_opcion'];
	            $subcat["opcion"] = $srow['opcion'];
                $subcat["contenido"] = reemplazarUrl($srow['contenido']);
	            // pushing sub category into subcategories node
	            array_push($category["sub_categories"], $subcat);
	        }
			array_push($categories, $category);
		}
		$db = null;
		echo json_encode($categories);
	} catch(PDOException $e) {
	    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

/*
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

function loadEditUser($eid) {
	$sql = "SELECT id,name,email,mobile FROM users WHERE id=:id";
	try {		
		$db = getDB();		
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
function listaGrupos($id) {
	$sql = "SELECT DISTINCT (gr.id_grupo) as id, gr.grupo 
                                    FROM _bp_accesos ac   
                                    INNER JOIN _bp_opciones op ON ac.id_opcion = op.id_opcion
                                    INNER JOIN _bp_grupos gr ON gr.id_grupo = op.id_grupo
                                    WHERE ac.id_rol = (SELECT id_usuario_rol FROM _bp_usuarios_roles 
                                    WHERE id_usuario ='$id' ) and ac._estado ='A'";
	try {
		$db = getDB('mysql');		
		$stmt = $db->query($sql);
		//$stmt->bindValue(':id', $id);

		//$stmt->execute();
		$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);		
		$db = null;
		echo json_encode($rows);
	} catch(PDOException $e) {
	    echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}
function listarOpciones($id) {
	$sql = "SELECT gr.id_grupo, gr.grupo, op.id_opcion, op.opcion,                                                         
            op.contenido, op.imagen FROM _bp_accesos ac
            INNER JOIN _bp_opciones op  ON ac.id_opcion = op.id_opcion 
            INNER JOIN _bp_grupos gr ON gr.id_grupo = op.id_grupo
            WHERE ac.id_rol = (	SELECT id_usuario_rol 
            FROM _bp_usuarios_roles
            WHERE id_usuario_rol = '$id') AND ac._estado = 'A' 
            and op._estado = 'A'";
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
*/


?>
