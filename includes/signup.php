<?php 
	session_start();
	/* If already signed in, redirect to homepage */
	if (isset($_SESSION["user_id"])) {
		header("Location: includes/homepage.php");
	}

	if (isset($_GET["error"]) && $_GET["error"] == true) {
		echo 'A field in the form was left out';
	}

	if (isset($_GET["password_mismatch"]) && $_GET["password_mismatch"] == true) {
		echo 'Passwords do not match!';
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

				<form method="POST" action="includes/create_account.php">
					<li><input type="text" placeholder="First Name" id="firstname" name="first+name"><input type="text" placeholder="Surname" id="surname"></li>
					<li><input type="text" placeholder="Email address" name="email"></li>
					<li><input type="password" placeholder="New password" name="password"></li>
					<li><input type="password" placeholder="Re-enter password" name="password_reenter"></li>
					<p>Birthday</p>
					<li>
						<select name="day">
							<option>Day</option>
							<?php for ($i = 1; $i <= 31; $i++) : ?>
						        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php endfor; ?>
						</select>
						<select name="month">
							<option>Month</option>
							<?php for ($i = 1; $i <= 12; $i++) : ?>
						        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php endfor; ?>
						</select>
						<select name="year">
							<option>Year</option>
							<?php for ($i = 1900; $i <= date("Y"); $i++) : ?>
						        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
						    <?php endfor; ?>
						</select>
					</li>
					<li><input type="radio" name="male">Male <input type="radio" name="female">Female <br> <input type="radio" name="other">Other</li>
					<li><input type="submit" value="Create an account" name = "create"></li>
				</form>
				
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
