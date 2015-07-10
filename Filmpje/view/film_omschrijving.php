<?php 
require '../model/functions.php';
require '../model/film.php';
get_header();


	
$db = new database();
$gebruiker = new filmpje($db);
$film = $gebruiker->get_film($_GET['film']);	
echo $_GET['film'];
$filmnaam = $_GET['film'];
?>
<div class="filmcolum">
    <div class="left_inner_top">
        <h1 class="catering_header">Film <?php echo $film['Naam'];?></h1>
		
    </div>
    <div class="filmcolum_inner">
<?php
echo'<p>';
echo '<img src="'.$film['Poster'].'" style="height:250px;" alt="Filmpje | plaatje">'.$film['Youtube'].'<br /></p><p><div style="clear:both;"></div>';

echo 'Tijd'; echo $film['Tijd']; echo'<br />';
echo 'Actors'; echo $film['Actors']; echo'<br />';
echo 'Genre'; echo $film['Genre']; echo'<br />';
echo'</p><hr><p>';
echo $film['Plot'];

echo'</p>';


?>
 <div class="home_fast_ticker">
            <form method="post" action="<?php echo WB_URL; ?>/tickets" enctype="multipart/form-data">
                <p>Kies een Zaal:
                <select name="zaal">
                    <option value="1">Zaal 1</option>
                    <option value="2">Zaal 2</option>
                    <option value="3">Zaal 3</option>
                </select>
                &nbsp; &nbsp; &nbsp;
                Deze film draait in:
                <select name="plaats">
                    <option value="1">Rotterdam</option>
                </select>
                <input type="hidden" name="filmnaam" value="<?php echo $filmnaam; ?>"/>&nbsp; &nbsp; &nbsp;
                <input type="submit" name="Besteltickets" value="Koop tickets" class="koop_tickets"/></p>
            </form>
        </div>
</div>
</div>	
<?php get_footer();?>