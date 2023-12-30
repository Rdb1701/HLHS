<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../assets/PHPMailer/src/Exception.php';
require '../../assets/PHPMailer/src/PHPMailer.php';
require '../../assets/PHPMailer/src/SMTP.php';

extract($_POST);

$data = array();

$res_success = 0;
$res_message = '';

$query = "
    UPDATE property_appointment
    SET
    status      = '1'
    WHERE appointment_id = '$appointment_id'
    ";

if (mysqli_query($db, $query)) {
    $res_success = 1;

    //-------------------------------------------------SENDING EMAIL-------------------------------------------------------------------
    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'finderhomes267@gmail.com';
    $mail->Password = 'xseiursuubithlfc';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;
    $mail->setFrom('finderhomes267@gmail.com', 'FinderHomes');
    $mail->addAddress($email);
    $mail->isHTML(true);
    $mail->Subject = "PROPERTY APPOINTMENT";
    $mail->Body = "Your Property Appointment has been approved by ".$_SESSION['seller']['u_name'].". Please login to view details. Thank You.";
    $mail->send();

} else {
    $res_message = "Query Failed";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
