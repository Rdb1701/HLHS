<?php
include("../../../app/database.php");

$property = array();


$query = "
SELECT DISTINCT pro.*, typ.type_name, prov.name as province_name, cit.name as city_name, bar.name as barangay_name, us.email
FROM property as pro
LEFT JOIN property_image as prom ON prom.property_id = pro.property_id
LEFT JOIN property_owner_documents as proc ON proc.property_id = pro.property_id
LEFT JOIN property_type as typ ON typ.property_type_id = pro.property_type_id
LEFT JOIN provinces as prov ON prov.province_id = pro.province_id
LEFT JOIN cities as cit ON cit.city_id = pro.city_id
LEFT JOIN barangays as bar ON bar.barangay_id = pro.barangay_id
LEFT JOIN user as us ON us.user_id = pro.user_id
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $status = "";
    if ($row['status'] == 0) {
      $status = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';
    }
    if ($row['status'] == 1) {
      $status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Accepted</span>';
    }
    if ($row['status'] == 2) {
      $status = '<span class="text-white bg-danger  " style="padding: 3px 8px; border-radius: 5px;">Rejected</span>';
    }


    $property_status = "";
    if ($row['property_status'] == 0) {
      $property_status = '<span class="text-white bg-danger" style="padding: 3px 8px; border-radius: 5px;">Sold</span>';
    }

    if ($row['property_status'] == 1) {
      $property_status = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Available</span>';
    }

    $temp_arr['property_id']     = $row['property_id'];
    $temp_arr['title']           = $row['title'];
    $temp_arr['email']           = $row['email'];
    $temp_arr['content']         = $row['content'];
    $temp_arr['sale_type']       = $row['sale_type'];
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
    $temp_arr['city_name']       = $row['city_name'];
    $temp_arr['barangay_name']   = $row['barangay_name'];
    $temp_arr['property_status'] = $property_status;
    $temp_arr['status']          = $status;
    $temp_arr['date_inserted']   = date('F d,Y', strtotime($row['date_inserted']));

    $property[] = $temp_arr;
  }
}

foreach ($property as $key => $value) {

  $remark_button = '';

  //REMARK BUTTON CHANGE
  if ($value['status'] == '<span class="text-white bg-danger  " style="padding: 3px 8px; border-radius: 5px;">Rejected</span>') {

    $remark_button = "<button class = 'btn btn-primary'  title='Edit Remarks'   onclick='edit_remark(".$value['property_id'].")'><i class='fa fa-edit'></i></button>&nbsp;";
  } else {
    $remark_button = "<button class = 'btn btn-danger'  title='Reject'  onclick='reject_property(" . $value['property_id'] . ",\"".$value['email']."\")'><i class='fa fa-thumbs-down'></i></button>&nbsp;";
  }



  //BUTTON FOR DETAILES AND FILES
  $button_details = "
   <button class = 'btn btn-warning' title='View' onclick='view_details(" . $value['property_id'] . ")'><i class='fa fa-circle-info'></i></button>&nbsp;
   ";
  $button_documents = "
   <button class = 'btn btn-warning' title='View Documents' onclick='file_documents(" . $value['property_id'] . ")'><i class='fa fa-file'></i></button>&nbsp;
   ";

  //ACTION BUTTONS
  $button = "
   <td class='text-center'>
   <div class='d-flex justify-content-center order-actions'>
 <button class = 'btn btn-success' title='Accept'  onclick='accept_property(" . $value['property_id'] . ",\"".$value['email']."\")'><i class='fa fa-thumbs-up'></i></button>&nbsp;
 $remark_button
 </div>
 </td>
   ";

  $data['data'][] = array($value['title'], $value['type_name'], $value['date_inserted'], $value['property_status'], $value['status'], $button_documents . $button_details, $button);
}


echo json_encode($data);
