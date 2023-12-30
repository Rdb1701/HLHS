<?php

include "../../app/database.php";
date_default_timezone_set('Asia/Manila');

if(isset($_POST["chat_id"]))
{
	$query = "
	UPDATE chat
	SET status = '2' 
	WHERE chat_id = '".$_POST["chat_id"]."'
	";

    mysqli_query($db, $query);
}

?>