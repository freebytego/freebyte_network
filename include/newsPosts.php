<?php

include "include/post_remove.php";
include "include/post_like.php";


$yourFriendsClear = array();

$locateFriendnoPending = "SELECT * FROM friends WHERE (to_username='$username') OR (from_username='$username')";
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

foreach ($yourFriendsClear as $friend) {
	$locateFriendID = "SELECT * FROM users WHERE username='$friend'";
	$query = mysqli_query($con, $locateFriendID);
	while($friendsrow=mysqli_fetch_assoc($query)) {
		$idArray[] = $friendsrow['id'];
	}
}
	
$idArray = array_unique($idArray);
array_push($idArray, $p_id);

$locatePosts = "SELECT * FROM posts WHERE from_id IN ('".implode("','", $idArray)."')";
$post_query = mysqli_query($con, $locatePosts);

while ($post_row = mysqli_fetch_array($post_query, MYSQLI_ASSOC)) {
	$items[] = $post_row;
}

	$items = array_reverse($items, true);
?>

<?php foreach($items as $item){ ?>
   <div class="post" style="max-width: 55%;">
   		

    	<a href="index.php?page=profile&id=<?php echo $item['from_id'] ?>" class="post-publisher"><?php $useID = $item['from_id'];
    	$onpageid = $item['page_id'];
		$fpage = "SELECT * FROM users WHERE id='$useID'";
		$fquery = mysqli_query($con, $fpage);
		while($frow=mysqli_fetch_assoc($fquery)) {
			echo $frow['username'];
			$profPic = $frow['profile_picture'];
		} ?></a>

		<?php if ($useID != $onpageid) { ?>
			на странице <a href="index.php?page=profile&id=<?php echo $item['page_id'] ?>" class="post-publisher">
				<?php $fpage = "SELECT * FROM users WHERE id='$onpageid'";
					$fquery = mysqli_query($con, $fpage);
					while($frow=mysqli_fetch_assoc($fquery)) {
						echo $frow['username'];
					} ?>
			</a>
		<?php } ?>

		<br>
		<img src="<?php echo $profPic; ?>" class="news-avatar">
		<p class="post-publishdate"><?php echo $item['publish_date'] ?></p>
		<div class="post_text">
			<?php echo $item['post']; ?>
		</div>
		<div class="post-buttons">
			<?php if ($item['from_id'] == $id || $item['page_id'] == $id) {?>
   			

   		<?php } ?>
   			<form method="POST" class="post-like" id="like_button" target="votar">
   				<input type="text" name="post_likeID" value="<?php echo $item['id']; ?>" class="sr-only">
				<button class="form-btn-like" type="submit" name="post_like_button" onclick="reloadonlike()">
				<?php 
					$likedID = $item['id'];
					$likesCount = "SELECT * FROM posts WHERE id='$likedID'";
					$like_query = mysqli_query($con, $likesCount);
					while($likeCount_row=mysqli_fetch_assoc($like_query)) {
						$liked_by = $likeCount_row['liked_by'];
						$likes = $likeCount_row['likes'];
						if (strpos($liked_by, '/' . $p_username . '/') === false) {
							echo "Лайк " . $likes;
				}  else {
							echo "Убрать лайк " . $likes;
				}
					}
					
				?>
				</button>
			</form>
			<form action="wallpost.php" method="GET" class="post-comment" id="comment_button">
   				<input type="text" name="post_commentID" value="<?php echo $item['id']; ?>" class="sr-only">
				<button class="form-comments-btn" type="submit" name="post_comments_button">
					Комментарии
				</button>
			</form>
		</div>
    </div>
<?php } ?>





    