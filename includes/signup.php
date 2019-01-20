<?php 
	session_start();
	/* If already signed in, redirect to homepage */
	if (isset($_SESSION["user_id"])) {
		header("Location: includes/homepage.php");
	}
?>
<html>
	<head>
	<link href="/style/signup_style.css" type="text/css" rel="stylesheet"/>
	</head>
	<body>

		<div id="header_wrapper">
		 <div id="header">
			 <li id="sitename"><a href="index.php">Soltech</a></li>
			 <form action="includes/login.php">
				 <li>Email<br><input type="text" name="email"></li>
				 <li>Password<br><input type="password" name="password"><br><a href="">Forgotten account?</a></li>
				 <li><input type="submit" name="login" value="Log In"></li>
			 </form>
			 <?php 
				 if (isset($_GET["signin"]) && $_GET["signin"] == "false")
				 	echo 'Failed to sign in';
				 ?>
			 </div>
			</div>

			<div id="wrapper">

			<div id="div2">
				<h1>Create an account</h1>
				<p>Don't wory, it's free!</p>
				<li><input type="text" placeholder="First Name" id="firstname"><input type="text" placeholder="Surname" id="surname"></li>
				<li><input type="text" placeholder="Email address"></li>
				<li><input type="password" placeholder="New password"></li>
				<li><input type="password" placeholder="Re-enter password"></li>
				<p>Birthday</p>
				<li>
					<select><option>Day</option></select>
					<select><option>Month</option></select>
					<select><option>Year</option></select>
				</li>
				<li><input type="radio">Male <input type="radio">Female <br> <input type="radio">Other</li>
				<li><input type="submit" value="Create an account"></li>
				
			</div>

			</div>

			<div id="footer_wrapper">

			<div id="footer1">

			</div>
			<div id="footer2">

		</div>

		</div>
	</body>
</html>
