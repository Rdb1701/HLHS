<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM user
WHERE username = '$username' OR email = '$email' OR phone = '$phone'
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO user(username,
        password,
        u_name,
        gender,
        email,
        phone,
        user_type_id,
        active,
        date_inserted) VALUES('$username',
        '".md5($password)."',
        '$name',
        '$gender',
        '$email',
        '$phone',
        '$user_type',
        '1',
        '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username or Email already Exists ";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);


?>