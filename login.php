<?php
/*************** PHP LOGIN SCRIPT V 2.3*********************
(c) Balakrishnan 2009. All Rights Reserved

Usage: This script can be used FREE of charge for any commercial or personal projects. Enjoy!

Limitations:
- This script cannot be sold.
- This script should have copyright notice intact. Dont remove it please...
- This script may not be provided for download except from its original site.

For further usage, please contact me.

***********************************************************/
include 'dbc.php';

require_once 'user.php' ;

$err = array();

foreach($_GET as $key => $value) {
	$get[$key] = filter($value); //get variables are filtered.
}


if (isset($_POST['doLogin']) && $_POST['doLogin']=='Login')
{

foreach($_POST as $key => $value) {
	$data[$key] = filter($value); // post variables are filtered
}




$user_email = $data['usr_email'];
$pass = $data['pwd'];
$user_ip = $_SERVER['REMOTE_ADDR'];

if (strpos($user_email,'@') === false) {
    $user_cond = "user_name='$user_email'";
} else {
      $user_cond = "user_email='$user_email'";

}


$result = mysqli_query($link,"SELECT `user_id`,`password`,`full_name`,`status`,`user_email` FROM users WHERE
           $user_cond
			AND `banned` = '0'
			") or die (mysqli_error());
$num = mysqli_num_rows($result);

  // Match row found with more than 1 results  - the user is authenticated.
    if ( $num > 0 ) {

	list($id,$pwd,$full_name,$status,$user_email) = mysqli_fetch_row($result);

	if($status == 0) {
	//$msg = urlencode("Account not activated. Please check your email for activation code");
	$err[] = "Account not activated. Please check your email for activation code";

	//header("Location: login.php?msg=$msg");
	 //exit();
	 }

		//check against salt
	if ($pwd === PwdHash($pass,substr($pwd,0,9))) {
	if(empty($err)){

     // this sets session and logs user in
       session_start();
	   session_regenerate_id (true); //prevent against session fixation attacks.

	   // this sets variables in the session
		$_SESSION['user_id']= $id;
		$_SESSION['user_name'] = $full_name;
		$_SESSION['user_level'] = $user_level;
		$_SESSION['user_email'] = $user_email;
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);


		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
		//mysqli_query($link,"update login_history set `ctime`='$stamp', `ckey` = '$ckey' where id='$id'") or die(mysqli_error());


		// set login history


		$sql_insert = "INSERT into `login_history`
  			(`user_id`,`user_ip`,`login_date`)
		    VALUES ('$id','$user_ip','".date("Y-m-d H:i:s")."')";
			mysqli_query($link,$sql_insert) or die("Insertion Failed:" . mysqli_error());




		//set a cookie



	   if(isset($_POST['remember'])){
				  setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
				  setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");
				  setcookie("user_name",$_SESSION['user_name'], time()+60*60*24*COOKIE_TIME_OUT, "/");
				   }
		  header("Location: myaccount.php");
		 }
		}
		else
		{
		//$msg = urlencode("Invalid Login. Please try again with correct user email and password. ");
		$err[] = "Invalid Login. Please try again with correct user email and password.";
		//header("Location: login.php?msg=$msg");
		}
	} else {
		$err[] = "Error - Invalid login. No such user exists";
	  }
}


include 'includes/headerindex.php';


?>
<div class=" bg-image-fixed">
<div class="container">
<br />
      <span style="font-size:24px; text-align:center" class="form-back" >Login Users </span>
	  <p>
	  <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages
	  **************************************************************************/
	  if(!empty($err))  {
	   echo "<div class=\"msg form-back\">";
	  foreach ($err as $e) {
	    echo "$e <br>";
	    }
	  echo "</div>";
	   }
	  /******************************* END ********************************/
	  ?></p><br />
      <form action="login.php" method="post" name="logForm" id="logForm" class="form-back" >
        <br/>
        <div class="col-xs-12 ">
        	<center><div class="col-xs-6 col-sm-offset-3 selectContainer">
            <label for="usr_email">Username / Email</label>
            <input name="usr_email" type="text" class=" form-control required" id="txtbox" size="25">
            </div></center>
            </div>

            <div class="col-xs-12 ">
        	<center><div class="col-xs-6 col-sm-offset-3 selectContainer">
            <label for="usr_email">Password</label>
            <input name="pwd" type="password" class="form-control required password" id="txtbox" size="25"></td>
          	</div></center>
            </div>


            <div align="center">
                <input name="remember" type="checkbox" id="remember" value="1">
                Remember me</div>
                <div align="center">
                <br />
                <p>
                  <input name="doLogin"  class="btn viewfull" type="submit" id="doLogin3" value="Login">
                  <a class=" btn viewfull" style="color:#333333" href="register.php">Register Free</a>
                </p>
                <br />
				<p>
					 <a href="https://www.facebook.com/dialog/oauth?client_id=831669323513345&redirect_uri=http://www.propertywing.co.uk/new/facebook_auth.php&scope=publish_stream,email" title="Sign In with Facebook"><img src="images/facebook-login.png" style="width:200px;"></a> <br />
				</p>
                <br />
                <p> <a style="color:#333333" href="forgot.php">Forgot Password</a> <font color="#FF6600">
                  </font></p>

              </div>
        <div align="center"></div>
        <br />
      </form>

	<br />
    <br />
    <br />
    <br />


</div>
</div>

<?php include 'footer.php';?>

<script>
  document.title = "Login to enjoy the full freedom of propertywing";
</script>
</body>
</html>
