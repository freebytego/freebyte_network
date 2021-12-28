<?php

include "../database/config.php";
$myusername = $_POST['myusername'];
$getPendingFriends = "SELECT * FROM friends WHERE (to_username='$myusername' AND is_pending='YES')";
$query = mysqli_query($con, $getPendingFriends);
while ($row = mysqli_fetch_assoc($query)) {
	$pending[] = $row['is_pending'];
}

if (!empty($pending)) {
	print_r(json_encode($pending));
} else {
	echo "NO";
}


?>