<?php
if (isset($_POST['commentpublish_button'])) {
	$commentText = htmlspecialchars($_POST['comment-data'], ENT_DISALLOWED);
	$commentID = $_POST['commentID'];
	$commentDate = date("Y-m-d H:i:s");
	if (isset($commentText) && !empty($commentText) && !ctype_space($commentText)) {
		$comment_sql = "INSERT INTO comments (from_id, post_id, date, comment, likes, liked_by) VALUES ('$p_id', '$commentID', '$commentDate', '$commentText', '0', '')";
		if(mysqli_query($con, $comment_sql)) {
			echo "";
		} else {
			echo "ERROR: Could not able to execute query " . mysqli_error($con);
		}
		$_POST = array();
		header("Location:wallpost.php?post_commentID=$commentID");
	}
}
?>