<?php
include('../../../app/database.php');

$users = array();

$query = "
SELECT * FROM feedback
";

$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {
  while ($row = mysqli_fetch_assoc($result)) {
    $temp_arr = array();


    $temp_arr['feedback_id']   = $row['feedback_id'];
    $temp_arr['feedback']      = $row['feedback'];


    $users[] = $temp_arr;
  }
}

foreach($users as $key => $value){


    $button= "
    <td class='text-center'>
    <div class='d-flex justify-content-center order-actions'>
      <a href='javascript:;' title='delete feedback' class='text-white bg-danger ms-2'
        onclick='delete_feedback(".$value['feedback_id'].")'>
        <i class='fa fa-trash'></i>
      </a>
    </div>
  </td>
    ";
    $data['data'][] = array($value['feedback'],$button);
  }
  
  
  echo json_encode($data);


?>




