<?php

function getMessagesCount()
{
	$query = "SELECT *  FROM `message` WHERE `receiver_id` = $_SESSION[user_id] AND `viewedstatus` = 1 ";

	$messages = mysqli_query($link,$query);

	return mysqli_num_rows($messages);
}

?>
