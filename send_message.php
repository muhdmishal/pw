<?php

include 'dbc.php';
page_protect();
include 'includes/myaccount-header.html';
 
$rs_settings = mysqli_query($link,"select * from users where id='$_SESSION[user_id]'"); 


require_once './dbapi.php';
require_once './property.php';

$dbc = new DBAPI();



	$idp = $_GET['idprop'];
	$userID = $_SESSION[user_id] ; 
	
	echo "Send a mesage related to PROP ID " . $_GET['idprop'];
	
	//get the message details add them to the database 
	
	//get the idprop owner 
	$idrecev = $dbc->getPropertyOwner($idp); 

	$detail = htmlspecialchars($_POST['detail']);
	
	echo "Message to send " . $detail ."<br />";
	
	
	$msgSubject = $_POST['subject'];
	
	
	//create a new Thread Message
	//$threadId = $dbc->createMessageThread($msgSubject) ; 
	$threadID = uniqid($idrecev.'_'.$userID.'_'.$idp.'_' , true);
	
	$msg = new Message($threadID , $idrecev , $userID , $msgSubject , $detail , $idp ) ; 
	
	if ( $dbc->startThreadMessage($msg) ) 
	
		echo "Start Thread Message ! "  ;
	
	else 
		echo "Error occured ! " ;  
	
	
	
	
	
	
	

?>
 <?php include 'footer.php';?> 
