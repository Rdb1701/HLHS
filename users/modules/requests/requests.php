<?php

$requests = array();

$query = "
SELECT bt.*, fname, lname, ust.name, i.model, us.isActive, c.category_desc, its.item_stock_id
FROM tbl_borrow_transaction as bt
LEFT JOIN tbl_item_stock as its ON its.item_stock_id = bt.item_stock_id
LEFT JOIN tbl_items as i ON i.item_id = its.item_id
LEFT JOIN tbl_users as us ON us.user_id = bt.user_id
LEFT JOIN tbl_category as c ON c.category_id = i.category_id 
LEFT JOIN tbl_user_types as ust ON ust.user_type_id = us.user_type_id
WHERE bt.user_id = '".$_SESSION['user']['user_id']."'
";

$result = $db->query($query);
$numRows = $result->num_rows;

if ($numRows > 0) {
    while ($row = $result->fetch_assoc()) {
      $temp_arr = array();

      $borrowed_status= "";
    if($row['borrow_status'] == 0){
        $borrowed_status = '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Pending</span>';
    }
    if($row['borrow_status'] == 1){
        $borrowed_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Borrowed</span>';
    }
    if($row['borrow_status'] == 2){
        $borrowed_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Rejected</span>';
    }
    if($row['borrow_status'] == 3){
        $borrowed_status = '<span class="bg-success text-white" style="padding: 3px 8px; border-radius: 5px;">Returned</span>';
    }

    if($row['borrow_status'] == 4){
        $borrowed_status = '<span class="bg-danger text-white" style="padding: 3px 8px; border-radius: 5px;">Warning to Return</span>';
    }

      $temp_arr['borrow_id']       = $row['borrow_id'];
      $temp_arr['user_id']         = $row['user_id'];
      $temp_arr['item_stock_id']   = $row['item_stock_id'];
      $temp_arr['model']           = $row['model'];
      $temp_arr['category']        = $row['category_desc'];
      $temp_arr['serial']          = $row['serial_number'] ? $row['serial_number'] : '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">No Serial Number Yet</span>';
      $temp_arr['borrow_code']     = $row['borrow_code'] ? $row['borrow_code'] : '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">No Borrow Code Yet</span>';
      $temp_arr['fname']           = $row['fname'];
      $temp_arr['lname']           = $row['lname'];
      $temp_arr['date_to_borrow']  = date('F d,Y', strtotime($row['date_to_borrow']));
      $temp_arr['date_to_return']  = date('F d,Y', strtotime($row['date_to_return']));
      $temp_arr['date_borrowed']   = $row['date_borrowed'] ? date('F d,Y', strtotime($row['date_borrowed'])): '<span class="bg-warning text-white" style="padding: 3px 8px; border-radius: 5px;">Not Yet Scheduled</span>' ;
      $temp_arr['status']          = $borrowed_status;

      $requests[] = $temp_arr;

    }

  }


?>