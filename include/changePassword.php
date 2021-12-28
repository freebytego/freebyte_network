<?php

include "../database/config.php";
include "header.php";
include "profileData.php";


if (isset($_POST['change_password_button'])) {


	$prevPassword = md5($_POST['setting_currentpasswordChange']);
	$toPassword = md5($_POST['setting_passwordChange']);
	$passwordConfirm = md5($_POST['setting_passwordConfirmChange']);

	if ($toPassword == $passwordConfirm) {
		if (hash('sha256',$prevPassword)==$p_password) {
			$changeDataSQL = "UPDATE users set password='$toPassword' WHERE id=$p_id";
			mysqli_query($con, $changeDataSQL);
			header("Location: ../settings.php?success=3");
			} else {
			header("Location: ../settings.php?error=5");
		}
	} else {
		header("Location: ../settings.php?error=6");
	}

}

?>