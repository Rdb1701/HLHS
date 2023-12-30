<?php

date_default_timezone_set('Asia/Manila');

include "../../app/database.php";
 
extract($_POST);

$data = array();
$res_success = 0;
$res_message = '';


    $query = "
    UPDATE user
    SET
    u_name          = '$name',
    gender          = '$gender ',
    password        = '".md5($password)."',
    email           = '$email',
    phone           = '$phone'
    WHERE user_id   = '$user_id'
    ";

    if(mysqli_query($db, $query)){
        $res_success = 1;

    }else{
        $res_message = "Query Failed";
    }

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
