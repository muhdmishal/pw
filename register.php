<?php 
/*************** PHP LOGIN SCRIPT V 2.0*********************
***************** Auto Approve Version**********************
(c) Balakrishnan 2009. All Rights Reserved

Usage: This script can be used FREE of charge for any commercial or personal projects.

Limitations:
- This script cannot be sold.
- This script may not be provided for download except on its original site.

For further usage, please contact me.

***********************************************************/


include 'dbc.php';

$err = array();
					 
if($_POST['doRegister'] == 'Register') 
{ 
/******************* Filtering/Sanitizing Input *****************************
This code filters harmful script code and escapes data of all POST data
from the user submitted form.
*****************************************************************/
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}

/********************* RECAPTCHA CHECK *******************************
This code checks and validates recaptcha
****************************************************************/
 require_once('recaptchalib.php');
     
      $resp = recaptcha_check_answer ($privatekey,
                                      $_SERVER["REMOTE_ADDR"],
                                      $_POST["recaptcha_challenge_field"],
                                      $_POST["recaptcha_response_field"]);

      if (!$resp->is_valid) {
        die ("<h3>Image Verification failed!. Go back and try again.</h3>" .
             "(reCAPTCHA said: " . $resp->error . ")");			
      }
/************************ SERVER SIDE VALIDATION **************************************/
/********** This validation is useful if javascript is disabled in the browswer ***/

if(empty($data['full_name']) || strlen($data['full_name']) < 4)
{
$err[] = "ERROR - Invalid name. Please enter atleast 3 or more characters for your name";
//header("Location: register.php?msg=$err");
//exit();
}

// Validate User Name
if (!isUserID($data['user_name'])) {
$err[] = "ERROR - Invalid user name. It can contain alphabet, number and underscore.";
//header("Location: register.php?msg=$err");
//exit();
}

// Validate Email
if(!isEmail($data['usr_email'])) {
$err[] = "ERROR - Invalid email address.";
//header("Location: register.php?msg=$err");
//exit();
}
// Check User Passwords
if (!checkPwd($data['pwd'],$data['pwd2'])) {
$err[] = "ERROR - Invalid Password or mismatch. Enter 5 chars or more";
//header("Location: register.php?msg=$err");
//exit();
}
	  
$user_ip = $_SERVER['REMOTE_ADDR'];

// stores sha1 of password
$sha1pass = PwdHash($data['pwd']);

// Automatically collects the hostname or domain  like example.com) 
$host  = $_SERVER['HTTP_HOST'];
$host_upper = strtoupper($host);
$path   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');

// Generates activation code simple 4 digit number
$activ_code = rand(1000,9999);

$usr_email = $data['usr_email'];
$user_name = $data['user_name'];

/************ USER EMAIL CHECK ************************************
This code does a second check on the server side if the email already exists. It 
queries the database and if it has any existing email it throws user email already exists
*******************************************************************/

$rs_duplicate = mysql_query("select count(*) as total from users where user_email='$usr_email' OR user_name='$user_name'") or die(mysql_error());
list($total) = mysql_fetch_row($rs_duplicate);

if ($total > 0)
{
$err[] = "ERROR - The username/email already exists. Please try again with different username and email.";
//header("Location: register.php?msg=$err");
//exit();
}
/***************************************************************************/

if(empty($err)) {

$sql_insert = "INSERT into `users`
  			(`full_name`,`user_email`,`password`,`user_address`,`user_phone`,`created_date`,`updated_date`,`user_ip`,`verificationcode`,`user_name`
			)
		    VALUES
		    ('$data[full_name]','$usr_email','$sha1pass','$data[address]','$data[tel]'
			,'".date("Y-m-d H:i:s")."','".date("Y-m-d H:i:s")."','$user_ip','$activ_code','$user_name'
			)
			";
	
mysql_query($sql_insert,$link) or die("Insertion Failed:" . mysql_error());
$user_id = mysql_insert_id($link);  
$md5_id = md5($user_id);
mysql_query("UPDATE `users` SET verificationlink='".$md5_id."' where user_id='".$user_id."'") or die("Insertion Failed:" . mysql_error());
//	echo "<h3>Thank You</h3> We received your submission.";

if($user_registration)  {
$a_link = "
*****ACTIVATION LINK*****\n
http://$host$path/activate.php?user=$md5_id&activ_code=$activ_code
"; 
} else {
$a_link = 
"Your account is *PENDING APPROVAL* and will be soon activated the administrator.
";
}

$message = 
"Hello \n
Thank you for registering with us. Here are your login details...\n

User ID: $user_name
Email: $usr_email \n 
Password: $data[pwd] \n

Activation Code: $activ_code\n

Please click the below link and enter your username and this activation code.

$a_link

Thank You

Administrator
$host_upper
______________________________________________________
THIS IS AN AUTOMATED RESPONSE. 
***DO NOT RESPOND TO THIS EMAIL****
";

	mail($usr_email, "Login Details", $message,
    "From: \"Member Registration\" <auto-reply@$host>\r\n" .
     "X-Mailer: PHP/" . phpversion());

  header("Location: thankyou.php");  
  exit();
	 
	 } 
 }					 
include 'includes/header1.php'
?>
<html>
<head>
<title>PHP Login :: Free Registration/Signup Form</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>

  <script>
  $(document).ready(function(){
    $.validator.addMethod("username", function(value, element) {
        return this.optional(element) || /^[a-z0-9\_]+$/i.test(value);
    }, "Username must contain only letters, numbers, or underscore.");

    $("#regForm").validate();
  });
  </script>

<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class=" bg-image-fixed">
<div class="container">
	<?php 
	 if (isset($_GET['done'])) { ?>
	  <h2>Thank you</h2> Your registration is now complete and you can <a href="login.php">login here</a>";
	 <?php exit();
	  }
	?></p>
     <h3 class="form-back" style="font-size:24px !important; color:#000000;">Free Registration / Signup</h3>
      <p class="form-back">Please register a free account, before you can start posting your ads. 
        Registration is quick and free! Please note that fields marked <span class="required">*</span> 
        are required.</p>
	 <?php	
	 if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "* $e <br>";
	    }
	  echo "</div>";	
	   }
	 ?> 
<div  class="col-xs-12 form-back">
 
	  <br>
     <form action="register.php" method="POST" name="regForm" id="regForm" >
        <div class="col-xs-6 selectContainer">
                                    <label for="full_name">Your Name</label>
                                    
                                    <input name="full_name" type="text" id="full_name" size="40" class="form-control required" placeholder="Your Name"></td>
          </div>
          
             <div class="col-xs-6 selectContainer">
                                    <label for="tel">Phone</label>
                                   
                                       <input type="text" class="form-control required" placeholder="Your Phone" name="tel" id="tel">
         </div>
           <h4  style="font-size:24px !important; color:#000000; text-align:center;">Login Details</h4>
              <div class="row">
          <div class="col-xs-6 selectContainer">
                                    <label for="user_name">Username</label>
            						<div class="input-group">
                                    <input name="user_name" type="text" id="user_name" class="form-control required" minlength="5" > 
              						<div class="input-group-addon">
                                    <input name="btnAvailable" type="button" id="btnAvailable" style="border-color:transparent;"
			  onclick='$("#checkid").html("Please wait..."); $.get("checkuser.php",{ cmd: "check", user: $("#user_name").val() } ,function(data){  $("#checkid").html(data); });'
			  value="Check Availability"> </div>
              </div>
			    <span style="color:red; font: bold 12px verdana; " id="checkid" ></span> 
           </div>
            <div class="col-xs-6 selectContainer">
            <label for="usr_email">Your Email</label>
            <input name="usr_email" type="text" id="usr_email3" class="form-control required email"> 
              <span class="example"></span>
           </div>
           </div>
            <div class="row">
          <div class="col-xs-6 selectContainer">
            <label for="pwd">Password</label> 
            <input name="pwd" type="password" class="form-control required password" minlength="5" id="pwd"> 
              <span class="example"></span>
          </div>
            <div class="col-xs-6 selectContainer">
            <label for="pwd2">Retype Password</label> 
            <input name="pwd2"  id="pwd2" class="form-control required password" type="password" minlength="5" equalto="#pwd">
          </div>
          </div>
           <div class="row">
             <div class="col-xs-6 selectContainer">
            <label for="address">Address</label> 
            <textarea rows="6" id="address" class="form-control required" name="address"></textarea>
          </div>
           <div class="col-xs-6 selectContainer">
            <label for="pwd2">Image Verification </label>
            <div class="mobileadjust">
              <?php 
			require_once('recaptchalib.php');
			
				echo recaptcha_get_html($publickey);
			?>
            </div>
           </div>
          
           </div>
        <center>
          <input name="doRegister" type="submit" id="doRegister" value="Register" class="viewfull ">
        </center>
      </form>
</div>
</div></div>

<script>
  document.title = "Propertywing :: Register";
</script>
</body>
</html>
