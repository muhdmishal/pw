<?php



		require_once ('./dbc.php');
		require_once ('./dbapi.php');


/******************* ACTIVATION BY FORM**************************/
if ($_POST['doReset']=='Reset')
{

  echo "working 1";
$err = array();
$msg = array();

foreach($_POST as $key => $value) {
  echo "working foreach";
	$data[$key] = filter($value);
}
if(!isEmail($data['user_email'])) {
  echo "working error";
$err[] = "ERROR - Please enter a valid email";
}

$user_email = $data['user_email'];
echo "working 2";
//check if activ code and user is valid as precaution
$rs_check = mysqli_query($link,"select user_id from users where user_email='$user_email'") or die (mysqli_error());
$num = mysqli_num_rows($rs_check);
  // Match row found with more than 1 results  - the user is authenticated.
    if ( $num <= 0 ) {
      echo "working 3";
	$err[] = "Error - Sorry no such account exists or registered.";
	//header("Location: forgot.php?msg=$msg");
	//exit();
	}


if(empty($err)) {
echo "working 4";
$new_pwd = GenPwd();
$pwd_reset = PwdHash($new_pwd);
//$sha1_new = sha1($new);
//set update sha1 of new password + salt
$rs_activ = mysqli_query($link,"update users set password='$pwd_reset' WHERE
						 user_email='$user_email'") or die(mysqli_error());

$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);

//send email
echo "working 5";
$message =
"Here are your new password details ...\n
User Email: $user_email \n
Passwpord: $new_pwd \n

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE.
***DO NOT RESPOND TO THIS EMAIL****
";

	mail($user_email, "Reset Password", $message,
    "From: \"Member Registration\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());

$msg[] = "Your account password has been reset and a new password has been sent to your email address.";
echo "working 6";
//$msg = urlencode();
//header("Location: forgot.php?msg=$msg");
//exit();
 }
}
die();
include 'includes/headerindex.php';
?>

<div class=" bg-image-fixed">
<br /><br /><br />
<div class="container">
    <div class="col-sm-12">
    	<div class="col-sm-12 form-back">
			<span style="font-size:24px" >Forgot Password</span><br />

      <p>
        <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages
	  **************************************************************************/
	if(!empty($err))  {
	   echo "<div class=\"msg \">";
	  foreach ($err as $e) {
	    echo "* $e <br>";
	    }
	  echo "</div>";
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"msg\">" . $msg[0] . "</div>";

	   }
	  /******************************* END ********************************/
	  ?>
      </p>
      <p>If you have forgot the account password, you can <strong>reset password</strong>
        and a new password will be sent to your email address.</p>
	 	</div>
      <form action="forgot.php" method="post" name="actForm" id="actForm" >
       <div class="col-sm-12 form-back">
        <div class="col-xs-12 selectContainer">
        <label for="InputName">Your Email</label>
        <input name="user_email" type="text" class="required email add-property-input form-control" id="txtboxn" size="30">
        </div>
        <div align="center"><input name="doReset" type="submit" id="doLogin3" class="button btn viewfull" value="Reset"> </div>

       </div>
      </form>
</div>
</div>
<br /><br /><br /><br /><br />
</div>
<?php include 'footer.php';?>
<script>
	  document.title = "Propertywing :: Forgot Password";

</script>
