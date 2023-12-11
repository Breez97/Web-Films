<html>
    <head>
        <title>Обновление пользователя</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
            include "../connection.php";
            if(isset($_GET['user_id']))
            {
                $user_id = $_GET['user_id'];
                $result = mysqli_query($descr, "SELECT * FROM users WHERE id=$user_id");
                while($array = mysqli_fetch_array($result))
                {
                    $old_name = $array['name'];
                    $old_login = $array['login'];
                    $old_password = $array['password'];
                    $old_email = $array['email'];
                    $old_is_admin = $array['is_admin'];
                }
            }
            else
            {
                header("Location: users_db_update.php");
                exit();
            }
        ?>
        <div class='main-container'>
            <div class='header-text'>Обновление пользователя</div>
            <form action='user_update_func.php' method='POST' enctype="multipart/form-data">
                <table width=70% align="center">
                    <tr>
                        <td class='input-name'>Имя : </td>
                        <td><input type='text' placeholder='Имя Фамилия' class='input' name='new_name' <?php printf("value='$old_name'");?>required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Логин : </td>
                        <td><input type='text' placeholder='Логин' class='input' name='new_login' <?php printf("value='$old_login'");?> required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Пароль : </td>
                        <td><input type='password' placeholder='Пароль' class='input' name='new_password' <?php printf("value='$old_password'")?> required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Почта : </td>
                        <td><input type='text' placeholder='Почта' class='input' name='new_email' <?php printf("value='$old_email'");?> required></td>
                    </tr>
                    <tr>
                        <td colspan="2" class='input-name'>Админ : <input type='checkbox' name='new_admin' <?php if($old_is_admin == 1) printf("checked");?>></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type='hidden' name='user_id' <?php printf("value='$user_id'");?>>
                            <div class='button-container-row'>
                                <button type='submit'>Обновить</button>
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