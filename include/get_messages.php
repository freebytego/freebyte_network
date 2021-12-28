<?php

include "../database/config.php";

if (isset($_POST['id'])) {
	$friend_id = $_POST['id'];
	$myid = $_POST['myid'];
	$getMessages = "SELECT * FROM messages WHERE (from_id='$myid' AND to_id='$friend_id') OR (from_id='$friend_id' AND to_id='$myid')";
	$makeRead = "UPDATE messages SET readMessage='YES' WHERE (from_id='$friend_id' AND to_id='$myid')";
	$query = mysqli_query($con, $getMessages);
	while ($row = mysqli_fetch_assoc($query)) {
		$messages[] = $row;
	}
	$query = mysqli_query($con, $makeRead);
	$messages = array_reverse($messages, true);

	foreach ($messages as $message) {
		if ($message['from_id']==$myid) { ?>
			<div class="message-cloud-my">
				
				<div><?php echo $message['message']; ?></div>
				<div class="message-date"><?php echo $message['date']; ?></div>
			</div>

	<?php } else { ?>
			<div class="message-cloud-friend">
				
				<div><?php echo $message['message']; ?></div>
				<div class="message-date"><?php echo $message['date']; ?></div>

			</div>
	<?php }}
}
?>