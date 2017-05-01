<?php
session_start();


require_once './dbapi.php' ;
require_once './dbc.php' ;

$code = $_GET['code'];

$app_id = "831669323513345";
$app_secret = "bdcf4dc1488a29d0fa1d8e76e5164b57";
$my_url = "http://www.propertywing.co.uk/new/facebook_auth.php";

$dbc = new DBAPI();


if(empty($code)) {
	$_SESSION['state'] = md5(uniqid(rand(), TRUE)); //CSRF protection
	$dialog_url = "https://www.facebook.com/dialog/oauth?client_id=" 
	. $app_id . "&redirect_uri=" . urlencode($my_url) . "&state="
	. $_SESSION['state'];

	echo("<script> top.location.href='" . $dialog_url . "'</script>");
}


$token_url = "https://graph.facebook.com/oauth/access_token?"
	. "client_id=" . $app_id . "&redirect_uri=" . urlencode($my_url)
	. "&client_secret=" . $app_secret . "&code=" . $code . "&scope=publish_stream,email";

	$response = @file_get_contents($token_url);
	$params = null;
	parse_str($response, $params);
	
	$graph_url = "https://graph.facebook.com/me?access_token=".$params['access_token'];

	$user = json_decode(file_get_contents($graph_url));
	
	//here I have the email address => load the Users's detaiils from Users table

	$email = $user->email;
	$fbidd = $user->id;
	$uName = $user->name ; 
	
	$dbuser = $dbc->getUserByEmail($email , $fbidd) ; 
	
	
	if ($dbuser ) {
		
	   // this sets variables in the session 
		$_SESSION['user_id']= $dbuser['id'];  
		$_SESSION['user_name'] = $dbuser['full_name'];
		$_SESSION['user_level'] = $dbuser['user_level'];
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		
		$idr = $dbuser['id'];
		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
		$dbc->executeSQL("update users set `ctime`='$stamp', `ckey` = '$ckey' where fbid='$idr'") ;// or die(mysql_error());
		
		//set a cookie 	
	    setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
		setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");
		setcookie("user_name",$_SESSION['user_name'], time()+60*60*24*COOKIE_TIME_OUT, "/");
		
	    header("Location: myaccount.php");
		
	
	} else {
		//register the user into fb database 
			
		$dbuser = $dbc->storeFBUser($email , $fbidd , $uName) ;
		$_SESSION['user_id']= $dbuser['user_id'];  
		$_SESSION['user_name'] = $dbuser['full_name'];
		$_SESSION['user_level'] = $dbuser['user_level'];
		$_SESSION['HTTP_USER_AGENT'] = md5($_SERVER['HTTP_USER_AGENT']);
		
		//update the timestamp and key for cookie
		$stamp = time();
		$ckey = GenKey();
		$idr = $dbuser['user_id'];
		$dbc->executeSQL("update users set `ctime`='$stamp', `ckey` = '$ckey' where user_id='$idr'") ;// or die(mysql_error());
		
		
		setcookie("user_id", $_SESSION['user_id'], time()+60*60*24*COOKIE_TIME_OUT, "/");
		setcookie("user_key", sha1($ckey), time()+60*60*24*COOKIE_TIME_OUT, "/");
		setcookie("user_name",$_SESSION['user_name'], time()+60*60*24*COOKIE_TIME_OUT, "/");
		
		
		
		header("Location: myaccount.php"); 
	}


 ?>
