<?php

if (isset($_POST['goBackfromComments'])) {
	$backID = $_POST['backtoID'];
	header("Location: ../index.php?page=profile&id=$backID");
}

?>