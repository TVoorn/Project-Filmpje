<?php 
require '../model/functions.php';
get_header();

if(isset($_POST['bestelling_bevestigen'])){
    get_bestelling_betaald();
}else{
    get_bestelling();
}




get_footer();
?>