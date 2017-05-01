<?php 
include 'dbc.php';
page_protect();
include 'includes/header1.php';
 
$rs_settings = mysqli_query($link,"select * from users where `user_id`='$_SESSION[user_id]'"); 




require_once './dbapi.php';

require_once './property.php';



$dbc = new DBAPI();





$userID = $_SESSION['user_id'] ; 



//load users messages 



$messages  = $dbc->getAllMessagesByThreadId($userID) ; 


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
    <div class="row">
    <br />
  
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
        <div class="row"> <a href="messages.php">
          <input type="submit" name="submit" id="submit" value="Inbox" class="btn btn-info  msg-btn">
          </a> 
          <a href="contact-solicitor.php"><input type="submit" name="submit" id="submit" value="Contact Solicitor" class="btn btn-info msg-btn"></a>
           <a href="contact-mortgage.php"><input type="submit" name="submit" id="submit" value="Contact Mortgage Broker" class="btn btn-info msg-btn"></a> 
          <table class="table message1">
            <thead>
              <tr>
                <th>From</th>
                <th>Subject</th>
                <th>Received</th>
                <th>View Message</th>
              </tr>
            </thead>
            <?php

$output = '';

$array[] = '';

while ($linea = $messages->fetch_assoc()) {

		$msgid = $linea['message_id'] ; 

		$threadid = $linea['message_thread'];
			
			if(in_array($linea['message_thread'], $array))
			continue;
			
		$array[] = $linea['message_thread'];
		
		$out = '<tbody class="email-table"><tr><td>'.$dbc->getUsername($linea['sender_id']).'</td>';

		$out .= '<td> '.$linea['message_subject'].'</td>';

		$sent = $linea['send_date'];

		$out .= '<td > '.$sent.'</td>';

		$out .= '<td><a href="showthreadid.php?threadid='.$threadid.'"> View Messages</td></tr></tbody></a>';

		

		$out .= "";

		

		$output .= $out ; 

}



echo $output ; 
?>
          </table>
        </div>
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
<script>
  document.title = "Messages";
</script>
</body>
</html>
