<?php
include "../../app/database.php";
date_default_timezone_set('Asia/Manila');

$province       =  mysqli_real_escape_string($db, $_POST['province']);
$city           =  mysqli_real_escape_string($db, $_POST['city']);
$barangay       =  mysqli_real_escape_string($db, $_POST['barangay']);
$property_type  =  mysqli_real_escape_string($db, $_POST['property_type']);
$prices         =  mysqli_real_escape_string($db, $_POST['prices']);

$data     = array();
$searches = array();

$query = "
SELECT prop.*, prov.name as province_name, cit.name as city_name, bar.name as barangay_name, us.u_name
FROM property as prop
LEFT JOIN provinces as prov ON prov.province_id = prop.province_id
LEFT JOIN cities as cit ON cit.city_id = prop.city_id
LEFT JOIN barangays as bar ON bar.barangay_id = prop.barangay_id
LEFT JOIN user as us ON us.user_id = prop.user_id
WHERE prop.status = 1
";

$hasWhere = 1;

if ($province) {
    if (!$hasWhere) {
      $query .= " WHERE prop.province_id = '$province' ";
    } else {
      $query .= " AND prop.province_id = '$province' ";
    }
    $hasWhere = 1;
  }

  if ($city) {
    if (!$hasWhere) {
      $query .= " WHERE prop.city_id = '$city'";
    } else {
      $query .= " AND prop.city_id = '$city'";
    }
    $hasWhere = 1;
  }

  if ($barangay) {
    if (!$hasWhere) {
      $query .= " WHERE prop.barangay_id = '$barangay' ";
    } else {
      $query .= " AND prop.barangay_id = '$barangay' ";
    }
    $hasWhere = 1;
  }

  if ($property_type) {
    if (!$hasWhere) {
      $query .= " WHERE prop.property_type_id = '$property_type' ";
    } else {
      $query .= " AND prop.property_type_id = '$property_type' ";
    }
    $hasWhere = 1;
  }

  if ($prices) {
    if (!$hasWhere) {

        if($prices == '1')
         $query .= " WHERE prop.price >= '100000' AND prop.price <= '500000'";
        else if($prices == '2')
        $query .= " WHERE prop.price >= '500000' AND prop.price <= '1000000'";
        else if($prices == '3')
        $query .= " WHERE prop.price >= '1000000' AND prop.price <= '5000000'";
        else if($prices == '4')
        $query .= " WHERE prop.price >= '5000000'";

    } else {
        if($prices == '1')
         $query .= " AND (prop.price >= '100000' AND prop.price <= '500000')";
        else if($prices == '2')
        $query .= " AND (prop.price >= '500000' AND prop.price <= '1000000')";
        else if($prices == '3')
        $query .= " AND (prop.price >= '1000000' AND prop.price <= '5000000')";
        else if($prices == '4')
        $query .= " AND prop.price >= '5000000'";
    }
    $hasWhere = 1;
  }


$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();
  
    $status = "";
    if($row['status'] == 0){
      $status = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';
  
    }
    if($row['status'] == 1){
      $status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Accepted</span>';
  
    }
    $property_status = "";
    if($row['property_status'] == 0){
      $property_status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Sold</span>';
  
    }
    if($row['property_status'] == 1){
      $property_status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Available</span>';
  
    }
  
    $temp_arr['property_id']     = $row['property_id'];
    $temp_arr['title']           = $row['title'];
    $temp_arr['content']         = $row['content'];
    $temp_arr['sale_type']       = $row['sale_type'];
    $temp_arr['bedroom']         = $row['bedroom'];
    $temp_arr['bathroom']        = $row['bathroom'];
    $temp_arr['balcony']         = $row['balcony'];
    $temp_arr['kitchen']         = $row['kitchen'];
    $temp_arr['hall']            = $row['hall'];
    $temp_arr['floor']           = $row['floor'];
    $temp_arr['size']            = $row['size'];
    $temp_arr['price']           = $row['price'];
    $temp_arr['location']        = $row['location'];
    $temp_arr['province_name']   = $row['province_name'];
    $temp_arr['city_name']       = $row['city_name'];
    $temp_arr['barangay_name']   = $row['barangay_name'];
    $temp_arr['property_status'] = $property_status;
    $temp_arr['status']          = $status;
    $temp_arr['date_inserted']   = date('F d,Y', strtotime($row['date_inserted']));
  
    $searches[] = $temp_arr;

  }
}

$data['searches'] = $searches;

echo json_encode($data);



?>