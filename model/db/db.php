<?php
function getDB($base) {
	switch ($base){
		case "mysql":
			$dbhost="pdp07";
			$dbuser="root";
			$dbpass="";
			$dbname="seguridad";
			$dbConnection = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);	
			$dbConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	        break;
		case "sqlserver":
	    break;
	}
	return $dbConnection;
}
?>