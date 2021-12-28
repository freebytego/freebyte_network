<?php

include "include/comment_remove.php";
include "include/comment_like.php";

$post_ID = $_GET['post_commentID'];

$locateComments = "SELECT * FROM comments WHERE post_id='$post_ID'";
$comment_query = mysqli_query($con, $locateComments);

while ($comment_row = mysqli_fetch_assoc($comment_query)) {
	$comment_items[] = $comment_row;
}

	$comment_items = array_reverse($comment_items, true);
?>

<?php foreach($comment_items as $comment){ ?>
   <div class="comment">
    	<a href="index.php?page=profile&id=<?php echo $comment['from_id']; ?>" class="comment-publisher"><?php $comment_authorID = $comment['from_id'];
		$cpage = "SELECT * FROM users WHERE id='$comment_authorID'";
		$cquery = mysqli_query($con, $cpage);
		while($crow=mysqli_fetch_assoc($cquery)) {
		echo $crow['username'];
		} ?></a>
		<p class="comment-publishdate"><?php echo $comment['date'] ?></p>
		<div class="comment_text">
			<?php echo $comment['comment']; ?>
    	</div>



    	<div class="comment-buttons">
			<?php 

			$post_comID = $comment['post_id'];
			$ccpage = "SELECT * FROM posts WHERE id='$post_comID'";
			$ccquery = mysqli_query($con, $cpage);
			while($ccrow=mysqli_fetch_assoc($ccquery)) {
				$postAuthor_ID = $ccrow['page_id'];
			}

			if ($comment['from_id'] == $id || $postAuthor_ID == $id) {?>
   			
   			<form method="POST" class="post-remove" target="votar">
   				<input type="text" name="comment_removeID" value="<?php echo $comment['id']; ?>" class="sr-only">
				<button class="form-btn-remove" type="submit" name="commentremove_button" onclick="reloadonlike()">Удалить</button>
			</form>

   		<?php } ?>
   			<form method="POST" class="post-like" id="like_button" target="votar">
   				<input type="text" name="comment_likeID" value="<?php echo $comment['id']; ?>" class="sr-only">
				<button class="form-btn-like" type="submit" name="comment_like_button" onclick="reloadonlike()">
				<?php 
					$likedID = $comment['id'];
					$likesCount = "SELECT * FROM comments WHERE id='$likedID'";
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
<?php } ?>





    