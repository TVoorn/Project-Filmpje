<div class="middle_col">
    <div class="inner_top">
	
	<div class="agenda_film">
		<h2>Film agenda</h2>
		<table id="agenda_tabel_film">
			<thead>
				<tr>
					<th>Naam</th>
					<th>Genre</th>
					<th>Datum</th>
					<th>Tijd</th>
					<th>Zaal</th>
					<th>Prijs</th>
					<th>Vrije plaatsen</th>
				</tr>
			</thead>
			<tbody>
				<?php get_agenda(); ?>
			</tbody>
		</table>
	</div>
	
        <h1 class="catering_header">Films</h1>
    </div>
    <div class="inner_bottom">
        <div class="text_rule">
        <div class="styled-select">
                    <form method="post" action="<?php echo WB_URL; ?>/films" enctype="multipart/form-data">
                        <select name="Naam" id="options" onchange="this.form.submit();">
                                <option value="Sorteer">Sorteer</option>
                                <option value="Naam">Naam</option>
                                <option value="Genre">Genre</option>
                                <option value="Tijd">Tijd</option>
                        </select>
                    </form>
        </div>
        <br />


	  <?php
//filmlijst
require '../model/film.php';
	$db = new database();
	$gebruiker = new filmpje($db);
	//hier worden alle films geladen
	$Naam = 'Naam';
	
	if(isset($_POST['Naam'])){
	
		$films = $gebruiker->sort_films($_POST['Naam']);
	}else{
		$films = $gebruiker->sort_films($Naam);
	}
?>
		
	<table class="bordered">
		<thead>
			<tr>
			<th>Poster</th>
			<th>Naam </th>
			<th>Genre</th>
			<th>Tijd</th>
			<th>QR</th>
		</thead>
			<?php foreach($films as $gebruiker) {
                        $filmnaam = $gebruiker['Naam'];
                                        $filmnaam = str_replace(' ', '%20', $filmnaam);
			echo'<tbody>';	
				echo '<tr>';
				echo '<td><a href="film/'.$filmnaam.'" title="Film"><img src="'.$gebruiker['Poster'].'" style="height:25%;" alt="Filmpje | plaatje"/></a></td>';
				echo '<td>'.$gebruiker['Naam'].'</td>
                                <td>'.$gebruiker['Genre'].'</td>
                                <td>'.$gebruiker['Tijd'].'</td>
                                <td><img src='.$gebruiker['QR'].' alt="FIlmpje | plaatje2" /></td>';
				
				echo '</tr>';
			echo'</tbody>';
			} ?>
		</table>
	  
  </div>
    </div>
</div> 