<?php

class Database
{
	private $mysql_host = 'localhost';
	private $mysql_user = 'root';
	private $mysql_pass = '';
	private $mysql_db = 'filmpje';
	
	private $result	= FALSE;
	private $connection = FALSE;

	//maakt een connectie met de database, met de bovenstaande variabelen.
	function connect(){
	
		if ($this->connection !== FALSE)
		{

			return;
		}
		
		if (($this->connection = @mysqli_connect($this->mysql_host, $this->mysql_user, $this->mysql_pass)) === FALSE)
		{
			echo printf("Connect failed: %s\n", mysqli_connect_error());
			
		}
		
		@mysqli_select_db($this->connection, $this->mysql_db);
		
		return TRUE;
	}//einde connectie functie

	
	//deze fucntie voert alle sql statements uit.
	function query($sql) {
		
		if (trim($sql) == '') {
			return FALSE;
		}
		
		if ($this->connection === FALSE) {
			$this->connect();
		}
		
		$this->result = @mysqli_query($this->connection, $sql);
		
		return $this->result;
	}
	
//Dget one value out of a qeury.
	function result() {
		
		if ($this->result === FALSE){
			return FALSE;
		}
		
		return mysqli_fetch_assoc($this->result);
	}
	
//get multiple values from qeury
	function result_array() {
		
		if ($this->result === FALSE){
			return FALSE;
		}
		
		$results = array();
		while ($row = mysqli_fetch_assoc($this->result)){
				
			$results[] = $row;
		}
			
		return $results;
	} 

	
	function num_rows() {
		
		return @mysqli_num_rows($this->result);
	}
	
	
}	
	
?>