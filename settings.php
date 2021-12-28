<?php

include "database/config.php"; 
include "include/header.php";
include "include/profileData.php";

if(isset($_GET['error'])){
    $errorID = $_GET['error'];
}
if(isset($_GET['success'])){
    $successID = $_GET['success'];
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
		<div class="settings-block center-align">
			<form action="include/changeProfileInfo.php" method="POST" class="settings-profileInfo">
					<p class="form-name">Настройки</p>
					<div class="form-group">
						<input type="text" name="setting_fname" class="form-fname form-control" placeholder="Имя" value="<?php echo $p_fname; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" name="setting_lname" class="form-lname form-control" placeholder="Фамилия" value="<?php echo $p_lname; ?>" required>
					</div>
					<div class="form-group">
						<input type="date" name="setting_bday" class="form-birthday form-control" value="<?php echo $p_birthday; ?>" required>
					</div>
					<div class="form-group">
						<input type="text" name="setting_email" class="form-email form-control" placeholder="Электронная почта" value="<?php echo $p_email; ?>" required>
					</div>
					<div class="form-group">
						<input type="password" name="setting_confirmpassword" class="form-confirmpassword form-control" placeholder="Подтвердите свой пароль" required>
					</div>
					<button class="form-btn" type="submit" name="change_flnames_button">Изменить</button>
					<br>
					<?php if ($errorID == 1) {
						include "include/errors/settings_changeInfo.php";
					}
					if ($successID == 1){
						include "include/success/settings_success.php";
					}?>
			</form>
			<form action="uploadAvatar.php" method="POST" class="settings-profileImage" enctype="multipart/form-data">
					<p class="form-name">Сменить фотографию</p>
					<div class="form-group">
						<p class="settings-text">Ваша нынешняя аватарка: </p>
						<img src="<?php echo $p_profilePicture ?>" class="setting-avatarCurrent">
					</div>
					<label for="file-upload" class="form-fileupload">Загрузите фото</label>
					<p class="setting-hint">Рекомендуемый размер аватарки 512x512</p>
					<input type="file" id="file-upload" name="avatar_upload" accept="image/*" class="form-fileupload">
					<?php if ($errorID == 2) {
						include "include/errors/settings_changeAvatar.php";
						echo "<br>";
					} else if ($errorID == 3) {
						include "include/errors/settings_changeAvatar_size.php";
						echo "<br>";
					} else if ($errorID == 4) {
						include "include/errors/settings_changeAvatar_format.php";
						echo "<br>";
					}
					if ($successID == 2){
						include "include/success/settings_success.php";
							echo "<br>";
					}
					
					?>
					<button class="form-btn" type="submit" name="change_avatar_button">Изменить</button>
					<br>
					
			</form>
			<form action="include/changePassword.php" method="POST" class="settings-password">
					<p class="form-name">Сменить пароль</p>
					<div class="form-group">
						<input type="password" name="setting_currentpasswordChange" class="form-currentpassword form-control" placeholder="Нынешний пароль" required>
					</div>
					<div class="form-group">
						<input type="password" name="setting_passwordChange" class="form-password form-control" placeholder="Пароль" required>
					</div>
					<div class="form-group">
						<input type="password" name="setting_passwordConfirmChange" class="form-confirmpassword form-control" placeholder="Подтверждение пароля" required>
					</div>
					<button class="form-btn" type="submit" name="change_password_button">Изменить</button>
					<br>
					<?php if ($errorID == 5) {
						include "include/errors/settings_changeInfo.php";
					}
					if ($errorID == 6) {
						include "include/errors/settings_wrongFuturePassword.php";
					}
					if ($successID == 3){
						include "include/success/settings_success.php";
					}?>
			</form>
		</div>
	</div>
    </body>
</html>