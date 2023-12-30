<?php

//fetch_user_chat_history.php

include "../../app/database.php";
include "function.php";

echo fetch_user_chat_history($_SESSION['customer']['user_id'], $_POST['to_user_id'], $_POST['property_id'], $db);

?>