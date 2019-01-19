<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); // For debugging

$activeUser = NULL;

include 'business/database/Query.php';
include 'business/database/ObjectLoader/UserLoader.php';

if(isset($_GET["login"])) {
    // Try to login
    // If cannot login, error msg
    $result = Query::areValidCredentials($_GET["email"], $_GET["password"]);
    if ($result->num_rows == 1){
       $activeUser = UserLoader::fetchUser($result->fetch_assoc()['user_id']);
}
    else
	echo 'Invalid login credentials';
}

if ($activeUser != NULL) {
   echo 'Welcome, User!';
}
include 'includes/homepage.php'; 
?>