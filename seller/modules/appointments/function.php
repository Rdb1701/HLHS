<?php
function count_all_appointments($owner_id, $db)
{
    $query = "
	SELECT COUNT(*) 
    FROM property_appointment as app
    LEFT JOIN property as prop ON prop.property_id = app.property_id
    LEFT JOIN user as u ON u.user_id = app.customer_id
    LEFT JOIN property_type as pt ON pt.property_type_id = prop.property_type_id
    WHERE prop.user_id = '$owner_id'
    AND app.status = '0'
	";

    $count = "";
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    while ($row = mysqli_fetch_array($result)) {
        $count =  $row[0];
    }

    $output = '';
    if ($count > 0) {
        $output = '<span class="badge rounded-pill bg-success">' . $count . '</span>';
    }
    return $output;
}

?>