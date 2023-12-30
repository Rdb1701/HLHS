<?php 
include("../../../app/database.php");

$user_id = mysqli_real_escape_string($db, trim($_POST['user_id']));

$data = array();

$username     = '';
$password     = '';
$name         = '';
$gender       = '';
$email        = '';
$user_type    = '';
$active    = '';


$user_types = array();

$query = "
  SELECT *
  FROM user
  WHERE user_id = '$user_id'
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
  $user_type_id = $row['user_type_id'];
  $active       = $row['active'];


}

$data['user_id']       = $user_id;
$data['username']      = $username;
$data['password']      = $password;
$data['name']          = $name;
$data['phone']         = $phone;
$data['active']        = $active;
$data['gender']        = $gender;
$data['email']         = $email;
$data['user_type_id']  = $user_type_id;



echo json_encode($data);


?>
