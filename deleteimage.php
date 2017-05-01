<?php

function deleteimages($key,$userid)
{
	
			$servername = "localhost";
		$username = "drinkdri_myprop";
		$password = "wingproperty";
		$dbname = "drinkdri_propertywing";

// Create connection
		$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
	
		$sql = "UPDATE `images` SET `status`= '2' WHERE `images_id` = '$key' AND `user_id` = '$userid'";
		
	 echo $sql;
		
		if ( ! ($res = $conn->query($sql))){
				echo "Errors in query ! ";
				return false ; 
		}
				//$file = fopen('./logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);
		
		
		

	$conn->close();
}
	
	
		if(isset($_REQUEST['q']) && isset($_REQUEST['user'])) {
			
			
			
			$userid = $_REQUEST['user'];
			$queryString = $_REQUEST['q'];
			//$userid = $_REQUEST['u'];
			
			if(strlen($queryString) >0) {

				$locations = deleteimages($queryString,$userid) ; 
				
			} else {
				// do nothing
			}
		} else {
			echo 'There should be no direct access to this script!';
		}
	
?>