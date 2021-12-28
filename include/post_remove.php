<?php
if (isset($_POST['postremove_button'])) {

	$removeID = $_POST['post_removeID'];
	$removePostQuery = "DELETE FROM posts WHERE id='$removeID'";
		if(mysqli_query($con, $removePostQuery)) {
			echo "";
			$postsCount = "SELECT * FROM users WHERE id='$id'";
			$post_query = mysqli_query($con, $postsCount);
			while($postCount_row=mysqli_fetch_assoc($post_query)) {
				$posts_count = $postCount_row['posts'];
				if (!$posts_count == 0) {
					$posts_count = $posts_count - 1;
					$postsapply_query = "UPDATE users SET posts='$posts_count' WHERE id='$id'";
					$post_query = mysqli_query($con, $postsapply_query);
				}

			}
		} else {
			echo "ERROR: Could not able to execute query " . mysqli_error($con);
		}
	header("Refresh:0");
}
?>