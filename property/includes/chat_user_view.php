<?php
include "../../app/database.php";
date_default_timezone_set('Asia/Manila');

extract($_POST);

$data       = array();
$owner_name = "";
$owner_id   = "";
$seller     = array();
$data1      = array();
$res_success = 0;
$res_message = "";

$query = "
SELECT *
FROM user
WHERE user_id = '$user_id'
";


$result = mysqli_query($db, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $res_success = 1;
    $owner_name = $row['u_name'];
     $owner_id = $row['user_id'];
}else{
    $res_message = "Query Failed for Owner";
}


$query_sellers = "
SELECT * FROM 
user_seller
WHERE owner_id = '$user_id'
";

$result = mysqli_query($db, $query_sellers);
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $temp_arr = array();

        $res_success = 1;

        $temp_arr['u_name']    = $row['u_name'];
        $temp_arr['seller_id'] = $row['seller_id'];

        $seller[] = $temp_arr;
    }
}else{
    $res_message = "Query Failed for sellers";
}

foreach($seller as $sell){
    array_push($data1, $sell);
}


$data['data1']        = $data1;
$data['owner_name']   = $owner_name;
$data['owner_id']     = $owner_id;
$data['res_success']  = $res_success;
$data['res_message']  = $res_message;

echo json_encode($data);

?>
