<?php
session_start();

require_once 'dbapi.php' ;

$uid = $_SESSION['uid'];

echo "UID " .$uid ;


$dbc = new DBAPI();

$usr = $dbc->getFBUserByUid($uid) ;

print_r ($usr);


?>
