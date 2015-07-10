<div class="ticket_col">
     <div class="left_inner_top">
        <h1 class="catering_header">Tickets</h1>
    </div>
    <div class="tickets_inner_left">
        <div class="text_rule">
           <?php
            if(isset($_POST['zaal'])){$zaal = $_POST['zaal'];}
            else{$zaal = "1";}
           ?>
           <p>Uw heeft gekozen voor zaal <?php echo $zaal; ?> in Rotterdam</p>
            <?php
            if($zaal == 2){get_zaal2();}
            elseif($zaal == 3){get_zaal3();}
            else{get_zaal1();}
            ?>
        </div>
    </div>
    <div class="tickets_inner_right">
        
         <form name="stoel_bevestig" action="<?php echo WB_URL; ?>/controller/bestelling-verwerken.php" method="POST">
             <?php get_price_bord(); ?>
                <p class="text_margin">Kies de tijd die u naar de film <?php if(isset($_POST['filmnaam'])){echo $_POST['filmnaam'];}else{echo'';}?> zou willen gaan</p>
                <input type="hidden" name="filmnaam" value="<?php echo $_POST['filmnaam']; ?>" />
                <p class="text_margin">
                    <select name="tijd">
                        <option value="16.00">16.00 uur</option>
                        <option value="18.00">18.00 uur</option>
                    </select>
                </p>

                <div class="left_tickets"></div>
                <div id="resultaat"></div>
                <div id="totaal_overzicht"></div>
                <div id="bevestigknop"></div> 
         </form>
    </div>
</div>

