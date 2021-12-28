<?php

ob_start();
session_start();

$host = "localhost";
$username = "root";
$password = "";
$database = "freebyte";

$con = mysqli_connect($host, $username, $password, $database);
date_default_timezone_set("Europe/Moscow");
if(mysqli_connect_errno()) {
	echo "Failed to connect to database! Code error: " . mysqli_connect_errno();
}

?>
