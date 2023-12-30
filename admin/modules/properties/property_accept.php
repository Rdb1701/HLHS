<?php
include("../../../app/database.php");

date_default_timezone_set('Asia/Manila');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

//PHP MAILER
require '../../libraries/PHPMailer/src/Exception.php';
require '../../libraries/PHPMailer/src/PHPMailer.php';
require '../../libraries/PHPMailer/src/SMTP.php';

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
UPDATE property
SET
status = '1'
WHERE property_id = '$property_id'
";

if($db->query($query)){
    $res_success = 1;

    $query_delete = "DELETE FROM property_remarks
    WHERE property_id = '$property_id'";

    $db->query($query_delete);

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
      $mail->Body = "Your Property Registration has been approved by the System administrator. Please login to manage your properties. Thank You and Goodluck!";
      $mail->send();

    
}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  