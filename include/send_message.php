<?php

include "../database/config.php";

$friend_id = $_POST['id'];
$id = $_POST['p_id'];
$messageText = htmlspecialchars($_POST['messageText'], ENT_DISALLOWED);
$messageDate = date("Y-m-d H:i:s");
if (isset($messageText) && !empty($messageText) && !ctype_space($messageText)) {
	$message_sql = "INSERT INTO messages (from_id, to_id, message, date, readMessage, gotNotification) VALUES ('$id', '$friend_id', '$messageText', '$messageDate', 'NO', 'NO')";
	mysqli_query($con, $message_sql);
}
?>