<div id="header_home">
    <?php get_slider(); ?>
    <div class="home_acties">
        <div class="home_sales_block"> <!-- buitenzijde-box -->
        	<a href="<?php echo WB_URL; ?>/acties" title="Filmpje | Acties">
				<img src="<?php echo WB_URL; ?>/files/img/acties/acties.jpg" alt="Filmpje | Actie"/>
				<img class="actie_stempel" src="<?php echo WB_URL; ?>/files/img/acties/action.png" alt="Filmpje aanbieding"/>
        	</a>
        </div>
    </div>
</div>
<div class="home_center_block">
    <div class="home_center_block_header">
        <h1>Home Filmpje</h1>
    </div>
    <div class="home_left_center">
        <h2>De nieuwste Films</h2>
        <div class="home_movie_slider">
		<?php get_slider_movie(); ?>
        </div>
		
		<a href="<?php echo WB_URL; ?>/films" title="Filmpje | Films">
		<div class="agenda">
			<h2>Film agenda</h2>
			<table id="agenda_tabel">
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
		</a>
		<div>      
            <h2>Over Flimpje</h2>
            <p>
				Filmpje is een bioscoopketen gevestigd in Rotterdam. Filmpje staat vooral bekend om zijn gebruikersvriendelijkheid. Ook staan de mogelijkheid om te loungen en de filmbeleving centraal. Deze bioscoopketen is aantrekkelijk vanwege de beschikking tot een bar, een loungegedeelte en drie bioscoopzalen van respectievelijk 150, 300 en 500 zitplaatsen.
			</p>
			<br>
			<p>
				Bij Filmpje worden uiteraard de laatste films vertoond.Filmpje weet zich te onderscheiden van andere bioscoopketens. De filmbeleving is ideaal doordat de zalen op een unieke manier zijn ingedeeld. Daarnaast is de prijs afhankelijk van de zitplaats. 
			</p>
			<br>
			<p>
				De behoefte van Filmpje is een website met een reserveringssysteem. Deze online reserveringssyteem zorgt ervoor dat de consumenten een reservering kunnen maken op basis van de gewenste zitplaats. 
			</p>
			<br>
			<p>
				<b><i>Kortom, Filmpje is meer dan een film alleen!</i></b>
            </p>
		</div>
    </div>
    <div class="home_right_center">
        <h2>Topfilms</h2>
		<div class="home_spotlight">
			<?php get_spotlight_movies(); ?>  
		</div>
			<h2>Nieuwsbrief</h2>
        <div class="nieuwsbrief">
            <div class="nieuws_brief_inner">
                <?php nieuwsbrief();?>
                <form method="post" action="" enctype="multipart/form-data">  
                    <p><input type="text" name="email" value="E-mailadres" class="nieuwsbrief_input" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;" /></p>
                    <p><input type="submit" name="vezenden" value="Verzenden" class="nieuwsbrief_schrijfin" /></p>
                </form>
            </div>
        </div>
    </div>
</div>