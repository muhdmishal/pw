<?php 

	class Image{
	
		public $id ; 
		public $propId ; 
		public $path ; 
		
		
		public function __contruct($id  , $propId , $path ){
			$this->id = $id ; 
			$this->propId = $propId ; 
			$this->path = $path ; 
		}
	
	}


?>