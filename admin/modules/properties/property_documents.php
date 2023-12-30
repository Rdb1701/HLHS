<?php
include("../../../app/database.php");
date_default_timezone_set('Asia/Manila');


extract($_POST);

$data            = array();
$documents       = array();
$result_document = array();
$res_success = 0;
$res_message = "";


//DOCUMENTS
$query_document = "
SELECT * FROM property_owner_documents
WHERE property_id = '$property_id'
";

$result = mysqli_query($db, $query_document);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();
    $res_success = 1;

    $temp_arr['document_id'] = $row['document_id'];
    $temp_arr['files']       = $row['files'];

    $documents[] = $temp_arr;
  }
}


foreach ($documents as $rows) {
    array_push($result_document, $rows);  
} 

$data['document']            = $result_document;


echo json_encode($data);
?>