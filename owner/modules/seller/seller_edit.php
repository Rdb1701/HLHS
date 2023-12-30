<?php 
include("../../../app/database.php");

$seller_id = mysqli_real_escape_string($db, trim($_POST['seller_id']));

$data = array();

$username     = '';
$password     = '';
$name         = '';
$gender       = '';
$email        = '';
$user_type    = '';
$active       = '';


$user_types = array();

$query = "
  SELECT *
  FROM user_seller
  WHERE seller_id = '$seller_id'
";
$result = mysqli_query($db, $query);
if (mysqli_num_rows($result) > 0) {

  $row = mysqli_fetch_assoc($result);

  $username     = $row['username'];
  $password     = $row['password'];
  $name         = $row['u_name'];
  $gender       = $row['gender'];
  $email        = $row['email'];
  $phone        = $row['phone'];
  $active       = $row['isActive'];
  $sale       = $row['commission'];


}

$data['seller_id']     = $seller_id;
$data['username']      = $username;
$data['password']      = $password;
$data['name']          = $name;
$data['phone']         = $phone;
$data['active']        = $active;
$data['gender']        = $gender;
$data['email']         = $email;
$data['sale']          = $sale;


echo json_encode($data);


?>
