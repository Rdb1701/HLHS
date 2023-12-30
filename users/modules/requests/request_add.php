<?php
require_once '../../backend/connection.php';

$data        = array();
$res_message = '';
$res_success = 0;
$quantity = 0;

$item_id         = mysqli_real_escape_string($db, trim($_POST['item_id']));
$date_to_borrow  = mysqli_real_escape_string($db, trim($_POST['date_to_borrow']));
$date_to_return  = mysqli_real_escape_string($db, trim($_POST['date_to_return']));


$query = "
SELECT quantity 
FROM tbl_item_stock
WHERE item_stock_id = '$item_id'
";
$result = $db->query($query);
$numRows = $result->num_rows;

if($numRows > 0){
    $row = $result->fetch_assoc();

    $quantity = $row['quantity'];
}else{
    $res_message= "wjwhwwd";
}

$quantity_minus = $quantity - 1;

$sql1 = "
INSERT INTO tbl_borrow_transaction(item_stock_id,
user_id,
date_to_borrow,
date_to_return,
borrow_status)VALUES(
 '$item_id',
 '".$_SESSION['user']['user_id']."',
 '$date_to_borrow',
 '$date_to_return',
 '0'   
)
";

if($db->query($sql1)){


//MINUS 1 the quantity

$sql = "
UPDATE tbl_item_stock
SET
quantity = '$quantity_minus'
WHERE item_stock_id = '$item_id'
";

if($db->query($sql)){
    $res_success = 1;

}else{
    $res_message = "UPDATING QUANTITY QUERY FAILED ";
}

}else{

    $res_message = "Inserting table Error!";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);

?>