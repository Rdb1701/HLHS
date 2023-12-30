<?php 

include "../../app/database.php";
date_default_timezone_set('Asia/Manila');

extract($_POST);

$res_success = 0;
$res_message = "";
$data = array();
$property_image = array();


//Images
$query_images = "
SELECT * FROM property_image
WHERE property_id = '$property_id' LIMIT 1
";

$result_image = mysqli_query($db, $query_images);
if (mysqli_num_rows($result_image) > 0) {
  while ($row = mysqli_fetch_assoc($result_image)) {
    $temp_arr = array();
    $res_success = 1;

    $temp_arr['image_id']    = $row['image_id'];
    $temp_arr['image']       = $row['image'];

    $property_image[] = $temp_arr;
  }
}

$data['property_image'] =  $property_image;

echo json_encode($data);



?>