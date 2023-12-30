<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
UPDATE property_remarks
SET
remarks = '$remarks'
WHERE property_id = '$property_id'
";

if ($db->query($query)) {
    $res_success = 1;

} else {
    $res_message = "Failed";
}


$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);
