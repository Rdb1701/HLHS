<?php

$requests_service = array();

$query = "
SELECT * FROM
tbl_other_transaction
WHERE user_id = '".$_SESSION['user']['user_id']."'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $ot_status= "";
      if($row['ot_status'] == 0){
        $ot_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Pending Service</span>';
      }
      if($row['ot_status'] == 1){
        $ot_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Accepted</span>';
      }
      if($row['ot_status'] == 2){
        $ot_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Service Done</span>';
      }
   

      $temp_arr['other_transaction_id']  = $row['other_transaction_id'];
      $temp_arr['type_service']          = $row['type_service'];
      $temp_arr['transaction_code']      = $row['transaction_code'];
      $temp_arr['concern']               = $row['concern'];
      $temp_arr['date_inserted']         = $row['date_inserted'];
      $temp_arr['date_to_service']       = $row['date_to_service'] ? date('F d,Y', strtotime($row['date_to_service'])): '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">No Schedule Yet</span>' ;
      $temp_arr['ot_status']             =  $ot_status;

      $requests_service[] = $temp_arr;

    }

  }


?>