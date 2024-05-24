<html>
    <head>
        <title>Админ панель</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
		<link rel="stylesheet" href="./css/css_ajax.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
        ?>
        <div class='main-container'>
            <div class='header-text'>Добавление, изменение и удаление пользователей</div>
            <div class='buttons-container'>
                <form action='#'>
                    <button type='submit' class="open-popup">Добавить пользователя</button>
                </form>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>

            <?php
                include "../common/connection.php";
                $ids = [];
                $is_admins= [];
                $names = [];
                $logins = [];
                $passwords = [];
                $emails = [];
                $count = 0;
                $result = mysqli_query($descr, "SELECT * FROM users WHERE id != $user_id");
                while($array = mysqli_fetch_array($result))
                {
                    $ids[$count] = $array[0];
                    if($array[1] == 1) $is_admin_value = "Yes";
                    if($array[1] == 0) $is_admin_value = "No";
                    $is_admins[$count] = $is_admin_value;
                    $names[$count] = $array[2];
                    $logins[$count] = $array[3];
                    $passwords[$count] = $array[4];
                    $emails[$count] = $array[5];
                    $count += 1;
                }

                for($i = 0; $i < $count; $i += 1)
                {
                    printf("
						<div class='film-container'>
							<div class='components-container'>
								<div class='name-container'>
									<div class='film-main-text'>Имя</div>
									<div name='user-name' class='film-main-text'>$names[$i]</div>
								</div>
								<div class='login-container'>
									<div class='film-main-text'>Логин</div>
									<div name='user-login' class='film-main-text'>$logins[$i]</div>
								</div>
								<div class='password-container'>
									<div class='film-main-text'>Пароль</div>
									<div name='user-password' class='film-main-text'>$passwords[$i]</div>
								</div>
								<div class='email-container'>
									<div class='film-main-text'>Почта</div>
									<div name='user-email' class='film-main-text'>$emails[$i]</div>
								</div>
								<div class='admin-container'>
									<div class='film-main-text'>Админ</div>
									<div name='user-admin' class='film-main-text'>$is_admins[$i]</div>
								</div>
							</div>
							<div class='buttons-container'>
								<div class='film-main-text'><a class='update-button' data-id='$ids[$i]'>Изменить</a></div>
								<div class='film-main-text'><a class='delete-button' data-id='$ids[$i]'>Удалить</a></div>
							</div>
						</div>
                    ");
                }
            ?>
        </div>

		<div class='popup-bg'>
			<div class='popup-add'>
				<img class="close-popup" src="./img/cross.svg" alt="icon">
				<div class='form-container'>
					<div class='header-text'>Добавление пользователя</div>
					<form method="POST" name="add-form">
						<div class="film-main-text size">Имя пользователя</div>
						<input type="text" name="new-name" class="input-field" placeholder="Имя" required>
						<div class="film-main-text size">Логин пользователя</div>
						<input type="text" name="new-login" class="input-field" placeholder="Логин" required>
						<div class="film-main-text size">Пароль пользователя</div>
						<input type="text" name="new-password" class="input-field" placeholder="Пароль" required>
						<div class="film-main-text size">Почта пользователя</div>
						<input type="text" name="new-email" class="input-field" placeholder="Почта" required>
						<div class="film-main-text size">Админ</div>
                        <select name='new-admin' id='admin-select'>
							<option value='0'>Нет</option>
                            <option value='1'>Да</option>
                        </select>
						<button type='submit'>Добавить</button>
					</form>
					<form method="POST" name="update-form">
						<div class="film-main-text size">Имя пользователя</div>
						<input type="text" name="update-name" class="input-field" placeholder="Имя" required>
						<div class="film-main-text size">Логин пользователя</div>
						<input type="text" name="update-login" class="input-field" placeholder="Логин" required>
						<div class="film-main-text size">Пароль пользователя</div>
						<input type="text" name="update-password" class="input-field" placeholder="Пароль" required>
						<div class="film-main-text size">Почта пользователя</div>
						<input type="text" name="update-email" class="input-field" placeholder="Почта" required>
						<div class="film-main-text size">Админ</div>
                        <select name='update-admin' id='admin-select'>
							<option value='0'>Нет</option>
                            <option value='1'>Да</option>
                        </select>
						<button type='submit'>Изменить</button>
					</form>
					<form method="POST" name="delete-form">
                        <div class="film-main-text yes-no-size" name="film-title"></div>
                        <div class="film-main-text size">Вы точно хотите удалить?</div>
                        <button name="yes-button" class="yes-no-button">Да</button>
                        <button name="no-button" class="yes-no-button">Нет</button>
                    </form>
				</div>
			</div>
			<div class="popup-info-container">
            </div>
		</div>

		<script src="./scripts/jquery.js"></script>
		<script src="./scripts/users.js"></script>
    </body>
</html>