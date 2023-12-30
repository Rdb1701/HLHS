<?php
date_default_timezone_set('Asia/Manila');

include "../../app/database.php";

$property_id        =  mysqli_real_escape_string($db, $_POST['property_id']);
$appointment_date   =  mysqli_real_escape_string($db, $_POST['appointment_date']);
$appointment_time   =  mysqli_real_escape_string($db, $_POST['appointment_time']);
$message            =  mysqli_real_escape_string($db, $_POST['message']);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT * FROM property_appointment
WHERE customer_id  = '".$_SESSION['customer']['user_id']."'
AND property_id = '$property_id'
AND status != 2
";

$result = mysqli_query($db, $query);

if (!mysqli_num_rows($result)) {


    $query = "
    INSERT INTO property_appointment(property_id,
    customer_id,
    appointment_date,
    appointment_time,
    message,
    status)VALUES('$property_id',
    '".$_SESSION['customer']['user_id']."',
    '$appointment_date',
    '$appointment_time',
    '$message',
    '0'
    )
    ";

    if (mysqli_query($db, $query)) {
        $res_success = 1;
    } else {
        $res_message = "Cannot Submit a Feedback";
    }

}else{
    $res_message = "Already Have an Appointment";
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);


?>