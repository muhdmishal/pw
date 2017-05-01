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
			require_once './dbhandler.php';		
			
			
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
	
	
	function autocomplete($key){
		
		// Define Output HTML Formating
$html = '';
$html .= '<li class="result">';
$html .= '<a href="http://propertywing.co.uk/login2/showprop.php?idprop=idx">';
$html .= '<h3>town</h3>';
$html .= '<h3>country</h3>';
$html .= '<h4>postcode</h4>';
$html .= '</a>';
$html .= '</li>';
		
		
		
		// Get Search
		
		$search_string = $this->db->dbcon->real_escape_string($key);
		$search_string = trim($search_string);

		$resaut = array();
		
		// Check Length More Than One Character
		if (strlen($search_string) >= 1 && $search_string !== ' ') {
			// Build Query
			$query = 'SELECT * FROM `property` WHERE `town` LIKE "%'.$search_string.'%" OR `country` LIKE "%'.$search_string.'%" OR `postcode` LIKE "%'.$search_string.'%"';

			if ( ! ($res = $this->db->query($query))){
				echo "Errors in query ! ";
				return false ; 
			}
						
			while($results = $res->fetch_array()) {
				$result_array[] = $results;
			}

	// Check If We Have Results
			if (isset($result_array)) {
				foreach ($result_array as $result) {

			// Format Output Strings And Hightlight Matches
				$display_town = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['town']);
				$display_idprop = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['id']);
				$display_country = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['country']);
				$display_postcode = preg_replace("/".$search_string."/i", "<b class='highlight'>".$search_string."</b>", $result['postcode']);;

				// Insert Name
				$output = str_replace('town', $display_town, $html);

				// Insert Function
				$output = str_replace('country', $display_country, $output);
				$output = str_replace('idx', $display_idprop , $output);

				// Insert URL
				$output = str_replace('postcode', $display_postcode, $output);

				// Output
				//echo($output);
				$resaut[] = $output ; 
		}
	}else{

		// Format No Results Output
			$output = str_replace('town', 'javascript:void(0);', $html);
			$output = str_replace('country', '<b>No Results Found.</b>', $output);
			$output = str_replace('postcode', 'Sorry :(', $output);

			// Output
			$resaut[] = $output ; 
			//echo($output);
		}
	}
	
	return $resaut ; 

	
	}
		
		
} 
?>