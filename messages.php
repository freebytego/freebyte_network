<?php

include "database/config.php"; 
include "include/header.php";
include "include/profileData.php";

$getPageUsername = "SELECT * FROM users WHERE id='$p_id'";
$query = mysqli_query($con, $getPageUsername);
while($row=mysqli_fetch_assoc($query)) {
	$getUsername = $row['username'];
}
$userFriendsClear = array();
$locateFriendnoPending = "SELECT * FROM friends WHERE (to_username='$getUsername' AND is_pending='NO') OR (from_username='$getUsername' AND is_pending='NO')";
$addedfriendsquery = mysqli_query($con, $locateFriendnoPending);
while($friendsrow=mysqli_fetch_assoc($addedfriendsquery)) {
	$friendsArray[] = $friendsrow;
}
foreach ($friendsArray as $addedFriend) {
 	if ($addedFriend['from_username']==$getUsername) {
 		array_push($userFriendsClear, $addedFriend['to_username']);
 	} else {
 		array_push($userFriendsClear, $addedFriend['from_username']);
 	}
 }
 $userFriendsClear = array_unique($userFriendsClear);
?>


<!DOCTYPE html>
<html lang="en">
    <head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<title>FreeByte Network</title>
	<link rel="stylesheet" href="themes/style.css">

	<script>
		$(document).ready(function () {
			<?php if (!isset($_GET['id'])) {
				$useID = '0';
			} else {
				$useID = $_GET['id']; ?>
				var input = document.getElementById("messageText");
				input.addEventListener("keyup", function(event) {
					if (event.keyCode === 13) {
						event.preventDefault();
						document.getElementById("sendmessage_button").click();
					}
				});
				 <?php } ?>
			
			function reloadchat() {
			$("#messageList").load("include/get_messages.php", {id: <?php echo $useID; ?>, myid: <?php echo $p_id?>});
			<?php 

			$makeRead = "UPDATE messages SET readMessage='YES' WHERE (from_id='$useID' AND to_id='$p_id')";
			$query = mysqli_query($con, $getMessages);

			?>
			$.ajax ({
					url: "include/checkUnreadinMessages.php",
					type: "POST",
					data: ({
							myid: <?php echo $id; ?>,
							}),
					dataType: "text",
					success: function (data) {
						if (data != "NO") {
							var json = JSON.parse(data);
							var arrayLength = json.length;
							for (var i = 0; i < arrayLength; i++) {
	    						var edit = document.getElementById(json[i]);
	    						edit.classList.add("unread");
	    					}
    					}

					}
				});
  			}
 			
  			$("#messageList").load("include/get_messages.php", {id: <?php echo $useID; ?>, myid: <?php echo $p_id?>});
  			
  			reloadchat();
  			window.setInterval(reloadchat, 1000);
			$("#sendmessage_button").bind("click", function () {
				$.ajax ({
					url: "include/send_message.php",
					type: "POST",
					data: ({messageText: $("#messageText").val(),
							id: <?php echo $useID; ?>,
							p_id: <?php echo $p_id; ?>}),
					dataType: "text",
					success: function (data) {
						document.getElementById('messageText').value = '';
						reloadchat();
					}
				});
			});
			});
	</script>

    </head>
    <body>
	<div class="usablespace">
		<div class="messages-friends-block">
			<?php 

			foreach ($userFriendsClear as $friend) {
				$locateFriendProfile = "SELECT * FROM users WHERE username='$friend'";
				$query = mysqli_query($con, $locateFriendProfile);
				while($row=mysqli_fetch_assoc($query)) {
					$friendUsername = $row['username'];
					$friendID = $row['id'];
					$friendPicture = $row['profile_picture'];
					$friendLastActive = $row['last_activity'];
			?>
				<a href="messages.php?id=<?php echo $friendID ?>" class="message-select-friend" id="<?php echo $friendID;?>">
					<div class="messages-friend-card">
						<p class="messages-nickname"><?php echo $friendUsername; ?></p>
						<img src="<?php echo $friendPicture; ?>" class="messages-friend-img">
						<?php 

						$currDate = date("Y-m-d H:i:s");
						$diff = strtotime($currDate) - strtotime($friendLastActive);
						if ($diff < 15) {
							echo "<p class='messages-lastActive'>Online</p>";
						} else {
							echo "<p class='messages-lastActive'>$friendLastActive</p>";
						}

						?>
					</div>
				</a>
			<?php }} ?>
		</div>
		<?php if (isset($_GET['id'])) { ?>
			<div class="message-box">
				<div class="messages-list" id="messageList">

				</div>
				<div class="writeMessage-box">
					<form method="POST" class="message-textbox">
						<textarea class="form-messageWrite" id="messageText"></textarea><br>
						<button class="form-btn" type="button" id="sendmessage_button">Отправить</button>
					</form>
				</div>
			</div>
		<?php } ?>

    </body>
</html>