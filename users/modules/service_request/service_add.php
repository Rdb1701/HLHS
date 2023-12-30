<?php
require_once '../../backend/connection.php';
date_default_timezone_set('Asia/Manila');

$data        = array();
$res_message = '';
$res_success = 0;
$quantity = 0;

$add_service   = mysqli_real_escape_string($db, trim($_POST['add_service']));
$add_concern   = mysqli_real_escape_string($db, trim($_POST['add_concern']));

$datecode = date("Y-m-d H:i:s");

$q   =  substr("$datecode",0,4);
$w   =  substr("$datecode",5,-12);
$e   =  substr("$datecode",8,-9);
$r   =  substr("$datecode",11,-6);
$t   =  substr("$datecode",14,-3);
$y   =  substr("$datecode",-2);

// $concatqr = $q .'-'.$w .'-'. $e .' '. $r .':'.$t.':'.$y;
$concatcode = $q.$w.$e.$r.$t.$y;

$query = "
INSERT INTO tbl_other_transaction(
user_id,
type_service,
transaction_code,
concern,
date_inserted,
ot_status)VALUES(
'".$_SESSION['user']['user_id']."',
'$add_service',
'$concatcode',
'$add_concern',
'$datecode',
'0'
)
";
if($db->query($query)){
    $res_success = 1;
    
}else{
    $res_message = "Query Failed!";
}

$data['res_success'] = $res_success;
$data['res_message'] = $res_message;

echo json_encode($data);
?>