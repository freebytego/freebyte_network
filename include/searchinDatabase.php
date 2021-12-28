<?php

$wasUsed = false;

if (isset($_GET['search_button'])) {
	$search_value=$_GET["search_input"];

	$search_sql="SELECT * FROM users where username like '%$search_value%' OR first_name like '%$search_value%' OR last_name like '%$search_value%'";
	$search_query = mysqli_query($con, $search_sql);

	while ($search_row = mysqli_fetch_assoc($search_query)) {
		$searchItems[] = $search_row;
	}

	if (!empty($searchItems)) {
		$wasUsed = true;
	}
}
?>