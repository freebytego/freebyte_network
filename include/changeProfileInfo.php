<?php

include "../database/config.php";
include "header.php";
include "profileData.php";


if (isset($_POST['change_flnames_button'])) {
	$toFName = $_POST['setting_fname'];
	$toLName = $_POST['setting_lname'];
	$toBDay = $_POST['setting_bday'];
	$toEMail = $_POST['setting_email'];
	if (hash('sha256',md5($_POST['setting_confirmpassword']))==$p_password) {
		$changeDataSQL = "UPDATE users set first_name='$toFName', last_name='$toLName', birthday='$toBDay', email='$toEMail' WHERE id=$p_id";
		mysqli_query($con, $changeDataSQL);
		header("Location: ../settings.php?success=1");
	} else {
		header("Location: ../settings.php?error=1");
	}
}

?>