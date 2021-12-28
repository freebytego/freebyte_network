<?php
if (isset($_POST['postpublish_button'])) {
	$from_ID = $id;
	$page_ID = $_POST['onPageID'];
	$postData = htmlspecialchars($_POST['post-data'], ENT_DISALLOWED);
	$date = date("Y-m-d H:i:s");
	if (isset($postData) && !empty($postData) && !ctype_space($postData)) {
		$createPostQuery = "INSERT INTO posts (from_id, page_id, post, likes, liked_by, publish_date) VALUES ('$from_ID','$page_ID','$postData','0', '', '$date')";
		if(mysqli_query($con, $createPostQuery)) {
			echo "";
			$postsCount = "SELECT * FROM users WHERE id='$id'";
			$post_query = mysqli_query($con, $postsCount);
			while($postCount_row=mysqli_fetch_assoc($post_query)) {
				$posts_count = $postCount_row['posts'];
				$posts_count = $posts_count + 1;
				$postsapply_query = "UPDATE users SET posts='$posts_count' WHERE id='$id'";
				$post_query = mysqli_query($con, $postsapply_query);
			}
		} else {
			echo "ERROR: Could not able to execute query " . mysqli_error($con);
		}
		$_POST = array();
		header("Location:index.php?page=profile&id=$page_ID");
	} 
}

?>