<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // For debugging

include 'constants.php';


function execute_query($sql) {

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

if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "Username: " . $row["username"]. " Email: " . $row["email"]. "<br>";
}
} else {

echo "0 results";
}
$conn->close();



}
?>