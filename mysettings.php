<?php 
/********************** MYSETTINGS.PHP**************************
This updates user settings and password
************************************************************/
include 'dbc.php';
		page_protect();
include 'includes/header1.php';

$err = array();
$msg = array();

if($_POST['doUpdate'] == 'Update')  
{


$rs_pwd = mysql_query("select password from users where user_id='$_SESSION[user_id]'");
list($old) = mysql_fetch_row($rs_pwd);
$old_salt = substr($old,0,9);

//check for old password in md5 format
	if($old === PwdHash($_POST['pwd_old'],$old_salt))
	{
	$newsha1 = PwdHash($_POST['pwd_new']);
	mysql_query("update users set password='$newsha1' where user_id='$_SESSION[user_id]'");
	$msg[] = "Your new password is updated";
	//header("Location: mysettings.php?msg=Your new password is updated");
	} else
	{
	 $err[] = "Your old password is invalid";
	 //header("Location: mysettings.php?msg=Your old password is invalid");
	}

}

if($_POST['doSave'] == 'Save')  
{
// Filter POST data for harmful code (sanitize)
foreach($_POST as $key => $value) {
	$data[$key] = filter($value);
}


mysql_query("UPDATE users SET
			`full_name` = '$data[name]',
			
			`user_phone` = '$data[tel]'
			
			 WHERE user_id='$_SESSION[user_id]'
			") or die(mysql_error());

//header("Location: mysettings.php?msg=Profile Sucessfully saved");
$msg[] = "Profile Sucessfully saved";
 }
 
$rs_settings = mysql_query("select * from users where user_id='$_SESSION[user_id]'"); 
?>
  <div class=" bg-image-fixed">
    <div class="container">    
	<div class="col-sm-8">
      <div class="col-sm-12 form-back"> <span style="font-size:24px">My Account - Settings</span>
                <?php	
	if(!empty($err))  {
	   echo "<div class=\"msg\">";
	  foreach ($err as $e) {
	    echo "* Error - $e <br>";
	    }
	  echo "</div>";	
	   }
	   if(!empty($msg))  {
	    echo "<div class=\"msg\">" . $msg[0] . "</div>";

	   }
	  ?>

        	<br>
	<span style="font-size:14px">
            	Here you can make changes to your profile. Please note that you will not be able to change your email which has been already registered.
            </span>
    </div>
  
<?php while ($row_settings = mysql_fetch_array($rs_settings)) {?>
  <form role="form" action="mysettings.php" method="post" name="myform" id="myform">
    <div class="col-xs-12 form-back">
      
      <div class="col-xs-6 selectContainer">	 
        <label for="InputName">Your Name</label>
        
        <input class="input-all form-control" name="name" type="text" id="name"   value="<? echo $row_settings['full_name']; ?>" >
         
      </div>
      
      
      <div class="col-xs-6 selectContainer">
        <label for="InputEmail">Phone</label>
       
        <input  class="input-all form-control required" name="tel" type="text" id="tel" value="<? echo $row_settings['user_phone']; ?>">
          
      </div>
      
     
      
       <div class="col-xs-6 selectContainer">
        <label for="InputEmail">User Name</label>
      
          <input class="form-control optional defaultInvalid url input-all" name="web" type="text" id="web" value="<? echo $row_settings['user_name']; ?>" disabled>
          
      </div>
      
       <div class="col-xs-6 selectContainer">
        <label for="InputEmail">E-mail</label>
       
	      <input  class="input-all form-control" name="user_email" type="text" id="web3"  value="<? echo $row_settings['user_email']; ?>" disabled>
         
      </div>
      
      <input name="doSave" type="submit" id="doSave" value="Save" class="button btn  pull-right viewfull" >
    </div>
  </form>
  
   <?php 
if (checkAdmin()) {
/*******************************END**************************/
?>
      <p> <a href="admin.php">Admin CP </a></p>
	  <?php } ?>        
         <div class="col-sm-12 form-back"> <span style="font-size:24px">Change Your Password</span>
         <br>
	<span style="font-size:14px">
            	If you want to change your password, please input your old and new password to make changes
            </span>
    </div>
        
        <form role="form" name="pform" id="pform" method="post" action="" >
    <div class="col-sm-12 form-back"> 
      
      
       <div class="col-xs-6 selectContainer">	 
        <label for="pwd_old">Old Password</label>
       
          <input name="pwd_old"   class="input-all form-control" type="password"  id="pwd_old">
          
      </div>
      
      <div class="col-xs-6 selectContainer">	 
        <label for="InputEmail">New Password</label>
       
          <input name="pwd_new" type="password" id="pwd_new"  class="form-control input-all">
          
      </div>
       <input name="doUpdate" type="submit" id="doUpdate" value="Update" class="button btn  pull-right viewfull">
      
    </div>
  </form>
  
  
  </div>
<?php } ?>
 
  <div class="col-sm-3 ">
  <?php
    /*********************** MYACCOUNT MENU ****************************
This code shows my account menu only to logged in users. 
Copy this code till END and place it in a new html or php where
you want to show myaccount options. This is only visible to logged in users
*******************************************************************/
if (isset($_SESSION['user_id'])) {?>


     <?php
include ('sidebar.php') ;
?>

<?php } ?>

 
        
        
        
  </div>
 </div>
 </div>
 </div>
<?php include 'footer.php';?> 

<script>
  document.title = "Account Settings";
</script>