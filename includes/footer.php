<footer>

<?php if(isset($_GET['discussion'])): ?>
<form action="/index.php?discussion" method="get">
First name: <input type="text" name="fname"><br>
Last name: <input type="text" name="lname"><br>
<textarea name="comment" rows="5" cols="40"></textarea>		
<br>
<button type="submit" value="Submit">Submit</button>
</form>
<?php endif ?>
</footer>
</body>
</html>