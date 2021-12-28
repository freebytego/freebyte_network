<?php

include "../../database/config.php";

session_start();
$_SESSION=array();
header("Location: ../../index.php");

?>