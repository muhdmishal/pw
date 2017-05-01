<?php
include 'dbc.php';
page_protect();
include 'includes/header1.php';

$rs_settings = mysqli_query($link,"select * from users where `user_id`='$_SESSION[user_id]'");



require_once './dbapi.php';

require_once './property.php';



$dbc = new DBAPI();





$userID = $_SESSION[user_id] ;





$threadId = $_GET['threadid'];



$messages  = $dbc->getMessagesByThreadId( $threadId ) ;

$dbc->updateMessageStatus($threadId);



	if (isset($_POST['submit_msg'])){

		$host  = $_SERVER['HTTP_HOST'];
		//get the message details add them to the database

		//get the idprop owner

		//$idrecev = $dbc->getPropertyOwner($idp);





		$detail = htmlspecialchars($_POST['message']);




		$msgSubject = $_SESSION['subject'];
		$Email = $_SESSION['user_email'];






	mail($_SESSION['responderemail'], "Reply for your message on Propertywing : ".$msgSubject, $detail,
    "From: \"".$_SESSION['user_name']." via Propertywing\" <messages@$host >\r\n" .
     "X-Mailer: PHP/" . phpversion());

	 mail($Email , "Copy of your message in Propertywing: ".$msgSubject, $detail,
    "From: \"".$_SESSION['user_name']." via Propertywing\" <messages@$host >\r\n" .
     "X-Mailer: PHP/" . phpversion());

	 $message_thread = $threadId ;

	 $sql_insert = "INSERT INTO `message`( `message_thread`, `receiver_id`, `sender_id`, `sender_email`, `send_date`,`status`, `message_subject`, `message_content`,`viewedstatus`)
	 VALUES ('$message_thread','$_SESSION[responderid]','$_SESSION[user_id]','$Email','".date("Y-m-d H:i:s")."','1','$msgSubject','$detail','1')";

	if(mysqli_query($link,$sql_insert))
	{
		echo '<center><div class="container form-back">Your message send Successfully</div></center>';
	}


		//create a new Thread Message
		//$threadId = $dbc->createMessageThread($msgSubject) ;
		//$threadID = uniqid($idrecev.'_'.$userID.'_'.$idp.'_' , true);

		//$msg = new Message($threadID , $idrecev , $userID , $msgSubject , $detail , $idp ) ;



	}

/*

$out = '<table width="100% cellpadding="10" border="2" class="results-table">';



while ($field = $messages->fetch_field())

	$out .= "<b><th>".$field->name."</b></th>";



while ($linea = $messages->fetch_assoc()) {

		$msgid = $linea['id'] ;

		$out .= "<tr>";

		foreach ($linea as $valor_col)

			$out .= '<td>'.$valor_col.'</td>';

		$out .= '<td><a href="showmsg.php?idmsg='.$msgid.'"> View Message</a></td>';

		$out .= "</tr>";

}



$out .= "</table>";



echo $out ;



*/

?>
<div class=" bg-image-fixed">
<br />
<br />
<div class="container">
    <div class="col-sm-8">
    <div class="col-sm-12 form-back"> <span style="font-size:24px">My Inbox</span>

    </div>


    <div class="col-sm-12 form-back">
      <?php
/*********************** MYACCOUNT MENU ****************************
This code shows my account menu only to logged in users.
Copy this code till END and place it in a new html or php where
you want to show myaccount options. This is only visible to logged in users
*******************************************************************/
if (isset($_SESSION['user_id'])) {?>

<?php }
if (checkAdmin()) {
/*******************************END**************************/
?>

	  <?php } ?>

      <span style="font-size:24px">Welcome <?php echo $_SESSION['user_name'];?></span>


      <div class="row">
 <a href="messages.php"><input type="submit" name="submit" id="submit" value="Inbox" class="btn btn-info  msg-btn"></a>

  <a href="contact-solicitor.php"><input type="submit" name="submit" id="submit" value="Contact Solicitor" class="btn btn-info msg-btn"></a>
   <a href="contact-mortgage.php"><input type="submit" name="submit" id="submit" value="Contact Mortgage Broker" class="btn btn-info msg-btn"></a>

   <div class="col-xs-12 selectContainer">
   <br />
           <form role="form" action="" method="post" >




                 <label for="InputEmail">Reply</label>
                    <textarea name="message" class="basic-grey form-control" id="message" placeholder="Please type your message here" required="required"  rows="3"></textarea>

                  <input type="submit" class="button btn btn-info pull-right" id="submit_msg" name="submit_msg" value="Send" style="margin:10px;" />
                </form>
         </div>


      <?php

$output = '';

$useremail = "";

while ($linea = $messages->fetch_assoc()) {

		$msgid = $linea['message_id'] ;
		$_SESSION['responderemail'] = $linea['sender_email'];
		$_SESSION['responderid'] = $linea['sender_id'];
		$_SESSION['subject'] = $linea['message_subject'];
		$threadid = $linea['message_thread'];

		$out = '<div class="row"> <div class="col-sm-12"><b>From : </b>'.$dbc->getUsername($linea['sender_id']).'</div></div>';

		$out .= '<div class="row"><div class="col-sm-12"><b>Subject : </b>'.$linea['message_subject'].'</div></div>';

		$sent = $linea['send_date'];

		$out .= '<div class="row"><div class="col-sm-12"><b>Message : </b>'.$linea['message_content'].'</div></div>';

		$out .= '<div class="row"><div class="pull-right"><b>Date : </b>'.$sent.'</div></div> ';





		$out .= "<hr>";



		$output .= $out ;

}



echo $output ;
?>


</div>



 </div>




</div>
  <div class="col-sm-3">
     <?php
include ('sidebar.php') ;
?>
</div>

 <br />
  <br />
  <br />
  <br />
  <br />
  <br />
</div>
</div>
<?php include 'footer.php';?>

</body>
</html>
