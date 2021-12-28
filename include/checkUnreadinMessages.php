<?php

include "../database/config.php";
$myid = $_POST['myid'];
$getUnreadMessages = "SELECT * FROM messages WHERE (to_id='$myid' AND readMessage='NO')";
$query = mysqli_query($con, $getUnreadMessages);
while ($row = mysqli_fetch_assoc($query)) {
	$unreadmessages[] = $row['from_id'];
}

if (!empty($unreadmessages)) {
	print_r(json_encode($unreadmessages));
} else {
	echo "NO";
}

?>