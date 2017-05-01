<?php
		include 'dbc.php';
		page_protect();


		include 'includes/myaccount-header.html';

require_once 'dbapi.php';
require_once 'property.php';

$dbc = new DBAPI();



	$idp = $_POST['idprop'];
	$userID = $_POST['userID'];



	//get the message details add them to the database

	//get the idprop owner
	$idrecev = $dbc->getPropertyOwner($idp);

	$detail = htmlspecialchars($_POST['detail']);



	$msgSubject ='Subject ';//$_POST['subject'];


	//create a new Thread Message
	//$threadId = $dbc->createMessageThread($msgSubject) ;
	$threadID = uniqid($idrecev.'_'.$userID.'_'.$idp.'_' , true);

	$msg = new Message($threadID , $idrecev , $userID , $msgSubject , $detail , $idp ) ;

	if ( $dbc->startThreadMessage($msg) )

		$success = true ;

	else
		$success = false ;


// Return an appropriate response to the browser
if ( isset($_GET["ajax"]) ) {
  echo $success ? "success" : "error";
} else {
?>
<html>
  <head>
    <title>Thanks!</title>
  </head>
  <body>
  <?php if ( $success ) echo "<p>Thanks for sending your message! We'll get back to you shortlydfskdfjksdfjksdjfksdj.</p>" ?>
  <?php if ( !$success ) echo "<p>There was a problem sending your message. Please try again llllllllallalalal .</p>" ?>
  <p>Click your browser's Back button to return to the page.</p>
  </body>
</html>
<?php
}
?>


?>
