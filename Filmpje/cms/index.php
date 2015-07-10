<?php
header('Location: http://localhost/Filmpje/cms/login.php');
class BankAcount{
	public $balance = 0;

	public function DisplayBalance(){
		return $this->balance;
	}
	
	public function haalop($geldbedrag){
		if(($this->balance)<$geldbedrag){
			echo 'Niet genoeg saldo<br>';
		}else{
			$this->balance = $this->balance -$geldbedrag;
		}
	}

	public function Deposit($geldbedrag){
		$this->balance = $this->balance+$geldbedrag;
	}
}

class SavingsAcount extends BankAcount{
	public $type = '18-25';
	
}

$alex = new BankAcount;
$alex->Deposit(100);

$alex_saving = new SavingsAcount;
$alex_saving->Deposit(3000);
echo $alex_saving->type;

?>