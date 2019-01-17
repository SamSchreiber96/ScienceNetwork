<?php include 'includes/header.php'; ?>
<?php include 'business/sql_query.php';

execute_query("SELECT * FROM Users;");

?>

<div id="content">
    <h3>Content</h3>

    <?php
    if(isset($_GET['about'])){
	include 'includes/about.php';
    }
    else if(isset($_GET['discussion'])){
    	 include 'includes/discussion.php';
    }
    ?>  
</div>

<?php include 'includes/footer.php'; ?>
