<?php
session_start();

if (isset($_POST['username']) && isset($_POST['password'])) {
	if ($_POST['username'] != '' && $_POST['password'] !='') {
            
		include 'gebruiker.php';
		$db = new database();
		$gebruiker = new user($db);	
		$login = $gebruiker->Login($_POST['username'],$_POST['password']);
		if($login == FALSE) {
			header('Location: login.php');
		}elseif ($login == TRUE) {
			header('Location: controller.php?page=dashboard');
		}
	}else{
		header('Location: login.php');
	}
}

if (trim($_SESSION['username']) == FALSE) {
	header('Location: login.php');
}

//Haalt de juiste pagina's op
if(isset($_GET['Setting'])){
	
	include 'test.php';

	if($_GET['Setting'] =='Films'){
		include 'films.php';
	}elseif($_GET['Setting'] == 'User'){
		include'user.php';
	}elseif($_GET['Setting'] == 'Stoelen'){
		include'ticket.php';
	}
}

if(isset($_GET['page']))
{
    include 'test.php';
}

//Verwijdert films
if(isset($_GET['gebruiker'])){
	include 'film.php';
	$db = new database();
	$gebruiker = new filmpje($db);

	$verwijder = $gebruiker->Delete_film($_GET['gebruiker']);
	header('Location: test.php');
}

//haalt de film formulier op waarbij veranderingen kunnen doorgevoerd
if(isset($_GET['aanpassen'])){
	
	include 'test.php';
	include 'form.php'; 
} 

if(isset($_POST['Trailer']) or isset($_POST['Plot'])){
	
	include 'film.php';
	$db = new database();
	$gebruiker = new filmpje($db);
	
	if(!empty($_POST['Trailer']) and !empty($_POST['Plot'])){
		$update = $gebruiker->update_trailer_omschrijving($_GET['form1'],$_POST['Trailer'],$_POST['Plot']);
		header('Location: test.php ');
	}elseif(empty($_POST['Trailer']) AND !empty($_POST['Plot'])) {
		$update = $gebruiker->update_omschrijving($_GET['form1'],$_POST['Plot']);
		header('Location: test.php ');
	}elseif(empty($_POST['Plot']) AND !empty($_POST['Trailer'])) {
		$update = $gebruiker->update_Trailer($_GET['form1'],$_POST['Trailer']);
		header('Location: test.php ');
	}
}

if (isset($_POST['filmnaam']) and $_POST['filmnaam']!='') {
	include'film.php';
	$db = new database();
	$gebruiker = new filmpje($db);

	$filmnaam = urlencode($_POST["filmnaam"]);
	$QR="https://chart.googleapis.com/chart?cht=qr&chs=100x100&chl=$filmnaam";
	$get_film = $gebruiker ->zoek_films($filmnaam);
	$sla_op=$gebruiker->sla_op($get_film->Title,$get_film->Genre,$get_film->Actors,$get_film->Runtime,$get_film->Plot,$get_film->Poster,$get_film->Released,$QR);
	header('Location: test.php');
	}elseif (isset($_POST['filmnaam']) AND empty($_POST['filmnaam']))  {
		include 'test.php';
		echo "<div class='warning'><center>Vul een filmnaam in.</center></div>";
		include'add_film.php';	
	}


if (isset($_POST['ww']) and $_POST['ww'] !='') {
	
	include'gebruiker.php';
	$db = new database();
	$gebruiker = new user($db);

	$nieuw_ww=$gebruiker->change_ww($_POST['ww'], $_SESSION['id']);
	header('Location: test.php');
}elseif (isset($_POST['ww']) AND empty($_POST['ww'])) {
	include 'test.php';
	echo "<div class='warning'><center>Vul uw nieuw wachtwoord in.</center></div>";
	include'user.php';
}else{
 
}



?>