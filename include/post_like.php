<?php
if (isset($_POST['post_like_button'])) {
	$likeID = $_POST['post_likeID'];
	$likesCount = "SELECT * FROM posts WHERE id='$likeID'";
			$like_query = mysqli_query($con, $likesCount);
			while($likeCount_row=mysqli_fetch_assoc($like_query)) {
				$liked_by = $likeCount_row['liked_by'];
				if (stripos($liked_by, '/' . $p_username . '/') === false) {
					$liked_by = $liked_by  . "/" . $p_username . "/" .  ',';
					$like_count = $likeCount_row['likes'];
					$like_count = $like_count + 1;
					$likesapply_query = "UPDATE posts SET likes='$like_count',liked_by='$liked_by' WHERE id='$likeID'";
					$like_query = mysqli_query($con, $likesapply_query);
					$liked_by = $likeCount_row['liked_by'];
				}  else {
					$liked_by = str_ireplace('/' . $username . '/,', ' ', $liked_by);
					$like_count = $likeCount_row['likes'];
					$like_count = $like_count - 1;
					$likesapply_query = "UPDATE posts SET likes='$like_count',liked_by='$liked_by' WHERE id='$likeID'";
					$like_query = mysqli_query($con, $likesapply_query);
					$liked_by = $likeCount_row['liked_by'];
				}
			}
	}
?>