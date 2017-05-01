<?php 
include 'dbc.php';
page_protect();
include 'includes/myaccount-header.html';
 
$rs_settings = mysql_query("select * from users where id='$_SESSION[user_id]'"); 


require_once './dbapi.php';
require_once './property.php';

$dbc = new DBAPI();


$userID = $_SESSION[user_id] ; 

//load users messages 

$messages  = $dbc->getMessages($userID) ; 

/*
$out = '<table width="100% cellpadding="10" border="2" class="results-table">';

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

*/?><h2 style="float:right;">Inbox</h2><div class="inbox-messages"><table class="email-table"></br></br><tr><th>From</th><th>Subject</th><th>Msg</th><th>Recieved</th><th>View message</th></tr></table><?php
$output = '';

while ($linea = $messages->fetch_assoc()) {
		$msgid = $linea['id'] ; 
				
		$out = '<table class="email-table"><tr><td>'.$dbc->getUsername($linea['sender']).'</td>';
		$out .= '<td> '.$linea['subject'].'</td>';
		$out .= '<td> '.$linea['msg'].'</td>';
		$out .= '<td > '.$linea['sdate'].'</td>';
		$out .= '<td><a href="showmsg.php?idmsg='.$msgid.'"> View</td></tr></table></a>';
		
		$out .= "";
		
		$output .= $out ; 
}

echo $output ; ?><div class="email-settings"><p class="buttonadd">Compose</p><ul><li>Inbox</li><li>Sent</li><li>Instruct a Solicitor</li><li>Contact a Mortgage Broker</li><li></li><li></li><li></li></ul></div></div><?php

?>