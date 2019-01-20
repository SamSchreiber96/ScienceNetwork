<?php 
	session_start();
	if (!isset($_SESSION["user_id"]))
		header("Location: ../index.php");
?>

<html>
	<head>
	<link href="../style/homepage_style.css" type="text/css" rel="stylesheet"/>
	</head>

	<body>
		<div id="header_wrapper">
		 <div id="header">
			 <li id="sitename"><a href="index.php">Soltech</a></li>
			 <form action="logout.php">
				 <li><input type="submit" name="login" value="Log Out"></li>
			 </form>
			 <ul id="tabs">
			 	<li><a href="homepage.php">Home</a></li>
			 	<li> 
			 		<a href="homepage.php"><?php echo $_SESSION["first_name"]; ?></a>
			 	</li>
			 	
			 </ul>
			</div>
		</div>