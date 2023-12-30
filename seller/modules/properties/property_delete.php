<?php
include("../../../app/database.php");

extract($_POST);

$data = array();
$res_success = 0;
$res_message = "";

$query = "
DELETE FROM property
WHERE property_id = '$property_id'
";

if($db->query($query)){
    $res_success = 1;

    $query_image= "DELETE FROM property_image WHERE property_id = '$property_id'";
    $db->query($query_image);

    $query_documents= "DELETE FROM property_owner_documents WHERE property_id = '$property_id'";
    $db->query($query_documents);

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  