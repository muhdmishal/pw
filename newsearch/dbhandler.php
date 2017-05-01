<?php

/******************************************************************
*	File : dbhandler.php
*   Purpose :     implements class DBHandler to manipulate the database connection   		
*
*                 included and used by DBAPI.php
*******************************************************************/	


	class DBHandler {
		
		var $dbcon ; 
		
		function __construct(){
		}
		
		function __destruct(){
		}
		
		public function connect(){		
			
			require_once ('./config.php') ;
		
			
			$this->dbcon = new mysqli(DB_HOST , DB_USER , DB_PASSWORD , DB_NAME ) ; 
			
			//$this->dbcon->set_charset('utf8');  
			
			if ( !$this->dbcon ) {
				
				
			} 
			
			if ( $this->dbcon->connect_errno > 0 ){
				
				
				die ( 'Unable to connect to database ' ) ; 
			}
		
			
			return $this->dbcon ; 
		}
		
		public function closeConnection(){
			$this->dbcon->close();
		}
		
		public function query($sql){
			return $this->dbcon->query($sql);
		}
	}
?>