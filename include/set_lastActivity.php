<?php

include "../database/config.php";
$myID = $_POST['id'];
$currentDate = date("Y-m-d H:i:s");

$lastActivity = "UPDATE users SET last_activity='$currentDate' WHERE id='$myID'";
mysqli_query($con, $lastActivity);

?>