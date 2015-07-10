<?php
include '../model/config.php';
if(isset($_POST['opslaan'])){
    echo'<p style="text-align:center;">De wijzigingen zijn opgeslagen.</p>';
    $stoelclass4 = $_POST['stoelclass4'];
    $stoelclass3 = $_POST['stoelclass3'];
    $stoelclass2 = $_POST['stoelclass2'];
    mysql_query("UPDATE stoelprijs SET prijs='$stoelclass4' WHERE id=4");
    mysql_query("UPDATE stoelprijs SET prijs='$stoelclass3' WHERE id=3");
    mysql_query("UPDATE stoelprijs SET prijs='$stoelclass2' WHERE id=2");
    
}else{
    $stoel_blauw= mysql_fetch_array(mysql_query("SELECT * FROM stoelprijs WHERE id=4"));
    $stoel_geel_of_oranje= mysql_fetch_array(mysql_query("SELECT * FROM stoelprijs WHERE id=3"));
    $stoel_rood= mysql_fetch_array(mysql_query("SELECT * FROM stoelprijs WHERE id=2"));
    
    echo'<div style="margin:0 auto;width:500px;">
        <p>Stoel prijzen aanpassen</p>
        <form action="" method="post">
            <p>Prijs van de blauwe stoel: <input type="text" name="stoelclass4" value="'.$stoel_blauw['prijs'].'" /></p>
            <p>Prijs van de oranje stoel: <input type="text" name="stoelclass3" value="'.$stoel_geel_of_oranje['prijs'].'" /></p>
            <p>Prijs van de rode stoel:<input type="text" name="stoelclass2" value="'.$stoel_rood['prijs'].'" /></p>
            <input type="submit" name="opslaan" value="opslaan" style="margin-top: 5px;
float:left;
margin-left:0;
padding: 2px 20px;
-webkit-border-radius: 5px;
-moz-border-radius: 5px;
border-radius: 5px;
border: 2px solid #06C;
background-color: #09F;
color: #fff;
font-weight: bold;
cursor:pointer;"/>
         </form></div>';
}
?>