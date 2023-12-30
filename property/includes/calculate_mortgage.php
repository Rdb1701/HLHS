<?php

include "../../app/database.php";
date_default_timezone_set('Asia/Manila');

$amount = $_POST['amount'];
$mon    = $_POST['month'];
$int    = $_POST['interest'];
$data = array();

$interest = $amount * $int/100;
$pay      = $amount + $interest;
$month    = $pay / $mon;


$data['interest'] = $interest;
$data['pay']      = $pay;
$data['month']    = $month;

echo json_encode($data);

?>