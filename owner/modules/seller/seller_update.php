<?php

date_default_timezone_set('Asia/Manila');

include('../../../app/database.php');
 
extract($_POST);

$data = array();
$res_success = 0;
$res_message = '';

    $query = "
    UPDATE user_seller
    SET
    u_name          = '$name',
    gender          = '$gender ',
    email           = '$email',
    phone           = '$phone',
    isActive          = '$active',
    commission      = '$commission'
    WHERE seller_id = '$seller_id'
    ";

    if(mysqli_query($db, $query)){
        $res_success = 1;

    }else{
        $res_message = "Query Failed";
    }

    $data['res_success'] = $res_success;
    $data['res_message'] = $res_message;

    echo json_encode($data);
