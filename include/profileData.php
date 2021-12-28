<?php
$p_username = $_SESSION['username'];
$p_locateProfile = "SELECT * FROM users WHERE username='$username'";
$p_query = mysqli_query($con, $p_locateProfile);
while($row=mysqli_fetch_assoc($p_query)) {
	$p_profilePicture = $row['profile_picture'];
	$p_id = $row['id'];
	$p_fname = $row['first_name'];
	$p_lname = $row['last_name'];
	$p_username = $row['username'];
	$p_password = hash('sha256',$row['password']);
	$p_email = $row['email'];
	$p_gender = $row['gender'];
	$p_birthday = $row['birthday'];
	$p_signupdate = $row['signup_date'];
	if (isset($_GET['page']) ? $_GET['page'] : 'profile') {
		$p_onID = $_GET['id']; 
	}
}
?>