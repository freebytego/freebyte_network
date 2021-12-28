<?php

include "database/config.php"; 
include "include/header.php";
include "include/profileData.php";
include "include/post_remove.php";
include "include/post_like.php";
include "include/comment_post.php";

$wallpost_id = $_GET['post_commentID'];
$wallpage = "SELECT * FROM posts WHERE id='$wallpost_id'";
$wallquery = mysqli_query($con, $wallpage);
while($wallrow=mysqli_fetch_assoc($wallquery)) {
	$wall_fromID = $wallrow['from_id'];
	$wall_id = $wallrow['id'];
	$wall_pageID = $wallrow['page_id'];
	$wall_post = $wallrow['post'];
	$wall_likes = $wallrow['likes'];
	$wall_date = $wallrow['publish_date'];
}

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
		<div class="goBack">
			<form method="POST" action="include/goBackfromComments.php">
				<input type="text" name="backtoID" class="sr-only" value="<?php echo $wall_pageID ?>">
				<button class="goBack_button" name="goBackfromComments"><</button>
			</form>
		</div>
		<div class="full-post">
		<a href="index.php?page=profile&id=<?php echo $wall_fromID; ?>" class="fullpost-author"><?php 
		$fpage = "SELECT * FROM users WHERE id='$wall_fromID'";
		$fquery = mysqli_query($con, $fpage);
		while($frow=mysqli_fetch_assoc($fquery)) {
		echo $frow['username'];
		}
		?></a>
		<div class="fullpost-post">
			<?php echo $wall_post; ?>
		</div>
		<div class="fullpost-buttons">
			<?php if ($wall_fromID == $id || $wall_pageID == $id) {?>
   			
   			<form method="POST" class="post-remove" target="votar">
   				<input type="text" name="post_removeID" value="<?php echo $wall_id; ?>" class="sr-only">
				<button class="form-btn-remove" type="submit" name="postremove_button" onclick="goBack();">Удалить</button>
			</form>

   		<?php } ?>
   			<form method="POST" class="post-like" id="like_button" target="votar">
   				<input type="text" name="post_likeID" value="<?php echo $wall_id; ?>" class="sr-only">
				<button class="form-btn-like" type="submit" name="post_like_button" onclick="reloadonlike()">
				<?php 
					$likesCount = "SELECT * FROM posts WHERE id='$wall_id'";
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
		</div>
	</div>
		<div class="fullpost-comments">
			<form method="POST" class="comment-form">
				<input type="text" name="commentID" value="<?php echo $wall_id; ?>" class="sr-only">
				<p class="form-name">Оставить комментарий</p>
				<div class="form-group">
					<textarea name="comment-data" class="form-commentWrite" placeholder="Очень круто!..." required></textarea>
				</div>
				<button class="form-btn comment-button" type="submit" name="commentpublish_button">Комментировать</button>
				<br>
			</form>
			<div class="allpost-comments">
				<?php include "include/get_comments.php" ?>
			</div>
		</div>
    </body>
</html>