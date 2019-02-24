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
	</head>

	<body>
		<div id="header_wrapper">
		 <div id="header">
			 <li id="sitename"><a href="homepage.php">Soltek</a></li>
			 <ul id="tabs">
			 	<li><a href="homepage.php">Home</a></li>
			 	<li>
			 		<a href="homepage.php"><?php echo $_SESSION["first_name"]; ?></a>
			 	</li>
			 	<li>
			 		<form id="search-query">
					 <input type="text" id="search" name="search" placeholder="Search..." list="suggestions">
					 <datalist id="suggestions" onselect="nameSelected()">
					 </datalist>

					</form>
				 </li>

				 <li>
					 <a id="query-button">
						<i type="button" class="fa fa-search">
						</i>
					</a>
				</li>

			 </ul>
			  <form id="logout" action="logout.php">
				 <li><input type="submit" name="logout" value="Log Out"></li>
			 </form>
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
	window.location.href = "/includes/showSearchResults.php?" + "search=" + $('#search').val();
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
$("a#query-button").click(showResultsForQuery);


</script>
