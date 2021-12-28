<?php

$yourFriendsClear = array();

$locateFriendnoPending = "SELECT * FROM friends WHERE (to_username='$pageUsername' AND is_pending='NO') OR (from_username='$pageUsername' AND is_pending='NO')";
$addedfriendsquery = mysqli_query($con, $locateFriendnoPending);
while($friendsrow=mysqli_fetch_assoc($addedfriendsquery)) {
	$friendsArray[] = $friendsrow;
}
foreach ($friendsArray as $addedFriend) {
	if ($addedFriend['from_username']==$p_username) {
		array_push($yourFriendsClear, $addedFriend['to_username']);
	} else {
		array_push($yourFriendsClear, $addedFriend['from_username']);
	}

	
}
$yourFriendsClear = array_unique($yourFriendsClear);
?>