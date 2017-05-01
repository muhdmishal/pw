<?php 
include 'dbc.php';
page_protect();
include 'includes/myaccount-header.html';
 
$rs_settings = mysqli_query($link,"select * from users where id='$_SESSION[user_id]'"); 


require_once './dbapi.php';
require_once './property.php';

$dbc = new DBAPI();


$userID = $_SESSION[user_id] ; 

//load users messages 

$messages  = $dbc->getMessagesByThreadId($userID) ; 



/*
$out = '<table width="100% cellpadding="10" border="2">';

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
$output = '';

while ($linea = $messages->fetch_assoc()) {
		$msgid = $linea['MAX(`id`)'] ; 
		$threadID = $linea['threadID'];
		
		 $out = "Thread ID : ".$threadID ."<br>";
		$out .= 'From : '.$dbc->getUsername($linea['sender']).'<br>';
		$out .= 'Subject : '.$linea['subject'].'<br>';
		$out .= 'Message : '.$linea['msg'].'<br>';
		$out .= 'Received: '.$linea['sdate'].'<br>';
		$out .= '<a href="showmsg.php?idmsg='.$msgid.'"> View Message</a>';
		
		$out .= "<br><br>########################################################################################################<br>";
		
		$output .= $out ; 
}

echo $output ; 

?>
<?php include 'footer.php';?> 
