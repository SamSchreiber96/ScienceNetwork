<?php
	session_start();
	if (!isset($_SESSION["user_id"])){
		header("Location: ../index.php");
		exit();
	}
	$user_id=$_SESSION['user_id'];
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">


<html>
	<head>
		<script src="../business/jQuery.js"></script>
	<link href="../style/homepage_style.css" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	</head>

	<body>
		<div id="header_wrapper">

		 <div id="header_left">
			 <ul id="tabs">
				<li id="sitename"><a href="homepage.php">SolTek</a></li>
			 	<li><a href="homepage.php">FEED</a></li>
				<li><a>QUESTIONS</a></li>
				<li><a>PROJECTS</a></li>
				<li>
					<a id="connect-button" href="connect.php">
					CONNECT
					</a>
				</li>

				<li>
					<a id="following-button" href="show_followings.php">
						FOLLOWING
					</a>
				</li>
			</ul>
			</div>

			<div id="header_right">
				<ul id="tabs">
				 	<li>
						 <input type="text" id="search" name="search" placeholder="Search..." list="suggestions">
						 <datalist id="suggestions" onselect="nameSelected()">
						 </datalist>
					 </li>

					 <li>
						 <a id="query-button">
							<i id="query-icon" type="button" class="fas fa-search">
							</i>
						</a>
					</li>

					<li>
						<a id="notification-bell">
							<i type="button" class="fas fa-bell"></i>
						</a>
					</li>

					<li>
						<a id="user-button">
							<i type="button" class="fas fa-user-circle"></i>
						</a>
					</li>
					<li>
						<a id="sign-out-button">
							<i type="button" class="fas fa-sign-out-alt"></i>
						</a>
					</li>
			 </ul>
		</div>
	</div>
		<br>
		<br>
		<br>
		<br>
		<br>

<script>

var nameSelected = function(event) {
	console.log("Select");
}

var showResultsForQuery = function(event) {
	console.log("connect");
	//window.location.href = "/includes/showSearchResults.php?" + "search=" + $('#search').val();
}

var handleQuery = function(event){
	var q = $('#search').val();
	var user_id='<?php echo $user_id ?>';
	var u='http://localhost:7080/api/users/' + user_id + '/searchforuser/' + q;
	$.ajax({
	 	url: u,
		type: 'GET',
		dataType: 'json',

		success: function(data) {
			console.log(data);
			$("#suggestions").empty();
			for (var i in data.response) {
				let name = data.response[i].name;
				let id = data.response[i].user_id;
				$("<option id='" + id + "'/>").html(name).appendTo("#suggestions");
			}
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});

}

$("input#search").keyup(handleQuery);
$("a#connect-button").click(showResultsForQuery);
$("#sign-out-button").click(()=>{
	window.location.href = "/includes/logout.php";
})


</script>
