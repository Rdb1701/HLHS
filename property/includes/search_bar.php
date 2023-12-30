<?php 

include "../../app/database.php";
date_default_timezone_set('Asia/Manila');

extract($_POST);

$searches = array();


$query = "
SELECT prop.*, prov.name as province_name, cit.name as city_name, bar.name as barangay_name, us.u_name, cit.zipcode
FROM property as prop
LEFT JOIN provinces as prov ON prov.province_id = prop.province_id
LEFT JOIN cities as cit ON cit.city_id = prop.city_id
LEFT JOIN barangays as bar ON bar.barangay_id = prop.barangay_id
LEFT JOIN user as us ON us.user_id = prop.user_id
WHERE prop.status = 1 AND (cit.zipcode = '$search' OR prov.name = '$search')
";


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