<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');


date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../libraries/PHPMailer/src/Exception.php';
require '../../libraries/PHPMailer/src/PHPMailer.php';
require '../../libraries/PHPMailer/src/SMTP.php';

$property_id           = mysqli_real_escape_string($db, trim($_POST['property_id']));
$remarks               = mysqli_real_escape_string($db, trim($_POST['remarks']));
$email                 = mysqli_real_escape_string($db, trim($_POST['email']));

$data = array();
$res_success = 0;
$res_message = "";

$query = "
UPDATE property
SET
status = '2'
WHERE property_id = '$property_id'
";

if ($db->query($query)) {
    $res_success = 1;

    $query_remarks = "
    INSERT INTO property_remarks(property_id,
    remarks,
    date_inserted)VALUES(
    '$property_id',
    '$remarks',
    '" . date("Y-m-d H:i:s") . "'
    )
    ";
    if ($db->query($query_remarks)) {
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
      $mail->Subject = "PROPERTY REGISTRATION";
      $mail->Body = "Your Property Registration has been declined by the System administrator. Please login to view lackings. Thank You and Goodluck!";
      $mail->send();


    } else {
        $res_message = "Failed";
    }

} else {
    $res_message = "Failed";
}


$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
