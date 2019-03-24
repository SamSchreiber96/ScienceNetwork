<?php
	session_start();
	if (!isset($_SESSION["user_id"])){
		header("Location: ../index.php");
		exit();
	}
	$user_id=$_SESSION['user_id'];
?>
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<script src="utils.js"></script>


<html>
	<head id="hp_head">

		<script src="../business/jQuery.js"></script>
	<link href="../style/homepage_style.css" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"/>
	</head>

	<body>
		<div id="header_wrapper">
		 <div id="header">
			 <ul id="tabs">
				<li id="sitename"><a href="homepage.php"><img id="soltek_icon"></img></a></li>
			 	<li><a href="homepage.php" id="feed_button"><b>FEED</b></a></li>
				<li><a id="questions_button"><b>QUESTIONS</b></a></li>
				<li><a id="projects_button"><b>PROJECTS</b></a></li>
				<li>
					<a id="connect_button" href="connect.php">
					<b>CONNECT</b>
					</a>
				</li>

				<li>
					<a id="followings_button" href="show_followings.php">
						<b>FOLLOWINGS</b>
					</a>
				</li>
				 	<li>
						 <input autocomplete="off" type="text" id="search" name="search" placeholder="Search...">
					 	 </input>

						 <div id="dropdownList">
						 		<ul id="suggestions">
						 		</ul>
					 	 </div>


					 </li>

					 <li>
						 <a id="query-button">
							<i id="query-icon" class="fas fa-search">
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
							<img id = "user_icon"></img>
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

<script>

var fetchUserIcon = function() {
	let user_id = '<?php echo $user_id ?>';
	let url = 'http://localhost:7080/api/post/user/' + user_id + '/icon';
	let icon = document.getElementById("user_icon");
	icon.src=url;
}

var fetchUserIconForQueryElement = function(icon) {
	let url = 'http://localhost:7080/api/post/user/' + icon.id + '/icon';
	icon.src=url;
}

var fetchSoltekIcon = function() {
	let url = 'http://localhost:7080/api/post/soltek/icon/';
	console.log(url);
	let icon = document.getElementById("soltek_icon");
	icon.src=url;
}

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
				let li = document.createElement("li");
				let sublist = document.createElement("ul");

				let icon = document.createElement("img");
				let p = document.createElement("p");

				if (name == undefined) {
					name = data.response[i].first_name + ' ' + data.response[i].last_name;
				}
				p.innerHTML = name;
				p.id = "queryName";
				li.id = "queryRow";
				li.appendChild(p);
				icon.id = id;

				sublist.appendChild(icon);
				sublist.appendChild(p);

				li.appendChild(sublist);
				let list = document.getElementById("suggestions");
				list.appendChild(li);
				console.log(list);
				fetchUserIconForQueryElement(icon);

				//$("<li id='" + id + "'/>").html(name).appendTo("#suggestions");
			}
		},
		error: function(request, error) {
			console.log("Failure" + " " + error);
		}
	});

}

$("input#search").click(handleQuery);
$("input#search").keyup(handleQuery);
$("a#connect-button").click(showResultsForQuery);
$("#sign-out-button").click(()=>{
	window.location.href = "/includes/logout.php";
})
$("input#search").focusout(()=>{$("#suggestions").empty();});
fetchUserIcon();
fetchSoltekIcon();

</script>
