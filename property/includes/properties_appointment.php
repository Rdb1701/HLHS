<?php
include "../../app/database.php";
include "../includes/function.php";

$appointment = array();
$type_name = "";
$location = "";

$data = array();

//GET OWNERS NAME
$query = "
SELECT app.*, pt.type_name, u.u_name, prop.location, TIME_FORMAT(app.appointment_time,'%h:%i %p') as appointment_time, DATE(app.appointment_date) as date_appointment
FROM property_appointment as app
LEFT JOIN property as prop ON prop.property_id = app.property_id
LEFT JOIN user as u ON u.user_id = prop.user_id
LEFT JOIN property_type as pt ON pt.property_type_id = prop.property_type_id
WHERE app.customer_id = '".$_SESSION['customer']['user_id']."'
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

    $temp_arr['appointment_id']       = $row['appointment_id'];
    $temp_arr['type_name']            = $row['type_name'];
    $temp_arr['u_name']               = $row['u_name'];
    $temp_arr['location']             = $row['location'];
    $temp_arr['appointment_time']     = $row['appointment_time'];
    $temp_arr['appointment_date']     = date('F d,Y', strtotime($row['appointment_date']));
    $temp_arr['status']               = $status;
  
    $appointment[] = $temp_arr;

  }
}

foreach ($appointment as $key => $value) {


  $button = "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
&nbsp
    <button class= 'btn btn-danger btn-sm' onclick = 'delete_a(" . $value['appointment_id'] . " )'><i class='fa fa-trash'></i></button>
    </div>
  </td>
    ";

  $data['data'][] = array($value['type_name'],$value['location'],$value['u_name'],$value['appointment_date'].', '.$value['appointment_time'],$value['status'], $button);
}


echo json_encode($data);
