<?php

class DatabaseConnect{
	public function __construct($db_host, $db_username, $db_password){
		if ($this->Connect($db_host, $db_username, $db_password)){
			echo 'connection failed';
		}else{
			echo $db_host;
		}
	}
	
	public function Connect($db_host, $db_username, $db_password){
	
	}
	
}




?>