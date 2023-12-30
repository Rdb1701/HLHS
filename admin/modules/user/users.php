<?php
include('../../../app/database.php');

$users = array();

$query = "
SELECT us.*, ut.tname as type_name FROM user as us
LEFT JOIN user_type as ut ON ut.user_type_id = us.user_type_id
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();


    $gender_status = "";
    if($row['gender'] == 0){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Female</span>';

    }
    if($row['gender'] == 1){
      $gender_status = '<span class="text-black" style="padding: 3px 8px; border-radius: 5px;">Male</span>';

    }

    $active = "";
    if($row['active'] == 0){
      $active = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';

    }
    if($row['active'] == 1){
      $active = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Active</span>';

    }


    $temp_arr['user_id']   = $row['user_id'];
    $temp_arr['username']  = $row['username'];
    $temp_arr['u_name']    = $row['u_name'];
    $temp_arr['gender']    = $gender_status;
    $temp_arr['email']     = $row['email'];
    $temp_arr['phone']     = $row['phone'];
    $temp_arr['active']    = $active;
    $temp_arr['type_name'] = $row['type_name'];

    $users[] = $temp_arr;
  }
}

foreach($users as $key => $value){


    $button1 = '';
    if($value['active'] == '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Active</span>'){
        $button1 = " <button class = 'btn btn-warning'  title='Inactive' onclick='inactive_event(".$value['user_id'].")'><i class='fa fa-times'></i></button>";
    }else{
        $button1 = " <button class = 'btn btn-success'  title='Active' onclick='active_event(".$value['user_id'].")'><i class='fa fa-check'></i></button>";
    }


    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='Edit User' class='text-white bg-info'
        onclick='edit_user(".$value['user_id'].")'>
    <i class='fa fa-edit'></i>
      </a>
      <a href='javascript:;' title='Change Password User' class='text-white bg-warning ms-2'
        onclick='list_changepassword(".$value['user_id'].",\"".$value['username']."\")'>
        <i class='fa fa-key'></i>
      </a>
    </div>
  </td>
    ";
    $data['data'][] = array($value['username'],$value['u_name'], $value['gender'],$value['email'],$value['phone'],$value['type_name'],$value['active'],$button);
  }
  
  
  echo json_encode($data);


?>




