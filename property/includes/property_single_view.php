<?php


extract($_POST);

$data            = array();
$property        = array();
$documents       = array();
$property_image  = array();
$prop_id     = "";


$propertyy_id    = "";
$type_name      = "";
$title          = "";
$content        = "";
$sale_type      = "";
$u_name         = "";
$bedroom        = "";
$bathroom       = "";
$balcony        = "";
$kitchen        = "";
$hall           = "";
$floor          = "";
$size           = "";
$price          = "";
$location       = "";
$province_name  = "";
$city_name      = "";
$barangay_name  = "";
$date_inserted  = "";



//PROPERTIES
$query = "
SELECT prop.*, prov.name as province_name, cit.name as city_name, bar.name as barangay_name, us.u_name, us.user_id, pt.type_name
FROM property as prop
LEFT JOIN provinces as prov ON prov.province_id = prop.province_id
LEFT JOIN cities as cit ON cit.city_id = prop.city_id
LEFT JOIN barangays as bar ON bar.barangay_id = prop.barangay_id
LEFT JOIN user as us ON us.user_id = prop.user_id
LEFT JOIN property_type as pt ON pt.property_type_id = prop.property_type_id
WHERE prop.property_id = '$property_id' AND prop.status = 1
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();
  $res_success = 1;

  $sale_type1 = "";
  if($row['sale_type'] == 1){
    $sale_type1 = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Rent</span>';

  }
  if($row['sale_type'] == 2){
    $sale_type1 = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Sale</span>';

  }


  $propertyy_id   = $row['property_id'];
  $type_name   = $row['type_name'];
  $user_id        = $row['user_id'];
  $title          = $row['title'];
  $content        = $row['content'];
  $sale_type      = $sale_type1;
  $u_name         = $row['u_name'];
  $bedroom        = $row['bedroom'];
  $bathroom       = $row['bathroom'];
  $balcony        = $row['balcony'];
  $kitchen        = $row['kitchen'];
  $hall           = $row['hall'];
  $floor          = $row['floor'];
  $size           = $row['size'];
  $price          = $row['price'];
  $location       = $row['location'];
  $province_name  = $row['province_name'];
  $city_name      = $row['city_name'];
  $barangay_name  = $row['barangay_name'];
  $date_inserted  = date('F d,Y', strtotime($row['date_inserted']));

  }

}

//Images
$query_images = "
SELECT * FROM property_image
WHERE property_id = '$property_id'
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


//DOCUMENTS
$query_document = "
SELECT * FROM property_owner_documents
WHERE property_id = '$property_id'
";

$result_document = mysqli_query($db, $query_document);
if (mysqli_num_rows($result_document) > 0) {
  while ($row = mysqli_fetch_assoc($result_document)) {
    $temp_arr = array();
    $res_success = 1;

    $temp_arr['document_id'] = $row['document_id'];
    $temp_arr['files']       = $row['files'];

    $documents[] = $temp_arr;
  }
}


// echo $prop_id;

?>