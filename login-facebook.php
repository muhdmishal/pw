<?php

require 'facebook/facebook.php';
require 'config/fbconfig.php';
require 'config/functions.php';

$facebook = new Facebook(array(
            'appId' => APP_ID,
            'secret' => APP_SECRET,
            'allowSignedRequest' => false, 
        ));

$facebook = new Facebook($config);
  $user_id = $facebook->getUser();
  if($user_id) {
		
          // We have a user ID, so probably a logged in user.
          // If not, we'll get an exception, which we handle below.
          try {
    
            $user_profile = $facebook->api('/me','GET');
            echo "<pre>";
            print_r($user_profile);
            echo "</pre>";
    
          } catch(FacebookApiException $e) {
            // If the user is logged out, you can have a 
            // user ID even though the access token is invalid.
            // In this case, we'll get an exception, so we'll
            // just ask the user to login again here.
            $login_url = $facebook->getLoginUrl(); 
            echo 'Please <a href="' . $login_url . '">login.</a>';
            error_log($e->getType());
            error_log($e->getMessage());
          }   
    } else {
          // No user, print a link for the user to login
          $login_url = $facebook->getLoginUrl();
		  echo $login_url ; 
          echo 'No Log. Please <a href="' . $login_url . '">login.</a>';

    }


?>
