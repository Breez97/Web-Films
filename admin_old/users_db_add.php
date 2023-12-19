<html>
    <head>
        <title>Добавление пользователя</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
        ?>
        <div class='main-container'>
            <div class='header-text'>Добавление нового пользователя</div>
            <form action='user_add_func.php' method='POST' enctype="multipart/form-data">
                <table width=70% align="center">
                    <tr>
                        <td class='input-name'>Имя : </td>
                        <td><input type='text' placeholder='Имя Фамилия' class='input' name='new_name' required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Логин : </td>
                        <td><input type='text' placeholder='Логин' class='input' name='new_login' required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Пароль : </td>
                        <td><input type='password' placeholder='Пароль' class='input' name='new_password' required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Почта : </td>
                        <td><input type='text' placeholder='Почта' class='input' name='new_email' required></td>
                    </tr>
                    <tr>
                        <td colspan="2" class='input-name'>Админ : <input type='checkbox' name='new_admin'></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class='button-container-row'>
                                <button type='submit'>Добавить</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <div class='button-container-row-2'>
                <form action='users_db.php'>
                    <button type='submit'>Вернуться назад</button>
                </form>
            </div>
        </div>
    </body>
</html>