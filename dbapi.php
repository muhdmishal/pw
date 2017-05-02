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
			require_once 'property.php';
			require_once 'Message.php';

			//connecting to the database
			$this->db = new DBHandler();
			$this->db->connect();
		}

		function __destruct(){
		}


		public function storePropertyToDatabase4( $prop ){
			return 1;
			$id = $this->db->dbcon->real_escape_string($prop->id);
			$price = utf8_decode($this->db->dbcon->real_escape_string($prop->price));
			$timestamp = utf8_decode($this->db->dbcon->real_escape_string($prop->dateSold ));
			$postCode = utf8_decode($this->db->dbcon->real_escape_string($prop->postCode));
			$doornr = utf8_decode($this->db->dbcon->real_escape_string($prop->doornr));
			$flatnr = $this->db->dbcon->real_escape_string($prop->flatnr );
			$roadName = $this->db->dbcon->real_escape_string($prop->roadName);
			$town = utf8_decode($this->db->dbcon->real_escape_string($prop->town));
			$area = utf8_decode($this->db->dbcon->real_escape_string($prop->area));
			$borough = utf8_decode($this->db->dbcon->real_escape_string($prop->borough));
			$country = utf8_decode($this->db->dbcon->real_escape_string($prop->country));



			//$times =  substr($timestamp, 0 , 10);
			//$times = str_replace('/', '-', $times);


			//check if the car already exists in the database

			//$sqli = "SELECT * FROM `property_prices` WHERE `id` = '$id' ";
			//$resi = $this->db->query($sqli) ;

			//if ( $resi->num_rows > 0 )
			//	continue ; // duplicate




			//$newvalue = date('Y-m-d', strtotime($times));


			//$sql = "INSERT INTO `property_prices` (`id`, `purchase_price`, `purchase_date`, `postcode`, `door_number`, `flat_number`, `road`, `town`, `city`, `borough`, `county`) " ;
			//$sql .= "VALUES ('$id' , '$price' , '$newvalue',  '$postCode' , '$doornr' , '$flatnr' , '$roadName' ,'$town' , '$area' , '$borough' , '$country')" ;


			//if ( ! ($res = $this->db->query($sql))){
			//	echo "Errors in query ! ";
			//	return false ;
			//}

		}






		function getHtmlTable($rs){
			// receive a record set and print
			// it into an html table
			$out = '<table width="100% cellpadding="10" border="2">';
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
			$sql =  "SELECT * from `property_prices` where upper(concat(`id`,'', `purchase_price`, '', `purchase_date`,'',  `postcode`,'',  `door_number`, '', `flat_number`,'',  `road`,'',  `town`,'',  `city`, '', `borough`,'',  `county`)) like '%".$string."%'" ;
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


			$sql = "SELECT * FROM `property_prices`";

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

				if ($procent  >= 0.6 ) 	{

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


		function storePropertyToDatabase($prop){

			$idUser = $this->db->dbcon->real_escape_string($prop->idUser);
			$price = utf8_decode($this->db->dbcon->real_escape_string($prop->price));
			$type = utf8_decode($this->db->dbcon->real_escape_string($prop->type)) ;
			$postCode = utf8_decode($this->db->dbcon->real_escape_string($prop->postCode));
			$street = $this->db->dbcon->real_escape_string($prop->street);
			$address2 = $this->db->dbcon->real_escape_string($prop->address2 );
			$town = utf8_decode($this->db->dbcon->real_escape_string($prop->town));
			$country = utf8_decode($this->db->dbcon->real_escape_string($prop->country)) ;
			$bedrooms = utf8_decode($this->db->dbcon->real_escape_string($prop->bedrooms));
			$bathrooms = utf8_decode($this->db->dbcon->real_escape_string($prop->bathrooms));
			$gardenSize = utf8_decode($this->db->dbcon->real_escape_string($prop->gardenSize));
			$description = utf8_decode($this->db->dbcon->real_escape_string($prop->description));
			$status = $prop->status ;



			$sql = "INSERT INTO `property` (`iduser`, `price`, `type`, `street`, `address2`, `town`, `country`, `postcode`, `bedrooms`, `bathrooms` , `garden` , `description` , `status` ) " ;
			$sql .= "VALUES ('$idUser' , '$price',  '$type' , '$street' , '$address2' ,'$town' , '$country' , '$postCode' , '$bedrooms' , '$bathrooms' ,'$gardenSize' , '$description' , '$status')" ;




		//	echo $sql ;

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}


			//get ID property
			$propID = $this->db->dbcon->insert_id ;

		//	echo "<br> Property Added : ".$propID."<br>";

			return $propID ;

		}



function updatePropertyFromDatabase($prop){
			$id = $prop->id ;
			$idUser = $this->db->dbcon->real_escape_string($prop->idUser);
			$price = utf8_decode($this->db->dbcon->real_escape_string($prop->price));
			$type = utf8_decode($this->db->dbcon->real_escape_string($prop->type)) ;
			$postCode = utf8_decode($this->db->dbcon->real_escape_string($prop->postCode));
			$street = $this->db->dbcon->real_escape_string($prop->street);
			$address2 = $this->db->dbcon->real_escape_string($prop->address2 );
			$town = utf8_decode($this->db->dbcon->real_escape_string($prop->town));
			$country = utf8_decode($this->db->dbcon->real_escape_string($prop->country)) ;
			$bedrooms = utf8_decode($this->db->dbcon->real_escape_string($prop->bedrooms));
			$bathrooms = utf8_decode($this->db->dbcon->real_escape_string($prop->bathrooms));
			$gardenSize = utf8_decode($this->db->dbcon->real_escape_string($prop->gardenSize));
			$description = utf8_decode($this->db->dbcon->real_escape_string($prop->description));
			$status = utf8_decode($this->db->dbcon->real_escape_string($prop->status));


			$sql = "UPDATE `property` SET `iduser`='$idUser', `price`='$price', `type`='$type', `street`='$street', `address2`='$address2', `town`='$town' , `country`='$country', `postcode`='$postCode', `bedrooms`='$bedrooms', `bathrooms`='$bathrooms' , `garden`='$gardenSize' , `description`='$description' , `status`='$status'  WHERE `id`='$id'" ;




		//	echo $sql ;

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			return true ;
		}





		function storeImage($prop , $imgPath){

			$sql = "INSERT INTO `images` ( `propid` , `path` ) VALUES ('$prop->id' , '$imgPath')";

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}


		}


		function searchProperties($sql){


			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			if ( $res->num_rows === 0 ){
				return  0 ;
			} else {

				return $res ;


		}

		}

		function loadProperty($propId){
			$sql = "SELECT * FROM `property` WHERE `property_id`='$propId' AND `status` != 5" ;

		//	echo '<br>'.$sql.'<br>' ;


			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			if ( $res->num_rows === 0 ){
				echo "No results ! <br>";
			} else {
				//load all property detail

				$linea = $res->fetch_assoc() ;
				$prop['values'] = $linea;
				/*$uid = $linea['user_id'];
				$price = $linea['price'] ;
				$type = $linea['type'];
				$street = $linea['street'];
				$address = $linea['address'];
				$town = $linea['town'];
				$country = $lineap['country'];
				$postcode = $linea['postcode'];
				$bedrooms = $linea['bedrooms'];
				$bathrooms = $linea['bathrooms'];
				$garden = $linea['garden'];
				$description = $linea['description'];
				$status = $linea['status'] ;

				*/
				//load images

				//$prop = new Property($uid , $price , $type , $street , $address , $town , $country , $postcode , $bedrooms , $bathrooms , $garden , $description , $status);


				$sqlimg = "SELECT * FROM `images` WHERE `property_id` = '$propId' AND `status` = 1 ";
				if ( ! ($resimg = $this->db->query($sqlimg))){
					echo "Errors in query ! ";
					return false ;
				} else {

					//load images
					while ($linimg = $resimg->fetch_assoc()) {
						$prop['images'][] = $linimg['image_name'];
						$prop['images_id'][] = $linimg['images_id'];
					}
				}


				return $prop ;

			}

						return false ;
		}




		function getPropImages($propID){


			//$string = strtoupper($string);
			$sql =  "SELECT * FROM `images` WHERE `property_id` = '$propID'  AND `status` = 1 ";



			$res = $this->db->query($sql) ;

			$images = array();

			while ($row = $res->fetch_assoc()) {

				$images[] = $row['image_name'];

			}

			return $images ;

		}



	function getHouseType($x){

		switch($x){

			case 1:
				return 'House Detached';

			case 2:
				return 'Semi-Detached';

			case 3:
				return 'Mid Terraced';

			case 4:
				return 'End Terraced';

			case 5:
				return 'Flat';

			case 6:
				return 'Cottage';

			case 7:
				return 'Bungalow';

			case 9:
				return 'Studio Flat';

			case 10:
				return 'Studio Flat';

		}

	}



function getUserEmailAddress($uid){
			$sql = "SELECT * from `users` WHERE `user_id`='$uid'" ;

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			$row = $res->fetch_assoc() ;

			return $row['user_email'] ;

}


function sendConfirmationMessageEmail($idS  , $idR  ,  $subj , $msg){

	//get receiver email
	$recv = $this->getUserEmailAddress($idR);
	$usernameSender = $this->getUsername($idS);


$message =
"Hello \n
	You received a message SUBJECT : ".$subj." from ".$usernameSender."

 ".$msg."

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE.
***DO NOT RESPOND TO THIS EMAIL****
";

	mail($recv, "Message Received", $message,
    "From: \"Message Confirmation\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());



}




	function startThreadMessage($mess){

		$threadId = $this->db->dbcon->real_escape_string($mess->threadID);
		$idS = $this->db->dbcon->real_escape_string($mess->sender);
		$idR = $this->db->dbcon->real_escape_string($mess->receiver);
		$msg =  $this->db->dbcon->real_escape_string($mess->msg);
		$subj = $this->db->dbcon->real_escape_string($mess->subject);


		$description = nl2br(str_replace('\\r\\n', "\r\n", $msg));
		echo  $description;

		$property  = $this->db->dbcon->real_escape_string($mess->property);
		$stat = 0 ; // new message

		$sql = "INSERT INTO `message` (`threadID` , `receiver`, `sender`, `subject` , `msg`, `property`, `sdate`, `status` ) " ;
		$sql .= "VALUES ('$threadId' , '$idR' , '$idS',  '$subj' , '$description' ,  '$property' , NOW() ,'$stat')" ;


		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		$this->sendConfirmationMessageEmail($idS , $idR , $mess->subject , $mess->msg);

		return true ;

	}


	function replyMessage($mess , $newmsg){

		$threadId = $this->db->dbcon->real_escape_string($mess->threadID);
		$idR = $this->db->dbcon->real_escape_string($mess->sender);
		$idS = $this->db->dbcon->real_escape_string($mess->receiver);
		$msg = $this->db->dbcon->real_escape_string($newmsg);
		$subj = $this->db->dbcon->real_escape_string($mess->subject);



		$property  = $this->db->dbcon->real_escape_string($mess->property);
		$stat = 0 ; // new message

		$sql = "INSERT INTO `message` (`threadID` , `receiver`, `sender`, `subject` , `msg`, `property`, `sdate`, `status` ) " ;
		$sql .= "VALUES ('$threadId' , '$idR' , '$idS',  '$subj' , '$msg' ,  '$property' , NOW() ,'$stat')" ;


		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		//update the initial message status as REPLIED

		$sqlup = "UPDATE `message` SET `status`=2 WHERE `id`='".$mess->id."'";
		if ( ! ($res = $this->db->query($sqlup))){
				echo "Errors in query ! ";
				return false ;
		}


		$this->sendConfirmationMessageEmail($idS , $idR , $mess->subject , $mess->msg);

		return true ;

	}




	function getMessages($iduser){

		$sql = "SELECT * FROM `message` WHERE `receiver` = '$iduser' OR `sender` = '$iduser' " ;

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		} else {

			return $res ;

		}


	}


			/*
				Function to display just the threads messages ( newest messages  )
		*/


	function getAllMessagesByThreadId($iduser){


		$sql = "SELECT  * FROM `message` WHERE `receiver_id` = '$iduser' OR `sender_id` = '$iduser' ORDER BY `send_date` DESC " ;

		if ( ! ($res = $this->db->query($sql))){
				//echo "Errors in query ! ";
				return false ;
		} else {

			return $res ;

		}


	}



	function getMessagesByThreadId($idt){

		$sql = "SELECT * FROM `message` WHERE `message_thread` = '$idt' ORDER BY `send_date` DESC" ;

	//	echo $sql ."<br>";

	if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		} else {

			return $res ;

		}


	}

	function updateMessageStatus($threadid){

		$sql = "UPDATE `message` SET `received_date`='".date('y-m-d')."',`viewedstatus`=2 WHERE `message_thread`='".$threadid."'" ;

	//	echo $sql ."<br>";

	if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		} else {

			return true ;

		}


	}



	function loadMessage($idmsg){


		$sql = "SELECT * FROM `message` WHERE `id` = '$idmsg'";

		$ms = new stdClass();

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		if ( $res->num_rows === 0 ){
				echo "No Message results ! <br>";
		} else {
			//load all property detail

			$linea = $res->fetch_assoc() ;

			$ms->id = $linea['id'] ;
			$ms->threadID = $linea['threadID'] ;
			$ms->receiver = $linea['receiver'] ;
			$ms->sender = $linea['sender'];
			$ms->subject = $linea['subject'] ;
			$ms->msg = $linea['msg'] ;
			$ms->sentDate = $linea['sdate'] ;
			$ms->property = $linea['property'] ;
			$ms->status = $linea['status'] ;




		}


		//update the message status as READ
		if ($ms->status  == 0 ){
			$sqlup = "UPDATE `message` SET `status`=1 WHERE `id`='".$idmsg."'";
			if ( ! ($res = $this->db->query($sqlup))){
					echo "Errors in query ! ";
					return false ;
			}

			$ms->status = 1 ; // read
		}
		return $ms ;

	}

	function getPropertyOwner($propId){

			$sql = "SELECT * from `property` WHERE `property_id`='$propId'  AND `status` != 5" ;

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			$row = $res->fetch_assoc() ;

			return $row['iduser'] ;


	}


	function getUsername($uid){

			$sql = "SELECT * from `users` WHERE `user_id`='$uid'" ;

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			$row = $res->fetch_assoc() ;

			return $row['user_name'] ;


	}


	//load user by email address
		function getUserByEmail($email , $fbid){

			$sql = "SELECT * from `users` WHERE `user_email`='$email'" ;

			if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

			if ($res->num_rows == 1){
				$row = $res->fetch_assoc() ;
				$fid = $row['fbid'] ;
				$ud = $row['user_id'];

				if ($fid == '' ) {
					//update the fbid
					$sqlUpdate = "update `users` set `fbid`='".$fbid."' where user_id='$ud'" ;
					if ( ! ($res = $this->db->query($sqlUpdate))){
						echo "Errors in query ! ";
						//return false ;
					}
				}
				return $row ;
			} else
				return false ;

	}



	function getFBUserByUid($uid){
		$sql = "select * from `fbtest` where id='$uid'";

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

		$row = $res->fetch_assoc() ;

		return $row ;

	}

	function executeSQL($sql){
		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}
		return true ;
	}

	function getFBUserByFBid($facebook_id){
		$sql = "select * from `fbtest` where `facebook_id`='$facebook_id'" ;

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

		return $res ;

	}


	function storeFBUser($email , $facebook_id , $name ){

		$sql_insert = "INSERT into `users`
  			(`full_name`,`user_email`, `status`, `fbid`
			)
		    VALUES
		    ('$name' , '$email' , 1 , '$facebook_id'
			)
			";


		if ( ! ($res = $this->db->query($sql_insert))){
				echo "Errors in query ! ";
				return false ;
		}

		//get ID property
		$uID = $this->db->dbcon->insert_id ;
		//mysqli_query($link,$sql_insert) or die("Insertion Failed:" . mysqli_error());

		$md5_id = md5($uID);

		$sqlUpdate = "update users set verificationlink='$md5_id' where user_id='$uID'" ;
		if ( ! ($res = $this->db->query($sqlUpdate))){
				echo "Errors in query ! ";
				return false ;
		}



		//return the added record from db

		$sql = "select * from `users` where `user_id`='$uID'" ;


		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
			}

		if ($res->num_rows == 1){
				$row = $res->fetch_assoc() ;

				return $row ;
		} else
				return false ;



	}


	function getPrediction($key){
		$sql = "SELECT * from `property` WHERE `town` LIKE '%{$key}%'";

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

	function getLocations($key){
		$sql = "SELECT * from `property` WHERE `town` LIKE '%{$key}%' OR `country` LIKE '%{$key}%' OR `postcode` LIKE '%{$key}%'";

		$array = array();
		$array1 = array();

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);

		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['town'], $array1) && !in_array($row['country'], $array1) )
			{
				$array1[] = $row['town'];
				$array1[] = $row['country'];

				$array[] = $row['town'].','.$row['country'];
			}
		}


		return $array;

	}

	function getPostcode($key){
		$sql = "SELECT * from `property` WHERE `town` LIKE '%{$key}%' OR `country` LIKE '%{$key}%' OR `postcode` LIKE '%{$key}%'";

		$array = array();
		$array1 = array();

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);

		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['postcode'], $array1)  )
			{
				$array1[] = $row['postcode'];
				$array1[] = $row['country'];

				$array[] = $row['postcode'];
			}
		}
		return $array;

	}


		function getLocationsFull($key){
		$sql = "SELECT * from `property` WHERE `town` LIKE '%{$key}%' OR `country` LIKE '%{$key}%' OR `postcode` LIKE '%{$key}%' OR `address2` LIKE '%{$key}%' OR `street` LIKE '%{$key}%'";

		$array = array();
		$array1 = array();

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}

		//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);

		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['town'], $array1) && !in_array($row['address2'], $array1) && !in_array($row['street'], $array1) && !in_array($row['country'], $array1) )
			{
				$array1[] = $row['town'];
				$array1[] = $row['country'];

				$array[] = $row['address2'].','.$row['street'].','.$row['town'].','.$row['country'];
			}
		}


		return $array;

	}




	function getLocationsForSuggest($key){
		$sql = "SELECT * from `property` WHERE `town` LIKE '%{$key}%'";

		$array = array();

		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}
				//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);

		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['town'], $array))
			$array[] = $row['town'];
		}

		$sql = "SELECT * from `property` WHERE `country` LIKE '%{$key}%'";
		if ( ! ($res = $this->db->query($sql))){
				echo "Errors in query ! ";
				return false ;
		}
				//$file = fopen('logs.txt' , 'a');
		//fwrite($file , $sql.PHP_EOL);

		while($row = $res->fetch_assoc())
		{
			if(!in_array($row['country'], $array))
			$array[] = $row['country'];
		}


		$sql = "SELECT * from `property` WHERE `postcode` LIKE '%{$key}%'";
		if ( ! ($res = $this->db->query($sql))){
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

	}

	/*
	   Search by distance using Google Maps API

	*/

	// Haversine formula
function Haversine($start, $finish) {

	$theta = $start[1] - $finish[1];
	$distance = (sin(deg2rad($start[0])) * sin(deg2rad($finish[0]))) + (cos(deg2rad($start[0])) * cos(deg2rad($finish[0])) * cos(deg2rad($theta)));
	$distance = acos($distance);
	$distance = rad2deg($distance);
	$distance = $distance * 60 * 1.1515;

	return round($distance, 2);

}

// Get lat/long co-ords
function getLatLong($address) {

	$address = str_replace(' ', '+', $address);
	$address = str_replace(',', '+', $address);
	$url = 'http://maps.googleapis.com/maps/api/geocode/json?address='.$address.'&sensor=false';

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	$geoloc = curl_exec($ch);

	$json = json_decode($geoloc);
	return array($json->results[0]->geometry->location->lat, $json->results[0]->geometry->location->lng);

}

function isPropertyInRange($fixed  , $myadd  , $distanceRange ){
	$start = $this->getLatLong($fixed);
	$finish = $this->getLatLong($myadd);

	$distance = $this->Haversine($start, $finish);

	$f = fopen('dist.txt' , 'a');
	fwrite($f , $distance .PHP_EOL);
	fclose($f);
echo "distance" . $distance;
die();
	if ($distance <= $distanceRange )
		return true ;

	return false ;
}

}
?>
