<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM user_seller
WHERE username = '$username' OR email = '$email' OR phone = '$phone'
";

$result = mysqli_query($db, $query);
if (!mysqli_num_rows($result)) {

    $query = "
    INSERT INTO user_seller(username,
        password,
        u_name,
        gender,
        email,
        phone,
        isActive,
        commission,
        date_inserted) VALUES('$username',
        '".md5($password)."',
        '$name',
        '$gender',
        '$email',
        '$phone',
        '1',
        '$commission',
        '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Query Failed";
    }

} else {
    $res_message = "Username / Email or Phone already Exists ";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);


?>