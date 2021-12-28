<?php

$pendingFriendsClear = array();

$locateFriendPending = "SELECT * FROM friends WHERE to_username='$getUsername' AND is_pending='YES'";
$pendingfriendsquery = mysqli_query($con, $locateFriendPending);
while($pendingrow=mysqli_fetch_assoc($pendingfriendsquery)) {
	$pendingFriendsClear[] = $pendingrow;
}

if (isset($_POST['addfriend_button'])) {
	$pendingID_post = $_POST['pendingID'];
	$setfriend_sql = "UPDATE friends SET is_pending='NO' WHERE id='$pendingID_post'";
	$setfreind_query = mysqli_query($con, $setfriend_sql);
	$_POST = array();
	header("Refresh:0");
}

?>