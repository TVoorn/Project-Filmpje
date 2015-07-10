function stoel_gekozen(id_geklikte_stoel,stoel_class){
   

//    functie om de stoelen aan te maken
   
  
    if(stoel_class==1){
        stoel_prijs = '';
    }
    else if(stoel_class==2){
        stoel_prijs = '13,00';
        if(document.getElementById(id_geklikte_stoel).className.match("cinema_chair_red_chosen")){
            document.getElementById(id_geklikte_stoel).setAttribute("class", "cinema_chair_red");
            var parent=document.getElementById("totaal_overzicht");
            var child=document.getElementById("stoel_"+id_geklikte_stoel);
            parent.removeChild(child);
            document.getElementById('stoel_'+id_geklikte_stoel).remove();
        }
        else{
            document.getElementById(id_geklikte_stoel).setAttribute("class", "cinema_chair_red_chosen");
        }
    }
    else if(stoel_class==3){
        stoel_prijs = '11,00';
        if(document.getElementById(id_geklikte_stoel).className.match("cinema_chair_yellow_chosen")){
            document.getElementById(id_geklikte_stoel).setAttribute("class", "cinema_chair_yellow");
            var parent=document.getElementById("totaal_overzicht");
            var child=document.getElementById("stoel_"+id_geklikte_stoel);
            parent.removeChild(child);
            document.getElementById('stoel_'+id_geklikte_stoel).remove();
        }
        else{
            document.getElementById(id_geklikte_stoel).setAttribute("class", "cinema_chair_yellow_chosen");
        }
    }
    else{
        stoel_prijs = '7,50';
        if(document.getElementById(id_geklikte_stoel).className.match("cinema_chair_blue_chosen")){
            document.getElementById(id_geklikte_stoel).setAttribute("class", "cinema_chair_blue");
            var parent=document.getElementById("totaal_overzicht");
            var child=document.getElementById("stoel_"+id_geklikte_stoel);
            parent.removeChild(child);
            document.getElementById('stoel_'+id_geklikte_stoel).remove();
        }
        else{
            document.getElementById(id_geklikte_stoel).setAttribute("class", "cinema_chair_blue_chosen");
        }
    }
  
     document.getElementById("totaal_overzicht").innerHTML+=
    '<div id="stoel_'+id_geklikte_stoel+'" class="'+stoel_class+'">\n\
    <p class="linker_totaal_overzicht">' + 
    id_geklikte_stoel + 
    '</p><p class="rechter_totaal_overzicht">&euro;' + stoel_prijs + '</p><input type="hidden" name="stoelen[]" value="' + id_geklikte_stoel + '" /> </div>';

    
   
    document.getElementById("bevestigknop").innerHTML='<input type="submit" name="bestelling_bekijken" value="Bestelling bekijken" class="check_tickets" />';
   
};





function close_slider(){
    var sliderdiv = document.getElementById("header_home");
    sliderdiv.style.display = ( sliderdiv.style.display == 'none' ) ? 'block' : 'none';
    if(document.getElementById("slider_atrri").className.match("slider_down")){
            document.getElementById("slider_atrri").setAttribute("class", "slider_up");
        }
        else{
            document.getElementById("slider_atrri").setAttribute("class", "slider_down");
        }
};

