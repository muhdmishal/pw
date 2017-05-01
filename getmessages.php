<?php

function getMessagesCount()
{
	$query = "SELECT *  FROM `message` WHERE `receiver_id` = $_SESSION[user_id] AND `viewedstatus` = 1 ";

  $link = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);
	$messages = mysqli_query($link,$query);

	return mysqli_num_rows($messages);
}

?>
