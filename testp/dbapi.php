<?php

/******************************************************************
*	File : dbapi.php
*   Purpose :     implements function to store data into database
*
*                 storeMovieIntoTable
*******************************************************************/



	class DBAPI {

		private $db ;

		function __construct(){
			require_once 'dbhandler.php';		


			//connecting to the database
			$this->db = new DBHandler();
			$this->db->connect();
		}

		function __destruct(){
		}



	function getPrediction($key){
		$sql = "SELECT * from `property` WHERE `town` LIKE '%{$key}%'";

		$array = array();

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		while($row = $res->fetch_assoc())
		{
			$array[] = $row['town'];
		}


		return $array;

	}



}
?>
