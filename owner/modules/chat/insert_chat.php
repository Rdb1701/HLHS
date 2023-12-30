<?php

include("../../../app/database.php");
include "function.php";
date_default_timezone_set('Asia/Manila');


$data = array(
	':to_user_id'		=>	$_POST['to_user_id'],
	':from_user_id'		=>	$_SESSION['owner']['user_id'],
	':chat_message'		=>	$_POST['chat_message'],
	':property_id'		=>	$_POST['property_id'],
	':status'			=>	'1'
);

$query = "
INSERT INTO chat
(to_user_id, from_user_id, property_id, chat_message, status) 
VALUES ('".$data[':to_user_id']."', '".$data[':from_user_id']."', '".$data[':property_id']."', '".$data[':chat_message']."', '".$data[':status']."')
";

if(mysqli_query($db, $query))
{
	echo fetch_user_chat_history($_SESSION['owner']['user_id'], $_POST['to_user_id'],$_POST['property_id'], $db);
}

?>