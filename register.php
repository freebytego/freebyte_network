<?php

include "database/config.php";
include "include/form_handler/register_handle.php";
include "include/form_handler/login_handle.php";

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
		<div class="topbar center-align">
			<img src="themes/images/logo.png" alt="Logo">
		</div>
		<div class="login-block center-align">
			
			<form action="register.php" method="POST" class="login-form">
				<p class="form-name">Вход</p>
				<div class="form-group">
					<label class="sr-only" for="form-nickname">Никнейм</label>
					<input type="text" name="log_nickname" class="form-nickname form-control" placeholder="Никнейм" value="<?php if(isset($_SESSION['log_nickname'])) {echo $_SESSION['log_nickname'];}?>" required>
				</div>
				<div class="form-group">
					<label class="sr-only" for="form-password">Пароль</label>
					<input type="password" name="log_password" class="form-password form-control" placeholder="Пароль" required>
				</div>
				<button class="form-btn" type="submit" name="login_button">Войти</button>
				<br>
				<?php if(in_array("wronglogindata", $error_array)) echo "Неправильный логин или пароль<br>"; ?>
			</form>
		</div>
		
		<div class="register-block center-align">
			<form action="register.php" method="POST" class="registration-form">
				<p class="form-name">Регистрация</p>
				<div class="form-group">
					<label class="sr-only">Имя</label>
					<input class="form-first-name form-control" type="text" name="reg_fname" placeholder="Имя" value="<?php if(isset($_SESSION['reg_fname'])) {echo $_SESSION['reg_fname'];}?>" required>
				</div>	                        
				<div class="form-group">
					<label class="sr-only">Фамилия</label>
					<input class="form-last-name form-control" type="text" name="reg_lname" placeholder="Фамилия" value="<?php if(isset($_SESSION['reg_fname'])) {echo $_SESSION['reg_lname'];}?>" required>
				</div>
				<div class="form-group">
					<label class="sr-only">Никнейм</label>
					<input class="form-username form-control" type="text" name="username" placeholder="Никнейм" value="<?php if(isset($_SESSION['reg_fname'])) {echo $_SESSION['username'];}?>" required>
				</div>
				<div class="form-group">
					<label class="sr-only">Электронная почта</label>
					<input class="form-email form-control" type="text" name="reg_email" placeholder="Электронная почта" value="<?php if(isset($_SESSION['reg_fname'])) {echo $_SESSION['reg_email'];}?>" required>
					
				</div>
											
				<div class="form-group">
					<label class="sr-only">Пароль</label>
					<input class="form-password form-control" type="password" name="reg_password" placeholder="Пароль" required>
				</div>                 
											   
											
				<div class="form-group">
					<label class="sr-only">Пол</label>
					<input type="radio" name="gender" value="Male" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Male"){ ?> checked <?php } ?> required> Мужской
					<input type="radio" name="gender" value="Female" <?php if (isset($_POST['gender']) && $_POST['gender'] == "Female"){ ?> checked <?php } ?> required> Женский
				</div>  
							
				<div class="form-group">      
					<label style="color:#757575">Дата рождения</label><br>
					<input type="date" name="birthday" class="form-date" value="2020-01-01" required>
				</div>

				<button type="submit" name="reg_user" class="form-btn">Зарегистрироваться</button>         
				<br>
				<?php if (in_array("emailtaken", $error_array)) echo "Электронная почта уже используется!<br>";
				if (in_array("emailinvalid", $error_array)) echo "Неправильная электронная почта!<br>";
				if (in_array("usernametaken", $error_array)) echo "Никнейм уже занят.<br>";
				if (in_array("usernamesize", $error_array)) echo "Никнейм должен быть меньше 50 символов.<br>";
				if (in_array("usernamesymbols", $error_array)) echo "Никнейм должен состоять только из латинских символов.<br>";
				if (in_array("passwordsize", $error_array)) echo "Пароль должен быть меньше чем 255 символов<br>";
				if (in_array("passwordsymbols", $error_array)) echo "Пароль должен состоять только из латинских символов.<br>";
				if (in_array("fnamesize", $error_array)) echo "Имя должно иметь длину меньше 50 букв.<br>";
				if (in_array("lnamesize", $error_array)) echo "Фамилия дожна иметь длину меньше 50 букв.<br>";
				if (in_array("timeerror", $error_array)) echo "Вы не можете поставить дату рождения из будущего<br>";
				if ($registerSuccess == true) echo "Успешная регистрация! Войдите в свою страницу выше.<br>";

				?>
			</form>
			
		</div>
		
	</body>

</html>