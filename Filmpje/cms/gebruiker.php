<?php 
include("database.php");

class user{
	private $db;

	public function __construct(Database $db)
	{
		$this->db = $db;
	}

public function change_ww($password,$id){
	$result = $this->db->query("UPDATE users SET password='$password' WHERE Id='$id'");
	return $result;
}
public function Login ($username, $password){
	$result = $this->db->query("SELECT id FROM users WHERE username = '$username' AND password = '$password'");	
	$user_data = $this->db->result();
	$no_rows = $this->db->num_rows();
	if($no_rows ==1){
	$_SESSION['username'] = $username;
	$_SESSION['id'] = $user_data['id'];
	return TRUE;
}else{
	return FALSE;
	}
}
    

}


?>