<?php 


	class User {
	
		public $id  ; 
		
		//TODO - add user's details 
		
		private $props ; 
		
				
		function __construct($id  ) {
			$this->id = $id ; 
						
			$this->props = array();		
		}	
		
		
		function addProperty($prop){
			$props[] = $prop ; 
			
			//store it into the database 
		
			
		}
		
		
		
	
	}

?>