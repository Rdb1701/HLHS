<?php
include("../../../app/database.php");

$res_success = 0;
$res_message = '';
$data = array();

$remarks = array();
$remark_id = '';

$property_id = mysqli_real_escape_string($db, trim($_POST['property_id']));

$query= "
SELECT * FROM property_remarks
WHERE property_id = '$property_id'

";
$result = mysqli_query($db,$query);
if (mysqli_num_rows($result) > 0) {
 while($row = mysqli_fetch_assoc($result)){
        $res_success = 1;
      
    $remarks = $row['remarks'];
    $remark_id = $row['remark_id'];

}
    }else{
        $res_message = "Query Failed";
    }
  


    $data['remark_id']    = $remark_id;
    $data['remarks']      = $remarks;
    $data['res_success']  = $res_success;
    $data['res_message']  = $res_message;

    echo json_encode($data);

?>