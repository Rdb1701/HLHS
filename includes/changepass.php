<?php 

include "../app/database.php";

$new_password       = mysqli_real_escape_string($db, trim($_POST['password']));

$data = array();

$res_success = 0;
$res_message = '';


  $res_success  = 1;
  $query = "
    UPDATE user
    SET password    = '".md5($new_password)."'
    WHERE user_id = '".$_SESSION['owner']['user_id']."' 
  ";
  mysqli_query($db, $query);

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);


?>