<?php

include "../database/config.php";
$myid = $_POST['myid'];
$getUnreadMessages = "SELECT * FROM messages WHERE (to_id='$myid' AND readMessage='NO')";
$query = mysqli_query($con, $getUnreadMessages);
while ($row = mysqli_fetch_assoc($query)) {
	$unread[] = $row['gotNotification'];
	$unreadmessages[] = $row['readMessage'];
}

if (!empty($unreadmessages)) {
	print_r(json_encode(array("notification" => $unread, "wasRead" => $unreadmessages)));
	$gotNotification = "UPDATE messages SET gotNotification='YES' WHERE (to_id='$myid' AND gotNotification='NO')";
	$query = mysqli_query($con, $gotNotification);
} else {
	echo "NO";
}


?>