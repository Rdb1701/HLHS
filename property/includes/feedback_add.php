<?php
date_default_timezone_set('Asia/Manila');

include "../../app/database.php";

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";


    $query = "
    INSERT INTO feedback(feedback) VALUES('$feedback')
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Cannot Submit a Feedback";
    }


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);


?>