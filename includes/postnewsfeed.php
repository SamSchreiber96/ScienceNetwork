<script>
function post_method_changed() {
	var selected = document.getElementById("post_method").value;
	if (selected != "") {
		// update page parameter
		window.location.href = "homepage.php?post_method=" + selected;
	}
}
</script>
<div id="post">
		<h1>Your News Feed</h1>
		<br>
		<p id="create_post">Contribute to your News Feed</p>
		
		<br>

		<b>Select Type</b>
		<select name="post_method[]" id="post_method" value=post_method" onchange="post_method_changed(this)">
			<option value="none">--</option>
			<option value="Fact">Fun fact</option>
			<option value="Project">Project</option>
			<option value="Question">Question</option>
		</select>

<?php if(isset($_GET["post_method"]) && $_GET["post_method"] == "Fact") : ?>
			<form method="POST" action="homepage.php">
				<textarea id="story_txt" maxlength=1000 name="story_txt" rows="7" cols = 80></textarea>
			  <input id="story_submit" type="submit" value="Post Fact">

			</form>
<?php elseif(isset($_GET["post_method"]) && $_GET["post_method"] == "Question") : ?>
			<form method="POST" action="homepage.php">
				<textarea id="story_txt" maxlength=1000 name="story_txt" rows="7" cols = 80></textarea>
			  <input id="story_submit" type="submit" value="Post Question">
			</form>
<?php elseif(isset($_GET["post_method"]) && $_GET["post_method"] == "Project") : ?>
			<form method="POST" action="homepage.php">
				<textarea id="story_txt" maxlength=1000 name="story_txt" rows="7" cols = 80></textarea>
			  <input id="story_submit" type="submit" value="Post Project">
			</form>
<?php endif; ?>

<br>
<?php

print_r($_POST);
?>
</div>