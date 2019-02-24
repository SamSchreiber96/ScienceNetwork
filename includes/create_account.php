<?php
include __DIR__ . '/../business/database/Query.php';

error_reporting(E_ALL);
ini_set('display_errors', 1); // For debugging
	function allAreSet($items) {
		foreach ($items  as $item) {
			if (!isset($_POST[$item])) {
				//return false;
				echo $item . " is not set";
				return false;
			}
		}

		return true;
	}

	$items = array("first+name", "email", "password", "password_reenter", "month", "day", "year", "gender", "last+name");

	if (!allAreSet($items)){
		header("Location: ../index.php?error=true");
		exit();
	}


	if ($_POST["password"] != $_POST["password_reenter"]) {
		header("Location: ../index.php?password_mismatch=true");
		exit();
	}

	if (strlen($_POST["password"]) < 5){
		header("Location: ../index.php?password_short=true");
		exit();
	}

	// Ensure email does not exist yet
	if (Query::execute_query("SELECT * FROM Users WHERE email='" . $_POST["email"] . "'")->num_rows == 1){
		header("Location: ../index.php?email_taken=true");
		exit();
	}

	$user_id = substr(uniqid() . uniqid(), 0, 20);
	/* if there is a collision, get a new id */
	while (Query::execute_query("SELECT * FROM Users WHERE user_id='" . $user_id . "'")->num_rows == 1) {
		$user_id = substr(uniqid() . uniqid(), 0, 20);
	}

	$email = $_POST["email"];
	$username = $user_id;
	$password = $_POST["password"];
	$first_name = $_POST["first+name"];
	$last_name = $_POST["last+name"];
	$gender = $_POST["gender"];

	$birth_date = date('Y-m-d', strtotime($_POST["year"] . '-' . $_POST['month'] . '-' . $_POST['day']));

	$date_created = date('Y-m-d');

	//$sqlQuery = "INSERT INTO Users (user_id, email, username, password, first_name, last_name, gender, birth_date, date_created) VALUES('" . $user_id . "','" . $email . "','" . $username . "','" . $password . "','" . $first_name . "','" .      $last_name . "','" . $gender . "','" . $birth_date . "','"  . $date_created . "');";

	//Query::execute_query($sqlQuery);

	header("Location: login.php?email=" . $email . "&password=" . $password);
?>

<script>
var createAccount = function(){
	var user = [];
	user[user_id]='<?php echo $user_id ?>';
	user[email]='<?php echo $email ?>';
	user[username]='<?php echo $username ?>';
	user[password]='<?php echo $password ?>';
	user[first_name]='<?php echo $first_name ?>';
	user[last_name]='<?php echo $last_name ?>';
	user[gender]='<?php echo $gender ?>';
	user[birth_date]='<?php echo $birth_date ?>';
	user[date_created]='<?php echo $date_created ?>';
	console.log('create account');
	var u='http://localhost:7080/api/users/';
	$.ajax({
		url: u,
		type: 'POST',
		dataType: 'json',
		data: {'data': user},

		success: function(data) {
			console.log(data);
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});

}
</script>
