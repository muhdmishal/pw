

<?php

/************************************************************
*   car.php - car class file
*************************************************************/


class Property {
	
	public $price ; 
	public $date ; 
	public $address ; 

	

	function __construct($price , $date , $address){
		
		$this->price = $price ; 
		$this->date = $date ; 
		$this->address = $address ; 
	
		
	}

	
	function dumpProperty(){
		
		echo '###########  Dump Property ############'.'<br>';
		
		echo "Price : ".$this->price.'<br>';
		echo "Date : ".$this->dateSold.'<br>';
		echo "Post Code : ".$this->postCode.'<br>';
		echo "Door : ".$this->doornr.'<br>';
		echo "Flat: ".$this->flatnr.'<br>';
		echo "Road : ".$this->roadName.'<br>';
		echo "Town : ".$this->town.'<br>';
		echo "Area : ".$this->area.'<br>';
		echo "Borough : ".$this->borough.'<br>';
		echo "Country : ".$this->country.'<br>';
	}
	
}

?>