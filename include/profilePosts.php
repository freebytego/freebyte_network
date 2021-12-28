<?php

include "include/publish_post.php";

?>

<div class="profile-allposts">
	<div class="post-upload">
		<form method="POST" class="post-form">
				<input type="text" name="onPageID" value="<?php echo $p_onID; ?>" class="sr-only">
				<p class="form-name">Написать на стене</p>
				<div class="form-group">
					<textarea name="post-data" class="form-postWrite" placeholder="Сегодня я поел..." required></textarea>
				</div>
				<button class="form-btn" type="submit" name="postpublish_button">Опубликовать</button>
				<br>
			</form>
	</div>
	<div class="post-onprofile">
		<?php 
		include "include/get_posts.php";
		?>
	</div>
</div>