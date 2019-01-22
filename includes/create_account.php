<?php
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

	$items = array("first+name", "email", "password", "password_reenter");

	if (!allAreSet($items))
		header("Location: ../index.php?error=true");


	/* For debugging */
	foreach ($_POST as $key => $value) {
		echo "Key: " . $key . " value: " . $value . "<br>"; 
	}

	if ($_POST["password"] != $_POST["password_reenter"]) 
		header("Location: ../index.php?password_mismatch=true");
?>