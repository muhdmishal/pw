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
		$sql = "SELECT `postcode` from `ukpostcodes` WHERE `postcode` LIKE '$key%' LIMIT 0 , 5";

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

		$sql = "SELECT `ward` from `ukpostcodes` WHERE `ward` LIKE '$key%'  LIMIT 0 , 5";
		if ( ! ($res = $conn->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}
				//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);
		$i = 0;
		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['ward'], $array))
			{
				$i++;
				$array[] = $row['ward'];
				if($i == 5)
				{
					break;
				}
			}
		}








		return $array;





	$conn->close();
}


		if(isset($_POST['queryString'])) {




			$queryString = $_POST['queryString'];

			if(strlen($queryString) >0) {

				$locations = getLocationsForSuggest($queryString) ;

				$out = '<ul>';
					foreach ($locations as $loc ) {

	         			$out .= '<li onClick="fill(\''.addslashes($loc).'\');">'.$loc.'</li>';
	         		}
				$out .= '</ul>';

				echo $out;


			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}

?>
