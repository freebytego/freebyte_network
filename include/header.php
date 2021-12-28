<?php

$username = $_SESSION['username'];

$locateProfile = "SELECT * FROM users WHERE username='$username'";
$query = mysqli_query($con, $locateProfile);
while($row=mysqli_fetch_assoc($query)) {
	$profilePicture = $row['profile_picture'];
	$id = $row['id'];
}

if ($_SESSION == NULL) {
    header("Location: register.php");
} 
include "include/pendingFriends.php";
?>
<link rel="stylesheet" type="text/css" href="themes/style.css">
<iframe name="votar" style="display:none;"></iframe>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="js/jquery.cookie.js"></script>
		<script src="js/jquery.rememberscroll.js"></script>
		<script type="text/javascript">
			$(document).ready( function() {
				$.scrollTrack();
			});
			function reloadonlike() {
				setTimeout(function(){
					window.location.reload();
				}, 200);
 				
			}
			function goBack() {
				setTimeout(function(){
					window.history.back();
				}, 200);
			}
			function refresh_lastOnline() {
				$(document).load("include/set_lastActivity.php", {id: <?php echo $id; ?>});
				$.ajax ({
					url: "include/checkUnreadMessages.php",
					type: "POST",
					data: ({
							myid: <?php echo $id; ?>,
							}),
					dataType: "text",
					success: function (data) {
						if (data != "NO") {
							var div = document.getElementById('messages-topbar');
							var json = JSON.parse(data);
							var lengthNotif = json.notification.length;
							for (var i = 0; i < lengthNotif; i++) {
			    				if (json.notification[i] == "NO") {
									if (!(div.classList.contains('alarm'))) {
										var audio = new Audio('../themes/audio/notification.mp3');
										audio.play();
									}
								}		
		    				}
		    				var lengthUnread = json.wasRead.length;
		    				for (var i = 0; i < lengthUnread; i++) {
			    				if (json.wasRead[i] == "NO") {
									if (!(div.classList.contains('alarm'))) {
										div.classList.add('alarm');
									}

								} else {
									div.classList.remove('alarm');
								}		
		    				}	
						}
					}
			});
			$.ajax ({
					url: "include/checkPendingFriends.php",
					type: "POST",
					data: ({
							myusername: '<?php echo $username; ?>',
							}),
					dataType: "text",
					success: function (data) {
						if (data != "NO") {
							var div = document.getElementById('friends-topbar');
							var json = JSON.parse(data);
		    				var lengthPending = json.length;
		    				for (var i = 0; i < lengthPending; i++) {
			    				if (json[i] == "YES") {
									if (!(div.classList.contains('alarm'))) {
										div.classList.add('alarm');
									}

								} else {
									div.classList.remove('alarm');
								}		
		    				}	
						}
					}
			});
			}

			

			window.setInterval(refresh_lastOnline, 1000);
		</script>
<div class="topbar">
	<a href="index.php?page=profile&id=<?php echo $id; ?>" class="topbar-logo topbar-left">
		<img src="<?php echo $profilePicture; ?>" class="topbar-avatar topbar-logo">
	</a>
	<a href="news.php" class="topbar-logo topbar-left">
		<img src="../themes/images/icons/news.png" class="topbar-button-icon">
	</a>
	<a href="messages.php" class="topbar-logo topbar-left">
		<img src="../themes/images/icons/messages.png" class="topbar-button-icon">
		<div id="messages-topbar" class="topbar-alarm topbar-left"></div>
	</a>
	<a href="friends.php" class="topbar-logo topbar-left">
		<img src="../themes/images/icons/friends.png" class="topbar-button-icon">
		<div id="friends-topbar" class="topbar-alarm topbar-left"></div>
	</a>
	<a href="search.php" class="topbar-logo topbar-left"><img src="../themes/images/icons/search.png" class="topbar-button-icon"></a>
	<a href="include/form_handler/logout_handle.php" class="topbar-logo topbar-right"><img src="../themes/images/icons/quit.png" class="topbar-button-icon"></a>
	<a href="settings.php" class="topbar-logo topbar-right"><img src="../themes/images/icons/settings.png" class="topbar-button-icon"></a></a>

</div>