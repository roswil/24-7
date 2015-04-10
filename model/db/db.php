<?php
function getDB($base) {
	switch ($base){
		case "mysql":
			$dbhost="localhost";
			$dbuser="root";
			$dbpass="";
			$dbname="ejemplo01";
			$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        break;
		case "sqlserver":
	    break;
	}
	switch ($base) {
		case 'mysql2':
			# code...
			break;
		
		default:
			# code...
			break;
	}
	return $dbConnection;
}
?>