<?php
include __DIR__ . '/../business/database/Query.php';
error_reporting(E_ALL);
ini_set('display_errors', 1); // For debugging
$result = Query::execute_query("SELECT * FROM Users WHERE email='" . $_GET["email"] . "' AND password='" . $_GET["password"] . "';");

	/* If we have a result */
    if ($result->num_rows == 1){
    	session_start();
    	$row = $result->fetch_assoc();
    	$_SESSION["user_id"] = $row["user_id"];
    	$_SESSION["email"] = $row["email"];
    	$_SESSION["username"] = $row["username"];
    	$_SESSION["first_name"] = $row["first_name"];
    	$_SESSION["last_name"] = $row["last_name"];
    	$_SESSION["profile_picture_url"] = $row["profile_picture_url"];
    	/* Redirect to main application! */
    	header("Location: homepage.php");
	}else // Go back
    	header("Location: ../index.php?signin=false");

    exit();
?>
