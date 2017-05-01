<?php 

function getMessagesCount()
{
	$query = "SELECT *  FROM `message` WHERE `receiver_id` = $_SESSION[user_id] AND `viewedstatus` = 1 ";

	$messages = mysql_query($query);
	
	return mysql_num_rows($messages);
}

?>