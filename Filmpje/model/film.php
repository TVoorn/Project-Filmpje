<?php

//Hier include ik de database zodat ik sql statemens gegeven kan weg schrijven of ophalen.
include("database.php");

//Dit is de classe filmpje hierin zijn alle functies geplaats die met films te maken heeft.
class filmpje{

private $db;

public function __construct(Database $db)
	{
		$this->db = $db;
	}

//deze functie slaat foto's op
public function sla_fotos_op($Naam,$Genre,$Actors,$Tijd,$Plot,$Poster,$Date,$QR){
	$result = $this->db->query("INSERT INTO films(Naam, Genre, Actors,Tijd,Plot,Poster,datum,QR) VALUES('$Naam','$Genre','$Actors','$Tijd','$Plot','$Poster','$Date','$QR')");
	return $result;
	}

//Deze functie haal films op	
public function get_films(){
	$result = $this->db->query("SELECT * FROM films");
	$user_data = $this->db->result_array();
	return $user_data;
	}

//Deze functie zoekt naar films bij imdb.	
public function zoek_films($film_naam){
	$json=file_get_contents("http://www.omdbapi.com/?t=$film_naam");
	$info=json_decode($json);
	return $info;
}

//Met deze functie worden de films gesorteert
public function sort_films($sort){
	$result = $this->db->query("SELECT * FROM films ORDER BY $sort ASC");
	$user_data = $this->db->result_array();
	return $user_data;
}

//Met deze functie haal je 1 film op
public function get_film($filmnaam){
	$result = $this->db->query("SELECT * FROM films WHERE Naam  = '$filmnaam'");
	$user_data = $this->db->result();
	return $user_data;
}
public function get_poster($Poster){
	$result = $this->db->query("SELECT * FROM fotolinks WHERE Poster='$Poster'");
	$user_data = $this->db->result_array();
	return $user_data;
}
public function get_nieuwe_films($Year){
	$result = $this->db->query("SELECT * FROM films WHERE Year='$Year'");
	$user_data = $this->db->result_array();
	return $user_data;
}

public function get_top_films(){
	$sort = 'Raiting';
	$result = $this->db->query("SELECT * FROM films ORDER BY $sort DESC");
	$user_data = $this->db->result_array();
	return $user_data;
}


	
}

?>