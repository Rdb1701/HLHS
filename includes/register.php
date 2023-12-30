<?php
include "../app/database.php";
date_default_timezone_set('Asia/Manila');

$data = array();
$res_success = 0;
$res_message = '';


extract($_POST);

$query = "
SELECT * FROM 
user
WHERE username = '$username'
";

$result = mysqli_query($db, $query);
if(!mysqli_num_rows($result)){

$query = "
INSERT INTO user(
username,
password,
u_name,
gender,
email,
user_type_id,
date_inserted
)VALUES(
'$username',
'".md5($password)."',
'$name',
'$gender',
'$email',
'2',
'".date("Y-m-d H:i:s")."'
  )
";
if(mysqli_query($db,$query)){
    $res_success = 1;
}else{

    $res_message = "Query Failed!";
}

}else{
    $res_message = "Username already Exists";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>