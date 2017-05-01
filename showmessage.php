<?php
include 'dbc.php';
page_protect();
include 'includes/header1.php';

$rs_settings = mysqli_query($link,"select * from users where `user_id`='$_SESSION[user_id]'");


?>








<div class="container">


<?php

$userID = $_SESSION[user_id]   ;



require_once 'dbapi.php';

require_once 'property.php';



$dbc = new DBAPI();



  if( isset($_GET['idmsg']) )

  	$idMesg = 	$_GET['idmsg'] ;



    $ms = $dbc->loadMessage($idMesg);
?>

      <span class="title">My Inbox</span>


<?php

	echo " <div class='row'><div class='col-lg-7'>

  <a href='messages.php'><input type='submit' name='submit' id='submit' value='Inbox' class='btn btn-info  msg-btn'></a>
  <a href='sent-messages.php'><input type='submit' name='submit' id='submit' value='Sent Message' class='btn btn-info  msg-btn'></a>
  <input type='submit' name='submit' id='submit' value='Contact Solicitor' class='btn btn-info  msg-btn'>
  <input type='submit' name='submit' id='submit' value='Contact Mortgage Broker' class='btn btn-info  msg-btn'>
";

 echo "<form role='form' action='' method='post'>
     <div class='col-lg-10 form-back email-table'>";

 echo   "<div class='form-group'>
        <label for='InputName'>Received From :</label>
        <div class='input-group'>
          <div class='form-control'>".$dbc->getUsername($ms->sender)."</div>
          <span class='input-group-addon'></span></div>
      </div>";

echo      "<div class='form-group'>
        <label for='InputMessage'>Subject :</label>
        <div class='input-group'
> <div class='form-control'>".$ms->subject."</div>
          <span class='input-group-addon'></span></div>
      </div>";


echo      "<div class='form-group'>
        <label for='InputMessage'>Message :</label>
        <div class='input-group'>
 		<textarea class='form-control' rows='5'>".$ms->msg."</textarea>
          <span class='input-group-addon'></span></div>
      </div>";



echo "</div></form></div>";
?>
      <hr class="featurette-divider hidden-lg">
  <div class="col-lg-4 col-md-push-1">

   		<div class="section">
        	 <span class="title txttitle">My Account</span>

            <div class="footer-icon">
                 <a href="myaccount.php" class="footicon-text"><span class="ft-icon"><img src="images/user-ico.png" alt="map" /></span><strong>My Account Settings</strong></a>
            </div>

            <div class="footer-icon">
                 <a href="logout.php" class="footicon-text"><span class="ft-icon"><img src="images/log.png" alt="cell" /></span><strong>Log Out</strong></a>
            </div>
        </div>


  </div>
</div>
<?php
  if ( isset($_POST['reply_msg'])){



  		if ( $dbc->replyMessage($ms , $_POST['message']))



		echo "Reply sent ! ! "  ;



		else

			echo "Error occured ! " ;





  }







if ($ms->sender != $userID ) //received message -> print Reply to Form









echo '











<form id="contactForm1" action="" method="post" class="search-form" style="width:550px; margin-left:70px; background-color:#fff; float: left;">



  <h2 style="color:black; font-size:18pt;">Reply :</h2>



  <ul style="list-style:none;">



    <li >

      <label for="message" style="padding-top: .5em;"></label>

      <textarea name="message" id="message" placeholder="Please type your message" required="required" cols="60" rows="10" maxlength="10000" style="width:610px; margin-left:-40px;"></textarea>

    </li>



  </ul>



  <div id="formButtons">

    <input type="submit" class="button" id="reply_msg" name="reply_msg" value="Send" style="margin-left:0px;" />



  </div>





';





?>




</div>


<?php include 'footer.php';?>




</body>
</html>
