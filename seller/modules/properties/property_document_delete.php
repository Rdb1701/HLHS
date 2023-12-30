<?php
include("../../../app/database.php");

extract($_POST);

$path = "upload_documents/$file_name";

$data = array();
$res_success = 0;
$res_message = "";

$query = "
DELETE FROM property_owner_documents
WHERE document_id = '$document_id'
";

if($db->query($query)){
    unlink($path);
    $res_success = 1;

}else{
    $res_message = "Failed";
}

$data['res_success']  = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>  