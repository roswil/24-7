<?php
function getDB($base) {
	switch ($base){
		case "mysql":
			$dbhost="localhost";
			$dbuser="root";
			$dbpass="123456";
			$dbname="angularcode";
			$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	break;
		case "sqlserver":
			
	break;
	}
	return $dbConnection;
}
?>