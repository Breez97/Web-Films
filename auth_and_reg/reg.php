<html>
    <head>
        <title>Регистрация</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_common.css">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_auth_reg.css">
    </head>
    <body>
        <table class="form-container" height=70%>
            <tr>

                <?php
                    $name = NULL;
                    $login = NULL;
                    $password = NULL;
                    $email = NULL;
                    if($_SERVER["REQUEST_METHOD"] == "POST")
                    {
                        $name = $_POST['name_new'];
                        $login = $_POST['login_new'];
                        $password = $_POST['password_new'];
                        $email = $_POST['email_new'];
                        
                        include "../connection.php";

                        $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE login='$login' OR email='$email'");
                        $is_found = 0;
                        while($array = mysqli_fetch_array($result)) $is_found = 1;
                        if($is_found == 0)
                        {
                            $query = mysqli_query($descr, "INSERT INTO users_auth(id, name, login, password, email) VALUES(NULL, '$name', '$login', '$password', '$email')");
                            $is_found_new_user = 0;
                            if($query)
                            {
                                $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE login='$login' AND password='$password'");
                                while($result = mysqli_fetch_array($result))
                                {
                                    $user_id = $result['id'];
                                    $is_found_new_user = 1;
                                }
                                if($is_found_new_user == 1)
                                {
                                    printf("
                                    <form id='go_to_main' action='../main.php' method='POST'>
                                        <input type='hidden' name='user_id' value=$user_id>
                                    </form>
                                    <script>document.getElementById('go_to_main').submit();</script>
                                    ");
                                }
                            }
                        }
                        
                    }
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
                    <form action="../main.php" method="POST">
                        <button type="submit">Вернуться на главную</button>
                    </form>
                </td>
                <td class="image-column"><img src="../images/auth_reg/reg_img.png"></td>
            </tr>
        </table>
    </body>
</html>