<?php 

include "../model/config.php";

function get_header(){
    include "../view/header.tpl";
}

function get_footer(){
    include "../view/footer.tpl";
}

function get_slider(){
    include "../view/slider.tpl";
}

function get_home(){
    include "../view/home.tpl";
}

function get_tickets(){
    include "../view/tickets.tpl";
}

function get_catering(){
    include "../view/catering.tpl";
}

function get_acties(){
    include "../view/acties.tpl";
}

function get_films(){
    include "../view/films.tpl";
}

function get_bestelling_overzicht(){
    include "../view/bestelling.tpl";
}

function get_over_flimpje(){
    include "../view/over-filmpje.tpl";
}

function get_contact_information(){
    include "../view/contact-informatie.tpl";
}

function get_contact_form(){
    include "../view/contact-formulier.tpl";
}

function get_bestelling(){
    
   if($_POST['bestelling_bekijken']){
      echo'<div class="white"><div class="padding_10">'; 
         $stoelen = $_POST['stoelen'];
         $filmnaam = $_POST['filmnaam'];
         $tijd = $_POST['tijd']; 
         $totaal = '';

         $query_for_pic = mysql_fetch_array(mysql_query("SELECT * FROM films WHERE Naam='$filmnaam'"));
         $film_link = $query_for_pic['Poster'];
         if(!$stoelen){
            ?>
            <script type="text/javascript">
            alert('Het is niet toegestaan om geen stoelen te bekijken');
            window.history.back();
            </script>
            <?php       
         } else {
         echo'<p>&nbsp;</p>
             <p>Uw heeft gekozen voor de film '.$filmnaam.' om '.$tijd.' uur in Rotterdam.</p>
             <img src="'.$film_link.'" alt="" style="width:100px;"/>
             <table>
             <tr>
             <th>Gekozen stoel</th>
             <th>Prijs van de stoel</th>
             <th>Zaal</th>
             </tr>
             ';
         foreach ($stoelen as &$value) {
            
             $query_stoel = mysql_fetch_array(mysql_query("SELECT * FROM stoelen WHERE id=$value"));
             $zaal_id=$query_stoel['zaal_id'];
             $stoel_class=$query_stoel['stoel_class'];
             $query_stoel_prijs = mysql_fetch_array(mysql_query("SELECT * FROM stoelprijs WHERE id=$stoel_class"));
             $sub_totaal = $query_stoel_prijs['prijs'];
             $totaal = $sub_totaal + $totaal;
             $totaal = number_format($totaal, 2);
             $prijs = number_format($query_stoel_prijs['prijs'],2);
                     
             echo'
                 <tr>
                 <td>'.$value.'</td>
                 <td>&euro;'.$prijs.'</td>
                 <td>'.$zaal_id.'</td>
                 </tr>
                 ';

        }        
        echo'</table>
             <table>
             <tr>
             <th>Totaal te betalen</th>
             </tr>
             <tr>
             <td>&euro; '.$totaal.'</td>
             </tr>
             </table>
             <form name="bestelling_bevestig" action="'.WB_URL.'/controller/bestelling-verwerken.php" method="POST">';
          foreach ($stoelen as &$value) {
              echo'<input type="hidden" name="gekozen_stoelen[]" value="'.$value.'" />';
          }          
          echo'<p> <label>Vul Uw email adres in</label><input class="input_style" type="text" name="email" value=""/></p>
              <input type="hidden" name="zaal" value="'.$zaal_id.'" />
              <input type="hidden" name="totaal" value="'.$totaal.'" />
              <input type="hidden" name="filmnaam" value="'.$filmnaam.'" />
              <input type="hidden" name="tijd" value="'.$tijd.'" />
              <p><input type="submit" name="bestelling_bevestigen" value="Bestelling bevestigen" class="printen"/></p><p>&nbsp;</p>
              </form>';
        }
   echo'</div></div>';      
   }
       
                 

     
}

function get_bestelling_betaald(){
    if(isset($_POST['bestelling_bevestigen'])){
        $email = $_POST['email'];
        if(!preg_match('/^[A-Za-z0-9\+._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/', $email)) {     
            ?>
            <script type="text/javascript">
            alert('Uw heeft geen geldig email-adres ingevuld');
            window.history.back();
            </script>
            <?php      
         }
         echo'<div class="white">'; 
         $datum = '';
         $tijd = $_POST['tijd'];        
         $filmnaam = $_POST['filmnaam'];
         $zaal = $_POST['zaal'];
         
         $totaal_overzicht = $_POST['totaal'];
         $gekozen_stoelen = $_POST['gekozen_stoelen'];
         $gekozen_stoelen = implode(".", $gekozen_stoelen);
         
         $hash = date("Y-m-d H:i:s");
         $hash = md5($hash);

        $filmnaam_query= mysql_fetch_array(mysql_query("SELECT * FROM films WHERE Naam ='$filmnaam'"));
        $poster = $filmnaam_query['Poster'];

       // mail_ticket_code($hash,$tijd,$poster,$filmnaam,$zaal,$gekozen_stoelen,$email);
        
        
        mysql_query("INSERT INTO bestelling (zaal_id, filmnaam, stoelen, totaal_prijs, datum, tijd, reserveer_code, email)VALUES('$zaal', '$filmnaam', '$gekozen_stoelen', '$totaal_overzicht', '$datum', '$tijd', '$hash', '$email' )");
         echo'<div style="clear:both;"></div>
             
             <p><br /><br /></p>
             <h6 class="ticket_header">Tickets</h6>
             <div class="text_rule">
                <p>
                    Dank u wel voor uw reservering er is een mail naar uw gestuurd op het adres: '.$email.' met aanvullende gegevens.<br/>
                    We hebben uw betaling in goede orde ontvangen en uw reservering is geplaats.<br/>
                    Met vriendelijke Groeten,<br/><br/>
                    Filmpje<br />
                    <br />
                    <p>
                    <input type="button" value="Print uw ticket" onClick="window.print()" class="printen" />
                    </p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                    <p>&nbsp;</p>
                </p>
                <div class="ticket_printbaar">
                    <div class="linker_ticket">
                         <img src="'.$filmnaam_query['Poster'].'" alt="Filmpje Film Poster" />
                    </div>
                    <div class="rechter_ticket">
                        <h6>Ticket</h6>
                        <p><div class="ticket_text_left"><b>Ticket-code:</b></div><div class="ticket_text_right">'.$hash.'</div><br />
                           <div class="ticket_text_left"><b>Film draait om:</b></div><div class="ticket_text_right">'.$tijd.'</div><br />
                           <div class="ticket_text_left"><b>Gekozen stoelen:</b></div><div class="ticket_text_right">'.$gekozen_stoelen.'</div><br />
                           <div class="ticket_text_left"><b>Zaal:           </b></div><div class="ticket_text_right">'.$zaal.'</div><br />
                        </p>
                    </div>
                
                </div>
             </div>';
         
        
         echo'</div>';
    }
}

function get_stoel_prijs($stoel_class){
    
    $stoel_prijs = mysql_query(mysql_fetch_array("SELECT * FROM stoelprijs WHERE id = $stoel_class"));
    echo $stoel_prijs['prijs'];
}

function get_zaal1(){
    $zaal = 1;
    $rekensom = 24 * 12 + 2;
    if(isset($_POST['filmnaam'])){$filmnaam =  $_POST['filmnaam'];}else{$filmnaam='';}
    echo'<p>Hieronder ziet ur een overzicht van de beschikbare stoelen voor de film '.$filmnaam.'.</p>
        <p>Het scherm waar uw de film op gaat kijken staat aan deze (^)kant.</p>
        <form action="'.WB_URL.'/tickets" method="POST" class="cinema_room_1" style="width: '.$rekensom.'px;">
        ';
    $query = mysql_query("SELECT * FROM stoelen WHERE zaal_id=$zaal");
    while($stoel = mysql_fetch_array($query)){
        if($stoel['stoel_class']==1){
            echo '<div id="'.$stoel['id'].'" class="cinema_chair_empty"></div>';
        }
        else if($stoel['stoel_class']==2){
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_red" value=" " />';
        }
        else if($stoel['stoel_class']==3){
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_yellow" value=" " />';
        }
        else{
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_blue" value="  " />';
        }
    }
    echo'</form><form action="'.WB_URL.'/controller/controller/bestelling-verwerken.php" method="POST"  style="float:right;width:480px;text-align:right;"><div id="stoelbestelling"></div><div id="bestelling_verwerken"></div></form>';
    

}
function get_zaal2(){
    $zaal = 2;
    $rekensom = 24 * 18 + 2;
     if(isset($_POST['filmnaam'])){$filmnaam =  $_POST['filmnaam'];}else{$filmnaam='';}
    echo'<p>Hieronder ziet ur een overzicht van de beschikbare stoelen voor de film '.$filmnaam.'.</p>
        <p>Het scherm waar uw de film op gaat kijken staat aan deze (^)kant.</p>
        <form action="'.WB_URL.'/tickets" method="POST" class="cinema_room_1" style="width: '.$rekensom.'px;">
    ';
    $query = mysql_query("SELECT * FROM stoelen WHERE zaal_id=$zaal");
    while($stoel = mysql_fetch_array($query)){
        if($stoel['stoel_class']==1){
            echo '<div id="'.$stoel['id'].'" class="cinema_chair_empty"></div>';
        }
        else if($stoel['stoel_class']==2){
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_red" value=" " />';
        }
        else if($stoel['stoel_class']==3){
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_yellow" value=" " />';
        }
        else{
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_blue" value=" " />';
        }
    }
    echo'</form><form action="'.WB_URL.'/controller/bestelling-verwerken.php" method="POST"  style="float:right;width:480px;text-align:right;"><div id="stoelbestelling"></div><div id="bestelling_verwerken"></div></form>';
    

}
function get_zaal3(){
    $zaal = 3;
    $rekensom = 24 * 30 + 2;
    
   if(isset($_POST['filmnaam'])){$filmnaam =  $_POST['filmnaam'];}else{$filmnaam='';}
    echo'<p>Hieronder ziet ur een overzicht van de beschikbare stoelen voor de film '.$filmnaam.'.</p>
        <p>Het scherm waar uw de film op gaat kijken staat aan deze (^)kant.</p>
        <form action="'.WB_URL.'/tickets" method="POST" class="cinema_room_1" style="width: '.$rekensom.'px;">
       ';
    $query = mysql_query("SELECT * FROM stoelen WHERE zaal_id=$zaal");
    while($stoel = mysql_fetch_array($query)){
        if($stoel['stoel_class']==1){
            echo '<div id="'.$stoel['id'].'" class="cinema_chair_empty"></div>';
        }
        else if($stoel['stoel_class']==2){
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_red" value=" " />';
        }
        else if($stoel['stoel_class']==3){
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_yellow" value=" " />';
        }
        else{
            echo'<input name="'.$stoel['id'].'" type="button" id="'.$stoel['id'].'" onclick="stoel_gekozen(this.id,'.$stoel['stoel_class'].')" class="cinema_chair_blue" value=" " />';
        }
    }
    echo'</form><form name="stoel_bevestig" action="'.WB_URL.'/controller/bestelling-verwerken.php" method="POST"  style="float:right;width:480px;text-align:right;"><div id="stoelbestelling"></div><div id="bestelling_verwerken"></div></form>';
    

}

function mail_ticket_code(){
    //code generen
   

     $to = $email;
    $subject = 'Reserveringsgegevens';
    $message = '
    <html>
    <head>
      <title>Reserveringsgegevens</title>
    </head>
    <body>
      <p>Hieronder staan uw reserveringsgegevens </p>
      <table>
        <tr>
          <th>E-mail</th>
          <th>Reserveringscode</th>
          <th>Film</th>
          <th>Datum</th>
          <th>Tijd</th>
          <th>Zaal</th>
          <th>Gekozen Stoelen</th>
        </tr>
        <tr>
          <td>'.$email.'</td>
          <td>'.$hash.'</td>
          <td>'.$filmnaam.'</td>
          <td>Datum</td>
          <td>'.$tijd.'</td>
          <td>'.$zaal.'</td>
          <td>'.$gekozen_stoelen.'</td>
        </tr>
       
      </table>
    </body>
    </html>
    ';
    $headers  = 'X-Mailer: PHP/' . phpversion(); "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    $headers .= 'From: Filmpje <admin>' . "\r\n";
    mail($to, $subject, $message, $headers);
}

function get_page_current_navigation(){
    
}

function contact_form(){
    //Kijken of er een formulier verzonden is
    //Zo ja dan doen we dit
    if(isset($_POST['vezenden'])){
        //Velden ophalen
            $naam = strip_tags($_POST['naam']); 
            $email = $_POST['email'];
            $telefoonnummer = strip_tags($_POST['telefoon']);
            $opmerking = strip_tags($_POST['opmerking']);
            $error = '';
            $mistake1 = '';
            $mistake2 = '';
            $mistake3 = '';
            $mistake4 = '';
            
            //Waardes uit de velden controleren
            if($naam == ''){
                 $error .='<p>Geen naam ingevuld</p>';
                 $mistake1 = 1;
            }
            if(!preg_match('/^[A-Za-z0-9\+._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/', $email)) {
                 $error .='<p>Geen geldig email adres ingevuld</p>';
                 $mistake2 = 1;
            }
            if(!preg_match('/^[0-9]{10}$/', $telefoonnummer)){
                 $error .='<p>Geen geldig telefoonnummer ingevuld</p>';
                 $mistake3 = 1;
            }
            if($opmerking == ''){
                 $error .='<p>Geen opmerking ingevuld</p>';
                 $mistake4 =  1;
            } 
            
            //Formulier met de fouten aanmaken
            $my_form_error = '
                       <form method="post" action="'.WB_URL.'/over-filmpje" enctype="multipart/form-data">  
                       <p><label>Naam</label>
                       <input class="';
                      if($mistake1){$my_form_error .= 'input_style_red';}else{$my_form_error .= 'input_style';}
            $my_form_error .= '" type="text" name="naam" value="'.$naam.'"></p>
                       <p><label>Email</label>
                       <input class="';
                      if($mistake2){$my_form_error .= 'input_style_red';}else{$my_form_error .= 'input_style';}
            $my_form_error.= '" type="text" name="email" value="'.$email.'"></p>
                       <p><label>Telefoonnummer</label>
                       <input class="';
                      if($mistake3){$my_form_error .= 'input_style_red';}else{$my_form_error .= 'input_style';}
            $my_form_error.= '" type="text" name="telefoon" value="'.$telefoonnummer.'"></p>
                       <p><label>Opmerking/vragen</label>
                       <textarea class="
                       ';
                      if($mistake4){$my_form_error .= 'textarea_style_red';}else{$my_form_error .= 'textarea_style';}
            $my_form_error.= '" name="opmerking" rows="5" cols="25">'.$opmerking.'</textarea></p>
                       <p><input type="submit" name="vezenden" value="Verzenden" /></p>
                       </form>';
          //geen fouten dan doen we dit
          if(!$error){echo'<div class="form">
                              
                                <p>met succes ingeveuld</p>
                           </div>';}
          //wel fouten dan doen we dit 
          else{echo '<div class="form">
                               
                                <p>De velden of het veld wat uw niet of verkeerd heeft ingevuld staat met rood aangegeven</p>',$error,$my_form_error,
                    '</div>';}   
          
    }
    //Zo nee dan doen we dit
    else{
      echo '<form method="post" action="'.WB_URL.'/over-filmpje" enctype="multipart/form-data" class="form">  
                  
                    <p><label>Naam</label>
                    <input class="input_style" type="text" name="naam" value=""/></p>
                    <p><label>Email</label>
                    <input class="input_style" type="text" name="email" value=""/></p>
                    <p><label>Telefoonnummer</label>
                    <input class="input_style" type="text" name="telefoon" value=""/></p>
                    <p><label>Opmerking/vragen</label>
                    <textarea class="textarea_style" name="opmerking" rows="5" cols="25"></textarea></p>
                    <p><input type="submit" name="vezenden" value="Verzenden" /></p>
               </form>';
    }
   
}

function nieuwsbrief(){
    if(isset($_POST['vezenden'])){
          $email = strip_tags($_POST['email']); 

          if($email=='' || $email=='E-mailadres'){
                     echo'
                         <p class="nieuwsbrief_tekst_margin">Uw bent verplicht om een email adres in te vullen.</p>
                         ';
          }
          else{
              if(preg_match('/^[A-Za-z0-9\+._-]+@[A-Za-z0-9._-]+\.[A-Za-z]{2,6}$/', $email)) {
                
                  echo'<p class="nieuwsbrief_tekst_margin">Uw bent aangemeld voor de nieuwsbrief.</p>';
              }
              else{
                     echo'
                         <p class="nieuwsbrief_tekst_margin">Uw heeft geen geldig E-mailadres ingevult. Probeer het opnieuw.</p> 
                         ';
              }
           
          }
    
    }
    else
    {
        echo'  
            <p class="nieuwsbrief_tekst_margin">Schrijf uw nu gratis in voor de nieuwbrief.<br />Vul Hieronder Uw e-mailadres in om lid te worden.</p>   
            ';
    }
}

function get_slider_movie(){
    require '../model/film.php';
					$db = new database();
					$gebruiker = new filmpje($db);
					
					$Year="2012";
					$Nieuwste_films= $gebruiker ->get_nieuwe_films($Year);

					foreach($Nieuwste_films as $gebruiker) {
					$filmnaam = $gebruiker['Naam'];
                                        $filmnaam = str_replace(' ', '%20', $filmnaam);
						echo'<div class="home_movie_slider_item">';
						echo'<div class="home_movie_slider_item_img">';
						echo '<a href="film/'.$filmnaam.'" title="'.$gebruiker['Naam'].'"><img src="'.$gebruiker['Poster'].'" alt="'.$gebruiker['Naam'].'"></a>';
						  echo'    </div>';
                echo'<div class="home_movie_slider_item_text">';
                   echo' <p>';
                       echo'  About time';
                    echo'</p>';
                echo'</div>';
            echo'</div>';
}
}

function get_spotlight_movies(){
    $db = new database();
		$gebruiker = new filmpje($db);
		$top_films= $gebruiker ->get_top_films();
			echo'<ul>';
			foreach($top_films as $gebruiker) {
			$filmnaam = $gebruiker['Naam'];
                                        $filmnaam = str_replace(' ', '%20', $filmnaam);
				echo'<li class="">';
			
				echo '<a href="film/'.$filmnaam.'" title="'.$filmnaam.'"><img src="'.$gebruiker['Poster'].'"  alt="'.$filmnaam.'"/> '; 
					echo'<div class="margin_left_10">';
				echo'<strong>'.$gebruiker['Naam'].'</strong>
                                     <p>'.$gebruiker['Genre'].'</p>
                                     <p><small>IMDB-rating:'.$gebruiker['Raiting'].'</small ></p>';
                                        echo'</div>';
				echo' </a>';
				echo'</li>';
				
		}
		echo '</ul>';
}

function get_agenda(){
	$query = mysql_query("SELECT * FROM film_agenda ORDER BY id");
	
	
    while($film_lijst = mysql_fetch_array($query)){
		$zaal = $film_lijst['zaal'];
		$query_plaatsen = mysql_query("SELECT * FROM stoelen WHERE zaal_id = $zaal");
		$vrije_plaatsen = mysql_num_rows($query_plaatsen);
		echo'<tr>
				<td>'.$film_lijst['film_naam'].'</td>
				<td>'.$film_lijst['genre'].'</td>
				<td>'.$film_lijst['datum'].'</td>
				<td>'.$film_lijst['tijd'].'</td>
				<td>'.$film_lijst['zaal'].'</td>
				<td>Vanaf &euro; 7,50 </td>
				<td>'.$vrije_plaatsen.'</td>
			</tr>';
    }
	
	
}

?>

