<?php
include("../../../app/database.php");

$property = array();
$data = array();


$query = "
SELECT DISTINCT pro.*, typ.type_name, prov.name as province_name, cit.name as city_name, bar.name as barangay_name, us.u_name
FROM property as pro
LEFT JOIN property_image as prom ON prom.property_id = pro.property_id
LEFT JOIN property_owner_documents as proc ON proc.property_id = pro.property_id
LEFT JOIN property_type as typ ON typ.property_type_id = pro.property_type_id
LEFT JOIN provinces as prov ON prov.province_id = pro.province_id
LEFT JOIN cities as cit ON cit.city_id = pro.city_id
LEFT JOIN barangays as bar ON bar.barangay_id = pro.barangay_id
LEFT JOIN user as us ON us.user_id = pro.user_id
WHERE property_status = 0
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
    if($row['status'] == 2){
      $status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Rejected</span>';

    }

    $property_status = "";
    if($row['property_status'] == 0){
      $property_status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Sold</span>';

    }
    if($row['property_status'] == 1){
      $property_status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Available</span>';

    }

    $sale_type = "";
    if($row['sale_type'] == 1){
      $sale_type = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Rent</span>';

    }
    if($row['sale_type'] == 2){
      $sale_type = '<span class="text-dark" style="padding: 3px 8px; border-radius: 5px;">Sale</span>';

    }

    $temp_arr['property_id']     = $row['property_id'];
    $temp_arr['title']           = $row['title'];
    $temp_arr['u_name']          = $row['u_name'];
    $temp_arr['content']         = $row['content'];
    $temp_arr['sale_type']       = $sale_type;
    $temp_arr['type_name']       = $row['type_name'];
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
    $temp_arr['company_share']   = $row['company_share'];
    $temp_arr['city_name']       = $row['city_name'];
    $temp_arr['barangay_name']   = $row['barangay_name'];
    $temp_arr['property_status'] = $property_status;
    $temp_arr['status']          = $status;
    $temp_arr['date_inserted']   = date('F d,Y', strtotime($row['date_inserted']));
    
    $property[] = $temp_arr;
  }
}

foreach($property as $key => $value){

    $total_share = $value['price'] * ($value['company_share'] / 100);

    $total_shares = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">'.'₱ '.number_format($total_share).'</span>';

   $data['data'][] = array($value['type_name'], $value['location'],$value['u_name'],'₱ '.number_format($value['price']),$value['company_share'].'%',$total_shares);
}


echo json_encode($data);
?>