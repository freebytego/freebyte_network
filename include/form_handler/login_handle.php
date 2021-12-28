<?php

if (isset($_POST['login_button'])) {
	$username = $_POST['log_nickname'];
	$_SESSION['log_nickname'] = $username;

	$password = md5($_POST['log_password']);

	$checkWithDatabase_query = mysqli_query($con, "SELECT * FROM users WHERE username='$username' AND password='$password'");
	$checkIfExist_query = mysqli_num_rows($checkWithDatabase_query);

	if($checkIfExist_query == 1) {
		$_SESSION['username'] = $username;
		header("Location: index.php");
		exit();
	} else {
		array_push($error_array, "wronglogindata");
	}
}

?>