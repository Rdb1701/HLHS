<?php
include("../../../app/database.php");

extract($_POST);

$data            = array();
$documents       = array();
$property_image  = array();
$result_document = array();
$result_image    = array();

$res_success  = 0;
$res_message  = " ";

$title                = "";
$content              = "";
$ptype                = "";
$stype                = "";
$bath                 = "";
$kitc                 = "";
$bed                  = "";
$balc                 = "";
$hall                 = "";
$price                = "";
$reg_province_id      = "";
$reg_city_id          = "";
$reg_barangay_id      = "";
$totalfl              = "";
$asize                = "";
$loc                  = "";
$status                  = "";

//PROPERTIES
$query = "
SELECT * FROM property
WHERE property_id = '$property_id'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);
  $res_success = 1;

$title                = $row['title'];
$content              = $row['content'];
$ptype                = $row['property_type_id'];
$stype                = $row['sale_type'];
$bath                 = $row['bathroom'];
$kitc                 = $row['kitchen'];
$bed                  = $row['bedroom'];
$balc                 = $row['balcony'];
$hall                 = $row['hall'];
$price                = $row['price'];
$reg_province_id      = $row['province_id'];
$reg_city_id          = $row['city_id'];
$reg_barangay_id      = $row['barangay_id'];
$totalfl              = $row['floor'];
$asize                = $row['size'];
$loc                  = $row['location'];
$status               = $row['property_status'];

}

//Images
$query_images = "
SELECT * FROM property_image
WHERE property_id = '$property_id'
";

$result = mysqli_query($db, $query_images);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();
    $res_success = 1;

    $temp_arr['image_id']    = $row['image_id'];
    $temp_arr['image']       = $row['image'];

    $property_image[] = $temp_arr;
  }
}

foreach ($property_image as $rows) {
    array_push($result_image, $rows);  
} 


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

$data['property_id']      = $property_id;
$data['title']            = $title;
$data['content']          = $content;
$data['ptype']            = $ptype;
$data['stype']            = $stype;
$data['bath']             = $bath;
$data['kitc']             = $kitc;
$data['bed']              = $bed;
$data['balc']             = $balc;
$data['hall']             = $hall;
$data['price']            = $price;
$data['reg_province_id']  = $reg_province_id;
$data['reg_city_id']      = $reg_city_id;
$data['reg_barangay_id']  = $reg_barangay_id;
$data['totalfl']          = $totalfl;
$data['asize']            = $asize;
$data['loc']              = $loc;
$data['status']           = $status;

$data['document']         = $result_document;
$data['images']            = $result_image;


echo json_encode($data);
?>