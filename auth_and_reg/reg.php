<html>
    <head>
        <title>Регистрация</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_auth_reg.css">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_common.css">
    </head>
    <body>
        <table class="form-container" height=70%>
            <tr>

                <?php
                    include "reg_function.php";
                ?>

                <td class="form-column">
                    <form action="reg.php" method="POST">
                        <div class="login">Регистрация</div>

                        <div class="login-text">Введите ваше имя и фамилию</div>
                        <?php
                            print("
                            <input type='text' placeholder='Имя и фамилия' name='name_new' class='input-field' value='$name' required>
                            ");
                        ?>
                        
                        <div class="login-text">Введите вашу почту</div>
                        <?php
                            printf("
                                <input type='text' placeholder='Почта' name='email_new' class='input-field' value='$email' required>
                            ");
                        ?>

                        <div class="login-text">Придумайте логин</div>
                        <?php
                            printf("
                                <input type='text' placeholder='Логин' name='login_new' class='input-field' value='$login' required>
                            ");
                        ?>

                        <div class="login-text">Придумайте пароль</div>
                        <input type="password" placeholder="Пароль" name="password_new" class="input-field" required>

                        <?php
                            if($is_found == 1)
                            {
                                printf("
                                    <div class='error-text'>Пользователь с таким логином или почтой уже есть</div>
                                ");
                            }
                        ?>

                        <button type="submit">Зарегистрироваться</button>
                    </form>
                    <div class="login-text_small">Уже есть аккаунт? <a href="auth.php"><b>Войти</b></a></div>
                    <form action="../main/main.php" method="POST">
                        <button type="submit">Вернуться на главную</button>
                    </form>
                </td>
                <td class="image-column"><img src="../images/auth_reg/reg_img.png"></td>
            </tr>
        </table>
    </body>
</html>