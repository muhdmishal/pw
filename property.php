<?php 

/*
		property.php - class Property

*/


class Property{


	public $property_id ; 
	public $user_id ; 
	public $price ; 
	public $type ; 
	public $street ; 
	public $address ; 
	public $town ; 
	public $country ; 
	public $postCode ; 
	public $bedrooms ; 
	public $bathrooms ;
	public $gardenSize ;  
	public $description ; 
	public $status;
	public $created_date;
	public $updated_date;
	
	public $images ; 
	
	
	
	function __construct( $user , $pr , $type , $str , $add , $town , $count , $post , $bed , $bath , $gard , $desc , $status = '1' ){
		//$this->id = $id  ; 
		$this->user_id = $user ; 
		$this->price = $pr ; 
		$this->type = $type ; 
		$this->street = $str ; 
		$this->address = $add ; 
		$this->town = $town ; 
		$this->country = $count ; 
		$this->postCode = $post ; 
		$this->bedrooms = $bed ; 
		$this->bathrooms = $bath ; 
		$this->gardenSize = $gard ; 
		$this->description = $desc ; 
		$this->status = $status ; //1
		$this->created_date = date('Y-m-d h:i:s') ; 
		$this->updated_date = date('Y-m-d h:i:s'); 
		$this->images = array();
	}
}

?>