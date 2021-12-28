<?php

$locatePageProfile = "SELECT * FROM users WHERE id='$pageID'";
$query = mysqli_query($con, $locatePageProfile);
while($row=mysqli_fetch_assoc($query)) {
	$pageUsername = $row['username'];
	$pagePicture = NULL;
	$pagePicture = $row['profile_picture'];
	$pagefname = $row['first_name'];
	$pagelname = $row['last_name'];
}

include "include/friends_handler.php";
include "include/friends_array.php";
include "include/yourfriends_array.php";



?>

<div class="profile-info">
	<img src="<?php echo $pagePicture; ?>" class="profile-picture">
	<b class="profile-username center-align"><?php echo $pageUsername; ?></b>
	<p class="profile-name"><?php echo $pagefname . " " . $pagelname;?></p>

	<?php if ($pageID !== $p_id) { ?>
	<form method="POST" class="add-friends">
		<button type="submit" name="add_friends_button" class="form-btn add-friends-button">
	<?php if ($areFriends == true) {
		echo "Удалить из друзей";
	} else if ($pendingFriend == true) {
		echo "В подписчиках";
	} else {
		echo "Добавить в друзья";
	} ?>
	</button>
	</form>
	<div class="friends-array">
		<p class="form-name">Друзья</p>
		<a href="friends.php?id=<?php echo $pageID;?>" class="friends-array-text" style="color: black;">Все друзья</a>
	<?php 
	foreach ($userFriendsClear as $friend) {
		
		$locateFriendProfile = "SELECT * FROM users WHERE username='$friend'";
		$query = mysqli_query($con, $locateFriendProfile);
		while($row=mysqli_fetch_assoc($query)) {
			$friendUsername = $row['username'];
			$friendID = $row['id'];
			$friendPicture = $row['profile_picture'];
		?>
		<img src="<?php echo $friendPicture?>" class="friendarray-avatar">
		<a class="friends-array-text" href="index.php?page=profile&id=<?php echo $friendID; ?>"><?php echo $friendUsername; ?></a>
		
		<?php } ?>
	<?php } ?>

	</div>
	<?php } else {
	 ?>

	<div class="friendsmy-array">
		<p class="form-name">Мои друзья</p>
		<?php 
		foreach ($yourFriendsClear as $friend) {
			$locateFriendProfile = "SELECT * FROM users WHERE username='$friend'";
			$query = mysqli_query($con, $locateFriendProfile);
			while($row=mysqli_fetch_assoc($query)) {
			$friendUsername = $row['username'];
			$friendID = $row['id'];
			$friendPicture = $row['profile_picture'];
		?>
		<img src="<?php echo $friendPicture?>" class="friendarray-avatar">
		<a class="friends-array-text" href="index.php?page=profile&id=<?php echo $friendID; ?>"><?php echo $friendUsername; ?></a>	 
		 <?php }} ?>
		 
	</div>
	<?php } ?>

</div>
<div class="profile-posts">
	<?php include "include/profilePosts.php"; ?>
</div>