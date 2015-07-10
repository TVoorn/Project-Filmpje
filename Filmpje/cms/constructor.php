<?php

class Example{
	
	public function __construct($text){
		$this->Zegiets($text);
	}
	
	public function Zegiets($tekst){
		echo $tekst;
	
	}
}

$voorbeeld = new Example('Zeg iets');


?>