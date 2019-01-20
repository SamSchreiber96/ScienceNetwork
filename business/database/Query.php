<?php

error_reporting(E_ALL);
ini_set('display_errors', 1); // For debugging
include __DIR__ . '/../constants.php';
/*** Purpose: Add layer of abstraction to querying database ***/
class Query {

	public static function areValidCredentials($email, $password) {
	       return Query::execute_query("SELECT user_id FROM Users WHERE email='" . $email . "' AND 
	       				    password='" . $password . "';");
	}

	public static function execute_query($sql) {

		$servername = DBConstants::DATABASE_INTERNAL_IP;
		$username = DBConstants::DATABASE_ADMIN_USERNAME;
		$password = DBConstants::DATABASE_ADMIN_PASSWORD;
		$dbname = DBConstants::DATABASE_NAME;


		// Create connection

		$conn = new mysqli($servername, $username, $password, $dbname);

		// Check connection
		if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
		} 

		$result = $conn->query($sql);

		$conn->close();
		return $result;
	}

}
?>