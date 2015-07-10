<?php 
if (!isset($_SESSION)) { 
	session_start(); 
	if (!isset($_SESSION['username'])) {
		header('Location: login.php');
	}
}


if (!isset($_POST['filmnaam']) and empty($_POST['filmnaam'])) {
	include'test.php';
}

?>
<form action ="controller.php" method="post">
<label for="Filmnaam">Gewenste film</label><input type="text" name="filmnaam" placeholder="Typ gewenste film" />
<input type="submit" />
</form>