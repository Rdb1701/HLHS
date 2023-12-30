<?php
include('../../../app/database.php');
include "function.php";

$chats = array();
$type_name = "";
$location = "";

$query = "
SELECT DISTINCT u.u_name, u.user_id, u.username, c.property_id
FROM chat as c
LEFT JOIN user as u ON u.user_id = c.from_user_id
WHERE to_user_id = '" . $_SESSION['owner']['user_id'] . "'
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();

    $temp_arr['user_id']     = $row['user_id'];
    $temp_arr['property_id'] = $row['property_id'];
    $temp_arr['username']    = $row['username'];
    $temp_arr['u_name']      = $row['u_name'];

    $chats[] = $temp_arr;
  }
}



foreach ($chats as $key => $value) {


  $query_property = "
SELECT prop.*, pt.type_name FROM property as prop
LEFT JOIN property_type as pt ON pt.property_type_id = prop.property_type_id
WHERE property_id = '" . $value['property_id'] . "'
";

  $result = mysqli_query($db, $query_property);
  if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $type_name = $row['type_name'];
    $location  = $row['location'];
  }


  $button = "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
    <button class= 'btn btn-success' onclick='chat(" . $value['user_id'] . ",\"" . $value['u_name'] . "\",\"" . $type_name . "\",\"" . $location . "\", " . $value['property_id'] . ")'>Chat</button>
    &nbsp; 
    <button class= 'btn btn-danger' onclick = 'delete_c(" . $value['user_id'] . "," . $value['property_id'] . ")'>Delete</button>
    </div>
  </td>
    ";
  $data['data'][] = array($value['u_name'] .count_unseen_message($value['user_id'], $_SESSION['owner']['user_id'], $db), $type_name, $location, $button);
}


echo json_encode($data);
