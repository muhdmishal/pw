<?php

require 'dbconfig.php';

class User {

    function checkUser($uid, $oauth_provider, $username) 
	{
        $query = mysqli_query($link,"SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'") or die(mysqli_error());
        $result = mysqli_fetch_array($query);
        if (!empty($result)) {
            # User is already present
        } else {
            #user not present. Insert a new Record
            $query = mysqli_query($link,"INSERT INTO `users` (oauth_provider, oauth_uid, username) VALUES ('$oauth_provider', $uid, '$username')") or die(mysqli_error());
            $query = mysqli_query($link,"SELECT * FROM `users` WHERE oauth_uid = '$uid' and oauth_provider = '$oauth_provider'");
            $result = mysqli_fetch_array($query);
            return $result;
        }
        return $result;
    }

    

}

?>
