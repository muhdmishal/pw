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





		public function storePropertyToDatabase( $car ){

			$price = $this->db->dbcon->real_escape_string($car->id);
			$date = utf8_decode($this->db->dbcon->real_escape_string($car->price));
			$address = utf8_decode($this->db->dbcon->real_escape_string($car->dateSold ));
			$times =  substr($timestamp, 0 , 10);
			$times = str_replace('/', '-', $times);

			//check if the car already exists in the database
			$sqli = "SELECT * FROM `property-search-new` WHERE `price` = '$price' ";
			$resi = $this->db->query($sqli) ;

			if ( $resi->num_rows > 0 )
				continue ; // duplicate
			$newvalue = date('Y-m-d', strtotime($times));

			$sql = "INSERT INTO `property-search-new` (`price`, `date`, `address`) " ;
			$sql .= "VALUES ('$price' , '$date' , '$address')" ;


			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

		}


		function getHtmlTable($rs){
			// receive a record set and print
			// it into an html table
			$out = '<table width="100% cellpadding="5" border="0" class="results-table">';
			while ($field = $rs->fetch_field())
				$out .= "<th>".$field->name."</th>";
			while ($linea = $rs->fetch_assoc()) {
				$out .= "<tr>";
				foreach ($linea as $valor_col) $out .= '<td>'.$valor_col.'</td>';
				$out .= "</tr>";
			}
			$out .= "</table>";
			return $out;
		}



		function searchFor($string){

		//	$sqli = "SELECT * FROM `property_prices` WHERE `id` = '$id' ";

			$searchFor = $this->db->dbcon->real_escape_string($string);



			$string = strtoupper($string);
			$sql =  "SELECT * from `property-search-new` where upper(concat(`price`,'', `date`, '', `address`)) like '%".$string."%'" ;
		//	echo $sql."<br>";

			$res = $this->db->query($sql) ;


			if ( $res->num_rows === 0 ){
				echo "No results ! <br>";
			} else {
				//display results
				print $this->getHtmlTable($res);

			}


		}

		function searchFor2($string){


			$first = true  ;

			$search = $this->db->dbcon->real_escape_string($string);
			$search = strtoupper($search);

			$words = explode(' ' , $search ) ;


			$sql = "SELECT * FROM `property-search-new`";

			$res = $this->db->query($sql) ;

			//header
			$out = '<table width="100% cellpadding="10" border="2">';
			while ($field = $res->fetch_field())
				$out .= "<th>".$field->name."</th>";


			while ($linea = $res->fetch_assoc()) {

				$row = '';
				$toDisplay = '';


				foreach ($linea as $valor_col) {
					$row .= $valor_col.' ';
					$toDisplay .='<td>'.$valor_col.'</td>';
				}

				$count  = 0 ;

				foreach ($words as $word ) {

					if (strpos($row,$word) !== false) {
						$count++ ;
					}


				}

				$procent = $count / sizeof($words) ;

				if ($procent  == 1 ) 	{

					//display record
					//check if it's the first one
					if ($first ) {
						//display header
						$first = false ;

					}

					$out .= "<tr>".$toDisplay."</tr>";

				}


			}

			if (!$first )
				echo $out ;
			else
				echo 'No results !';

		}


	}
?>
