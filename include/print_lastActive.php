<?php 

$currDate = date("Y-m-d H:i:s");
$diff = strtotime($currDate) - strtotime($friendLastActive);
if ($diff < 15) {
	echo "<p class='messages-lastActive'>Online</p>";
} else {
	echo "<p class='messages-lastActive'>$friendLastActive</p>";
}

?>