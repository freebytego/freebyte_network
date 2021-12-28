<?php

$fname = "";
$lname = "";
$username = "";
$password = "";
$mail = "";
$birthday = "";
$date = "";
$gender = "";
$error_array = array();
$registerSuccess = false;

if(isset($_POST['reg_user'])) {
	$fname = strip_tags($_POST['reg_fname']);
	$fname = str_replace(' ', '', $fname);
	$fname = ucfirst(strtolower($fname));
	$_SESSION['reg_fname'] = $fname;
	
	$lname = strip_tags($_POST['reg_lname']);
	$lname = str_replace(' ', '', $lname);
	$lname = ucfirst(strtolower($lname));
	$_SESSION['reg_lname'] = $lname;
	
	$username = strip_tags($_POST['username']);
	$username = str_replace(' ', '', $username);
	$username = ucfirst(strtolower($username));
	$_SESSION['username'] = $username;
	
	$mail = strip_tags($_POST['reg_email']);
	$mail = str_replace(' ', '', $mail);
	$mail = ucfirst(strtolower($mail));
	$_SESSION['reg_email'] = $mail;
	
	$password = strip_tags($_POST['reg_password']);
	$_SESSION['reg_password'] = $password;
	
	$gender = $_POST['gender'];
	$birthday = $_POST['birthday'];
	
	$date = date("Y-m-d");

	
	if (filter_var($mail, FILTER_VALIDATE_EMAIL)) {
		$mail = filter_var($mail, FILTER_VALIDATE_EMAIL);
		$e_check = mysqli_query($con, "SELECT email from users WHERE email='$mail'");
		$num_rows = mysqli_num_rows($e_check);
		if($num_rows > 0) {
			array_push($error_array, "emailtaken");
		}
	} else {
		array_push($error_array, "emailinvalid");
		}

	$username_check = mysqli_query($con, "SELECT username from users WHERE username='$username'");
	$num_rows = mysqli_num_rows($username_check);
	if ($num_rows > 0) {
		array_push($error_array, "usernametaken");
	}
	if (strlen($username) > 50) {
		array_push($error_array, "usernamesize");
	}
	if(!preg_match("/^[a-zA-Z0-9]+$/", $username) == 1) {
		array_push($error_array, "usernamesymbols");
	}

	if (strlen($password) > 255) {
		array_push($error_array, "passwordsize");
	}
	if(!preg_match("/^[a-zA-Z0-9]+$/", $password) == 1) {
		array_push($error_array, "passwordsymbols");
	}

	if (strlen($fname) > 50) {
		array_push($error_array, "fnamesize");
	}

	if (strlen($lname) > 50) {
		array_push($error_array, "lnamesize");
	}
	if ($birthday > $date) {
		array_push($error_array, "timeerror");
	}
	echo empty($error_array);
	if (empty($error_array) == 1) {
		$password = md5($password);
		$profilePicture = "../../themes/images/defaultProfile/userIcon.png";
		
		$createUserquery = "INSERT INTO users (first_name, last_name, username, email, birthday, gender, password, signup_date, profile_picture, posts, likes, user_closed) VALUES ('$fname','$lname','$username','$mail','$birthday','$gender','$password','$date','$profilePicture','0','0','no')";
		if(mysqli_query($con, $createUserquery)) {
			echo "";
		} else {
			echo "ERROR: Could not able to execute $sql. " . mysqli_error($con);
		}
		header("Location: index.php");
		$_SESSION['username'] = $username;
	}



}

?>