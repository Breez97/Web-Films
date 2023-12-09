<html>
    <head>
        <title>Авторизация</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_auth_reg.css">
    </head>
    <body>
        <table class="form-container" height=50%>
            <tr>
                <td class="image-column"><img src="../images/auth_reg/login_img.png"></td>
                <td class="form-column">
                    <?php

                        $login = NULL;
                        $password = NULL;

                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            $login = $_POST["login_input"];
                            $password = $_POST["password_input"];

                            include "../connection.php";

                            $result = mysqli_query($descr, "SELECT * FROM users WHERE (login='$login' OR email='$login') AND password='$password'");
                            
                            $is_found = false;
                            
                            while ($array = mysqli_fetch_array($result)) {
                                $user_id = $array['id'];
                                $is_found = true;
                            }

                            if ($is_found) {
                                session_start();
                                $_SESSION['user_id'] = $user_id;
                                header("Location: ../main.php");
                                exit();
                            }
                        }
                    ?>

                    <form action="auth.php" method="POST">                        
                        <div class="login">Вход</div>

                        <div class="login-text">Введите ваш логин или почту</div>
                        <?php
                            if($login != NULL && $is_found == 0) printf("<input type='text' placeholder='Логин или почта' name='login_input' class='input-field' value='$login' required>");
                            else printf("<input type='text' placeholder='Логин или почта' name='login_input' class='input-field' required>");
                        ?>

                        <div class="login-text">Введите ваш пароль</div>
                        <input type="password" placeholder="Пароль" name="password_input" class="input-field" required>

                        <?php
                            if($login != NULL && $is_found == 0)
                            {
                                printf("<div class='error-text'>Неверный логин или пароль</div>");
                            }
                        ?>

                        <button type="submit">Войти</button>
                    </form>
                    <div class="login-text_small">Нет аккаунта? <a href="reg.php"><b>Зарегистрироваться</b></a></div>
                    <form action="../main.php" method="POST">
                        <button type="submit">Вернуться на главную</button>
                    </form>
                </td>
            </tr>
        </table>
    </body>
</html>