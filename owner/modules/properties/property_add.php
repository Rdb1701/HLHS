<?php
include("../../../app/database.php");


$res_success = 0;
$res_message = "";
$data = array();

$title             = mysqli_real_escape_string($db, trim($_POST['title']));
$content           = mysqli_real_escape_string($db, trim($_POST['content']));
$ptype             = mysqli_real_escape_string($db, trim($_POST['ptype']));
$stype             = mysqli_real_escape_string($db, trim($_POST['stype']));
$bath              = mysqli_real_escape_string($db, trim($_POST['bath']));
$kitc              = mysqli_real_escape_string($db, trim($_POST['kitc']));
$bed               = mysqli_real_escape_string($db, trim($_POST['bed']));
$balc              = mysqli_real_escape_string($db, trim($_POST['balc']));
$hall              = mysqli_real_escape_string($db, trim($_POST['hall']));
$price             = mysqli_real_escape_string($db, trim($_POST['price']));
$reg_province_id   = mysqli_real_escape_string($db, trim($_POST['reg_province_id']));
$reg_city_id       = mysqli_real_escape_string($db, trim($_POST['reg_city_id']));
$reg_barangay_id   = mysqli_real_escape_string($db, trim($_POST['reg_barangay_id']));
$totalfl           = mysqli_real_escape_string($db, trim($_POST['totalfl']));
$asize             = mysqli_real_escape_string($db, trim($_POST['asize']));
$loc               = mysqli_real_escape_string($db, trim($_POST['loc']));
$status            = mysqli_real_escape_string($db, trim($_POST['status']));

$image             = $_FILES['new_image']['name'];   
$temp_image        = $_FILES['new_image']['tmp_name'];

$document          = $_FILES['new_document']['name'];   
$temp_document     = $_FILES['new_document']['tmp_name'];

$query = "
INSERT INTO property(
    user_id,
    property_type_id,
    title,
    content,
    sale_type,
    bedroom,
    bathroom,
    balcony,
    kitchen,
    hall,
    floor,
    size,
    price,
    location,
    city_id,
    province_id,
    barangay_id,
    property_status,
    status,
    date_inserted,
    date_updated
)VALUES(
    '".$_SESSION['owner']['user_id']."',
    '$ptype',
    '$title',
    '$content',
    '$stype',
    '$bed',
    '$bath',
    '$balc',
    '$kitc',
    '$hall',
    '$totalfl',
    '$asize',
    '$price',
    '$loc',
    '$reg_city_id',
    '$reg_province_id',
    '$reg_barangay_id',
    '$status',
    '0',
    '".date("Y-m-d H:i:s")."',
    '".date("Y-m-d H:i:s")."'
)";

if (mysqli_query($db, $query)) {
    $res_success = 1;
    //INSERTED ID
    $last_id = $db->insert_id;

    // INSERT IMAGES
   // loop insert Images
for ($i = 0; $i < count($image); $i++) {
    $fileName    = $_FILES['new_image']['name'][$i];
    $fileTmpName = $_FILES['new_image']['tmp_name'][$i];

    $query = "
    INSERT INTO property_image(
    property_id,
    image,
    date_inserted
    )values(
    '$last_id',
    '".$fileName."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {

        move_uploaded_file($fileTmpName,"uploads/$fileName");

    } else {
        $res_message = "Query Failed images";
    }
}

//INSERT DOCUMENTS
for ($j = 0; $j < count($document); $j++) {
    $fileName2    = $_FILES['new_document']['name'][$j];
    $fileTmpName2 = $_FILES['new_document']['tmp_name'][$j];

    $query = "
    INSERT INTO property_owner_documents(
    property_id,
    files,
    date_inserted
    )values(
    '$last_id',
    '".$fileName2."',
    '".date("Y-m-d H:i:s")."'
    )
    ";

    if (mysqli_query($db, $query)) {

        move_uploaded_file($fileTmpName2,"upload_documents/$fileName2");

    } else {
        $res_message = "Query Failed documents";
    }
}


}else{
    $res_message = "Wrong query";
}


$data['res_success'] = $res_success;
$data['res_message'] = $res_message;


echo json_encode($data);

?>