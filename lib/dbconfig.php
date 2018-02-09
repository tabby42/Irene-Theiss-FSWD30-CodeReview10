<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'cr10_irene_theiss_biglibrary');

function openConnection (){
	$connection = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
	$connection->set_charset("utf8mb4");

	// Check connection
	if($connection === false){
	    die("ERROR: Could not connect. " . $mysqli->connect_error);
	} 
	return $connection;
}

?>