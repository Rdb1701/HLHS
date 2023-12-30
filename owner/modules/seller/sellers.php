<?php
include('../../../app/database.php');

$sellers = array();

$query = "
SELECT uss.* FROM user_seller as uss
LEFT JOIN user as us ON us.user_id = uss.owner_id
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
    if($row['isActive'] == 0){
      $active = '<span class="text-white bg-warning" style="padding: 3px 8px; border-radius: 5px;">Inactive</span>';

    }
    if($row['isActive'] == 1){
      $active = '<span class="text-white bg-success" style="padding: 3px 8px; border-radius: 5px;">Active</span>';

    }


    $temp_arr['seller_id']   = $row['seller_id'];
    $temp_arr['username']    = $row['username'];
    $temp_arr['u_name']      = $row['u_name'];
    $temp_arr['gender']      = $gender_status;
    $temp_arr['email']       = $row['email'];
    $temp_arr['phone']       = $row['phone'];
    $temp_arr['commission']  = $row['commission'];
    $temp_arr['active']      = $active;


    $sellers[] = $temp_arr;
  }
}

foreach($sellers as $key => $value){


    $button1 = '';
    if($value['active'] == '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Active</span>'){
        $button1 = " <button class = 'btn btn-warning'  title='Inactive' onclick='inactive_event(".$value['seller_id'].")'><i class='fa fa-times'></i></button>";
    }else{
        $button1 = " <button class = 'btn btn-success'  title='Active' onclick='active_event(".$value['seller_id'].")'><i class='fa fa-check'></i></button>";
    }


    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='Edit User' class='text-white bg-info'
        onclick='edit_user(".$value['seller_id'].")'>
    <i class='fa fa-edit'></i>
      </a>
      <a href='javascript:;' title='Change Password User' class='text-white bg-warning ms-2'
        onclick='list_changepassword(".$value['seller_id'].",\"".$value['username']."\")'>
        <i class='fa fa-key'></i>
      </a>
      <a href='javascript:;' title='Delete Seller' class='text-white bg-danger ms-2'
        onclick='delete_seller(".$value['seller_id'].")'>
        <i class='fa fa-trash'></i>
      </a>
    </div>
  </td>
    ";
    $data['data'][] = array($value['username'],$value['u_name'], $value['gender'],$value['email'],$value['phone'],$value['commission'].'%',$value['active'],$button);
  }
  
  
  echo json_encode($data);


?>




