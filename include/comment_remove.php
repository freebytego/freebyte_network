<?php
if (isset($_POST['commentremove_button'])) {

	$removeID = $_POST['comment_removeID'];
	$removePostQuery = "DELETE FROM comments WHERE id='$removeID'";
		if(mysqli_query($con, $removePostQuery)) {
			echo "";
		} else {
			echo "ERROR: Could not able to execute query " . mysqli_error($con);
		}
	header("Refresh:0");
}
?>