


<?php
//filmlijst
include 'film.php';
	$db = new database();
	$gebruiker = new filmpje($db);
	//hier worden alle films geladen
	$Naam = 'Naam';
	
	if(isset($_GET['Naam'])){
	
		$films = $gebruiker->sort_films($_GET['Naam']);
	}else{
		$films = $gebruiker->sort_films($Naam);
	}
?>
	<div class="link-blocks">
	<table class="bordered">
		<thead>
			<tr>
			<th>Poster</th>
			<th>Naam </th>
			<th>Genre</th>
			<th>Tijd</th>
			<th>Wijzig</th>
			<th>Verwijder</th>
		</thead>
			<?php foreach($films as $gebruiker) {
			echo'<tbody>';	
				echo '<tr>';
				echo '<td><a href="film/'.$gebruiker['Naam'].'"><img src="'.$gebruiker['Poster'].'" height ="70px"></td>';
				echo '<td>'.$gebruiker['Naam'].'</td><td>'.$gebruiker['Genre'].'</td><td>'.$gebruiker['Tijd'].'</td><td><a href="controller.php?aanpassen='.$gebruiker['Id'].'">Wijzig</a></td><td><a href="controller.php?gebruiker='.$gebruiker['Id'].'">verwijder</a></td>';
				echo '</tr>';
			echo'</tbody>';
			} ?>
		</table>
		</div>