<?php include 'homepage_header.php'?>
<div id="wrapper">

	<div id="search-results">
		<h1> Connect with others <?php echo $_GET['search'];?></h1>
    <?php include 'followRecommendationListElement.php'?>
	</div>

</div>
<?php
	/* Fetch all posts belonging to user and display */
?>
<?php include 'homepage_footer.php'?>
