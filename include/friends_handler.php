<?php

$locateFriendList = "SELECT * FROM friends WHERE to_username='$pageUsername' OR from_username='$pageUsername'";
$friendsquery = mysqli_query($con, $locateFriendList);
while($friendsrow=mysqli_fetch_assoc($friendsquery)) {
	$friends[] = $friendsrow;
}

$pendingFriend = false;

foreach ($friends as $friend) {
    if (($friend['to_username'] == $pageUsername && $friend['from_username'] == $p_username) || ($friend['to_username'] == $p_username && $friend['from_username'] == $pageUsername)) {
	if ($friend['is_pending'] == "NO") {
		$areFriends = true;
	} else {
		$pendingFriend = true;
	}
	}
	
} 

if (isset($_POST['add_friends_button'])) {
	if ($areFriends == false && $pendingFriend == false) {
		$friend_request_sql = "INSERT INTO friends (from_username, to_username, is_pending, was_canceled) VALUES ('$p_username', '$pageUsername', 'YES', 'NO')";
		mysqli_query($con, $friend_request_sql);
		$_POST[] = array();
		header("Refresh:0");
		
	} else if ($areFriends == true || $pendingFriend == true) {
		$friend_remove_sql = "DELETE FROM friends WHERE (to_username='$pageUsername' AND from_username='$p_username') OR (to_username='$p_username' AND from_username='$pageUsername')";
		mysqli_query($con, $friend_remove_sql);
		$_POST[] = array();
		header("Refresh:0");
	}
}


?>