<?php

include "database/config.php";
include "include/header.php";
include "include/profileData.php";

$page = (isset($_GET['page']) ? $_GET['page'] : 'profile');

if(isset($_GET['id'])){
    $pageID = $_GET['id'];
} else {
    $pageID = $p_id;
    header("Location: index.php?page=profile&id=$p_id");
}

?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
		<title>FreeByte Network</title>
		<link rel="stylesheet" href="themes/style.css">
	</head>
	<body>
		<div class="usablespace">
			<?php include basename($page).'.php'; ?>
		</div>
	</body>
</html>