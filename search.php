<?php

include "database/config.php"; 
include "include/header.php";
include "include/profileData.php";
include "include/searchinDatabase.php"

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
		<div class="search-bar-block">
			<form action="search.php" method="GET" class="search-bar">
				<div class="form-group">
					<input class="form-first-name form-control" type="text" name="search_input" placeholder="Поиск... Например, имя" value="<?php echo $search_value; ?>" required>
					<button type="submit" name="search_button" class="form-btn">Поиск</button>
				</div>
			</form>

		</div>
		<div class="search-result-block">

			<?php if ($wasUsed == false) { ?>
				<div class="search-card-help"><b class="form-name">Найдите своих друзей!</b>
				<p>Поиск ищет каждую букву которую вы написали.</p>
				<p>Поиск ищет имя, фамилию, никнейм</p>
				<p>Усли вы ищете букву "а", поиск выведет всех у кого в имени, фамилии или никнейме есть буква "а". Даже если она одна.</p>
				<br>
				<b>Например, "а" -> "Admin", "sAshA", "ivAn"</b>
				</div>
			<?php } ?>

			<?php foreach ($searchItems as $id => $s_id) {
				?>
			<div class="search-card"><a href="index.php?page=profile&id=<?php echo $s_id['id']; ?>" class="search-nickname"><?php echo $s_id['username']; ?></a>
			<img src="<?php echo $s_id['profile_picture']; ?>" class="search-img">
			<p class="search-subinfo">Имя: <b><?php echo $s_id['first_name'] . " " . $s_id['last_name']; ?></b></p>
			<p class="search-subinfo">Дата рождения: <b><?php echo $s_id['birthday']; ?></b></p>
			<p class="search-subinfo">Пол: <b><?php if ($s_id['gender']=="Male") echo "Мужской"; else echo "Женский"; ?></b></p>
			</div>
		<?php } ?>
		</div>
	</div>
    </body>
</html>