<?php

$userFriendsClear = array();

$locateFriendnoPending = "SELECT * FROM friends WHERE (to_username='$pageUsername' AND is_pending='NO') OR (from_username='$pageUsername' AND is_pending='NO')";
$addedfriendsquery = mysqli_query($con, $locateFriendnoPending);
while($friendsrow=mysqli_fetch_assoc($addedfriendsquery)) {
	$friendsArray[] = $friendsrow;
}
foreach ($friendsArray as $addedFriend) {
	if ($addedFriend['from_username']==$pageUsername) {
		array_push($userFriendsClear, $addedFriend['to_username']);
	} else {
		array_push($userFriendsClear, $addedFriend['from_username']);
	}

	
}
$userFriendsClear = array_unique($userFriendsClear);
?>