<?php
function count_all_unseen_message($to_user_id, $db)
{
    $query = "
	SELECT COUNT(*) FROM chat
	WHERE to_user_id = '$to_user_id' 
	AND status = '1'
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