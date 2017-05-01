<?php
include 'dbc.php';


foreach($_GET as $key => $value) {
	$get[$key] = filter($value);
}

/******** EMAIL ACTIVATION LINK**********************/
if(isset($get['user']) && !empty($get['activ_code']) && !empty($get['user']) && is_numeric($get['activ_code']) ) {

$err = array();
$msg = array();

$user = mysqli_real_escape_string($link,$get['user']);
$activ = mysqli_real_escape_string($link,$get['activ_code']);

//check if activ code and user is valid
$rs_check = mysqli_query($link,"select user_id from users where verificationlink='$user' and verificationcode='$activ'") or die (mysqli_error());
$num = mysqli_num_rows($rs_check);
  // Match row found with more than 1 results  - the user is authenticated.
    if ( $num <= 0 ) {
	$err[] = "Sorry no such account exists or activation code invalid.";
	//header("Location: activate.php?msg=$msg");
	//exit();
	}

if(empty($err)) {
// set the approved field to 1 to activate the account
$rs_activ = mysqli_query($link,"update users set verified_date='".date("Y-m-d H:i:s")."', `status`='1' WHERE verificationlink='$user' AND verificationcode = '$activ' ") or die(mysqli_error());
$msg[] = "Thank you. Your account has been activated.";
//header("Location: activate.php?done=1&msg=$msg");
//exit();
 }
}

/******************* ACTIVATION BY FORM**************************/
if ($_POST['doActivate']=='Activate')
{
$err = array();
$msg = array();

$user_email = mysqli_real_escape_string($link,$_POST['user_email']);
$activ = mysqli_real_escape_string($link,$_POST['activ_code']);
//check if activ code and user is valid as precaution
$rs_check = mysqli_query($link,"select user_id from users where user_email='$user_email' and verificationcode='$activ'") or die (mysqli_error());
$num = mysqli_num_rows($rs_check);
  // Match row found with more than 1 results  - the user is authenticated.
    if ( $num <= 0 ) {
	$err[] = "Sorry no such account exists or activation code invalid.";
	//header("Location: activate.php?msg=$msg");
	//exit();
	}
//set approved field to 1 to activate the user
if(empty($err)) {
	$rs_activ = mysqli_query($link,"update users set verified_date='".date("Y-m-d H:i:s")."', `status`='1' WHERE
						 user_email='$user_email' AND verificationcode = '$activ' ") or die(mysqli_error());
	$msg[] = "Thank you. Your account has been activated. You can now <a href='login.php'>LOGIN</a> here";
 }
//header("Location: activate.php?msg=$msg");
//exit();
}


include 'includes/header1.php';
?>

<script language="JavaScript" type="text/javascript" src="js/jquery-1.3.2.min.js"></script>
<script language="JavaScript" type="text/javascript" src="js/jquery.validate.js"></script>
  <script>
  document.title = "Propertywing Account Activation";
  $(document).ready(function(){
    $("#actForm").validate();
  });
  </script>
<link href="styles.css" rel="stylesheet" type="text/css">
</head>

<body>
<div class=" bg-image-fixed">
<br />
<br />
<div class="container">
<div class="col-sm-8">

<div class="col-sm-12 form-back"> <span style="font-size:24px">Account Activation</span></div>


        <?php
	  /******************** ERROR MESSAGES*************************************************
	  This code is to show error messages
	  **************************************************************************/
	if(!empty($err))  {
	   echo "<div class=\"msg col-sm-12 form-back\">";
	  foreach ($err as $e) {
	    echo "* $e <br>";
	    }
	  echo "</div>";
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"msg col-sm-12 form-back\">" . $msg[0] . "</div>";

	   }
	  /******************************* END ********************************/
	  ?>



      <form action="activate.php" method="post" name="actForm" id="actForm"  >
        <div class="col-sm-12 form-back">
         <div class="col-xs-6 selectContainer">
        	<label for="InputName">Your Email</label>
            <input name="user_email" type="text" class="required email add-property-input form-control" id="txtboxn" >
          </div>
            <div class="col-xs-6 selectContainer">
        	<label for="InputName">Activation code</label>
            <input name="activ_code" type="password" class="required add-property-input form-control" id="txtboxn" >
           	</div>

                  <input name="doActivate" type="submit" id="doLogin3"  class="button btn  pull-right viewfull" value="Activate">





        </div>
      </form>


<div class="col-sm-12 form-back"> <span style="font-size:14px">Please enter your email and activation code sent to you to your email
        address to activate your account. Once your account is activated you can
        <a href="login.php">login here</a>.</span></div>
</div>


</div>

<br><br><br>
</div>


<?php include 'footer.php';?>
