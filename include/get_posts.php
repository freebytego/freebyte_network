<?php

include "include/post_remove.php";
include "include/post_like.php";

$page_ID = $_POST['onPageID'];

$locatePosts = "SELECT * FROM posts WHERE page_id='$pageID'";
$post_query = mysqli_query($con, $locatePosts);

while ($post_row = mysqli_fetch_assoc($post_query)) {
	$items[] = $post_row;
}

	$items = array_reverse($items, true);
?>

<?php foreach($items as $item){ ?>
   <div class="post">
   		
    	<a href="index.php?page=profile&id=<?php echo $item['from_id'] ?>" class="post-publisher"><?php $useID = $item['from_id'];
		$fpage = "SELECT * FROM users WHERE id='$useID'";
		$fquery = mysqli_query($con, $fpage);
		while($frow=mysqli_fetch_assoc($fquery)) {
		echo $frow['username'];
		} ?></a>
		<p class="post-publishdate"><?php echo $item['publish_date'] ?></p>
		<div class="post_text">
			<?php echo $item['post']; ?>
		</div>
		<div class="post-buttons">
			<?php if ($item['from_id'] == $id || $item['page_id'] == $id) {?>
   			
   			<form method="POST" class="post-remove" target="votar">
   				<input type="text" name="post_removeID" value="<?php echo $item['id']; ?>" class="sr-only">
				<button class="form-btn-remove" type="submit" name="postremove_button" onclick="reloadonlike()">Удалить</button>
			</form>

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





    