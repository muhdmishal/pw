<?php

function getLocationsforSuggest($key)
{

			$servername = "localhost";
		$username = "drinkdri_postcod";
		$password = "ukpostcodes";
		$dbname = "drinkdri_postcodes_uk";

// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
		$sql = "SELECT * from `ukpostcodes` WHERE `postcode` LIKE '$key%' LIMIT 0 , 10";

		$array = array();

		if ( ! ($res = $conn->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}
				//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);

		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['postcode'], $array))
			$array[] = $row['postcode'];
		}


		return $array;





	$conn->close();
}


		if(isset($_POST['queryString'])) {




			$queryString = $_POST['queryString'];

			if(strlen($queryString) >0) {

				$locations = getLocationsForSuggest($queryString) ;

				echo '<ul>';
					foreach ($locations as $loc ) {

	         			echo '<li onClick="fill(\''.addslashes($loc).'\');">'.$loc.'</li>';
	         		}
				echo '</ul>';


			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}

?>
