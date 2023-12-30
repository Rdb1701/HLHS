<?php


function fetch_user_chat_history($from_user_id, $to_user_id, $property_id, $db)
{


    $query = "
	SELECT * FROM chat 
	WHERE (from_user_id = '" . $from_user_id . "' 
	AND to_user_id = '" . $to_user_id . "'
    AND property_id = '". $property_id ."') 
	OR (from_user_id = '" . $to_user_id . "' 
	AND to_user_id = '" . $from_user_id . "'
    AND property_id = '". $property_id ."')
	ORDER BY date_inserted ASC
	";

    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        $output = '<ul class="list-unstyled">';
        $user_name = '';
        $dynamic_background = '';
        $chat_message = '';

        while ($row = mysqli_fetch_assoc($result)) {
            if ($row["from_user_id"] == $from_user_id) {
                if ($row["status"] == '2') {
                    $chat_message = '<em>This message has been removed</em>';
                    $user_name = '<b class="text-success">You</b>';
                } else {
                    $chat_message = $row['chat_message'];
                    $user_name = '<button type="button" class="remove_chat" id="' . $row['chat_id'] . '">x</button>&nbsp;<b class="text-success">You</b>';
                }


                $dynamic_background = 'background-color:#ffe6e6;';
            } else {
                if ($row["status"] == '2') {
                    $chat_message = '<em>This message has been removed</em>';
                } else {
                    $chat_message = $row["chat_message"];
                }
                $user_name = '<b class="text-danger">' . get_user_name($row['from_user_id'], $db) . '</b>';
                $dynamic_background = 'background-color:white;';
            }
            $output .= '
		<li style="border-bottom:1px dotted #ccc;padding-top:8px; padding-left:8px; padding-right:8px;' . $dynamic_background . '">
			<p>' . $user_name . ' - ' . $chat_message . '
				<div align="right">
					- <small><em>' . $row['date_inserted'] . '</em></small>
				</div>
			</p>
		</li>
		';
        }

    $output .= '</ul>';
    $query = "
	UPDATE chat 
	SET status = '0' 
	WHERE from_user_id = '" . $to_user_id . "' 
	AND to_user_id = '" . $from_user_id . "' 
	AND status = '1'
	";
        mysqli_query($db, $query);
        return $output;
    }
}


function get_user_name($user_id, $db)
{
    $query = "SELECT u_name FROM user_seller WHERE seller_id = '$user_id'";
    $result = mysqli_query($db, $query);
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            return $row['u_name'];
        }
    }else{

        $query = "SELECT u_name FROM user WHERE user_id = '$user_id'";
        $result = mysqli_query($db, $query);
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                return $row['u_name'];
            }
        }
    }
}

function count_unseen_message($from_user_id, $to_user_id, $db)
{
    $query = "
	SELECT COUNT(*) FROM chat
	WHERE from_user_id = '$from_user_id' 
	AND to_user_id = '$to_user_id' 
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





