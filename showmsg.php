<?php 
include 'dbc.php';
page_protect();
include 'includes/myaccount-header.html';
 
$rs_settings = mysqli_query($link,"select * from users where id='$_SESSION[user_id]'"); 

$userID = $_SESSION[user_id]   ; 

require_once './dbapi.php';
require_once './property.php';

$dbc = new DBAPI();

  if( isset($_GET['idmsg']) )
  	$idMesg = 	$_GET['idmsg'] ;
	
    $ms = $dbc->loadMessage($idMesg);


$msgcontent = nl2br(str_replace('\\r\\n', "\r\n", $ms->msg));
//echo  $description; 	

 echo  "<table border='1'>"; 
 echo '<tr><td><h1><b>  From : </b></h1></td><td><i>'.$dbc->getUsername($ms->sender).'</i></td></tr>';
 echo "<tr><td><h1><b>  Subject : </b></h1></td><td><i>".$ms->subject."</i></td></tr>";
 echo "<tr><td><h1><b>  Message : </b></h1></td>";
 echo "<td><i>".$msgcontent."</i></td></tr>";
echo '</table>';	


  if ( isset($_POST['reply_msg'])){
  
  		if ( $dbc->replyMessage($ms , $_POST['message']))
	
		echo "Reply sent ! ! "  ;
	
		else 
			echo "Error occured ! " ;  	
	
  
  }



if ($ms->sender != $userID ) //received message -> print Reply to Form 



	
echo '




	
<form id="contactForm1" action="" method="post">

  <h2>Reply </h2>

  <ul>

    <li>
      <label for="message" style="padding-top: .5em;">Your Message</label>
      <textarea name="message" id="message" placeholder="Please type your message" required="required" cols="60" rows="10" maxlength="10000"></textarea>
    </li>

  </ul>

  <div id="formButtons">
    <input type="submit" id="reply_msg" name="reply_msg" value="Send" />

  </div>


';

	
?>



    

	   <?php include ('includes/footer.html') ; ?>
	  

</body>
</html>
