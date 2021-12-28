<?php

include "database/config.php"; 
include "include/header.php";
include "include/profileData.php";

if(isset($_GET['id'])){
    $pageID = $_GET['id'];
} else {
    $pageID = $p_id;
    header("Location: friends.php?id=$p_id");
}

$getPageUsername = "SELECT * FROM users WHERE id='$pageID'";
$query = mysqli_query($con, $getPageUsername);
while($row=mysqli_fetch_assoc($query)) {
	$getUsername = $row['username'];
}

include "include/pendingFriends.php";

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
    </head>
    <body>
	<div class="usablespace">
		<p class="form-name center-align">Друзья</p>

		<?php if ($pageID == $p_id) { ?>

		<div class="friendlist-notification">
			<div class="search-result-block">
				<?php 
				foreach ($pendingFriendsClear as $friend) {
				$pendingFriendNickname = $friend['from_username'];
				$locateFriendProfile = "SELECT * FROM users WHERE username='$pendingFriendNickname'";
				$query = mysqli_query($con, $locateFriendProfile);
				while($row=mysqli_fetch_assoc($query)) {
					$friendUsername = $row['username'];
					$friendFName = $row['first_name'];
					$friendLName = $row['last_name'];
					$friendID = $row['id'];
					$gender = $row['gender'];
					$birthday = $row['birthday'];
					$friendPicture = $row['profile_picture'];
				?>
				<div class="search-card" style="height: 120px; border: 3px solid #cccccc; box-shadow: 0px 4px 0px 0px rgba(0,0,0,0.2)"><a href="index.php?page=profile&id=<?php echo $friendID; ?>" class="search-nickname" style="color: green;"><?php echo $friendUsername; ?></a>
				<img src="<?php echo $friendPicture; ?>" class="search-img" style="top: 17">
				<p class="search-subinfo">Имя: <b><?php echo $friendFName . " " . $friendLName; ?></b></p>
				<p class="search-subinfo">Дата рождения: <b><?php echo $birthday; ?></b></p>
				<p class="search-subinfo">Пол: <b><?php if ($gender=="Male") echo "Мужской"; else echo "Женский"; ?></b></p>
				<form method="POST" class="post-like" target="votar">
					<input type="text" class="sr-only" name="pendingID" value="<?php echo $friend['id']; ?>">
					<button class="form-btn-like" type="submit" name="addfriend_button" style="margin-top: 4px;" onclick="reloadonlike()">Принять</button>
				</form>
				
			</div>
			<?php }} ?>
		</div>
	</div>
		<?php } ?>
		<div class="search-result-block">
		<?php 

		foreach ($userFriendsClear as $friend) {
			$locateFriendProfile = "SELECT * FROM users WHERE username='$friend'";
			$query = mysqli_query($con, $locateFriendProfile);
			while($row=mysqli_fetch_assoc($query)) {
				$friendUsername = $row['username'];
				$friendFName = $row['first_name'];
				$friendLName = $row['last_name'];
				$friendID = $row['id'];
				$gender = $row['gender'];
				$birthday = $row['birthday'];
				$friendPicture = $row['profile_picture'];
		?>

			<div class="search-card"><a href="index.php?page=profile&id=<?php echo $friendID; ?>" class="search-nickname"><?php echo $friendUsername; ?></a>
			<img src="<?php echo $friendPicture; ?>" class="search-img">
			<p class="search-subinfo">Имя: <b><?php echo $friendFName . " " . $friendLName; ?></b></p>
			<p class="search-subinfo">Дата рождения: <b><?php echo $birthday; ?></b></p>
			<p class="search-subinfo">Пол: <b><?php if ($gender=="Male") echo "Мужской"; else echo "Женский"; ?></b></p>

		</div>
		<?php }} ?>
	</div>

			

    </body>
</html>