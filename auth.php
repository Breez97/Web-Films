<html>
    <head>
        <title>Авторизация</title>
        <link rel="stylesheet" href="css/css_common.css">
        <link rel="stylesheet" href="css/css_fonts.css">
        <link rel="stylesheet" href="css/css_auth_reg.css">
    </head>
    <body>
        <table class="form-container" height=50%>
            <tr>
                <td class="image-column"><img src="images/auth_reg/login_img.png"></td>
                <td class="form-column">

                    <?php
                        $login = NULL;
                        $password= NULL;
                        if($_SERVER["REQUEST_METHOD"] == "POST")
                        {
                            $login = $_POST["login_input"];
                            $password = $_POST["password_input"];

                            include "connection.php";

                            $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE (login='$login' OR email='$login') AND password='$password'");
                            $is_found = 0;
                            while($array = mysqli_fetch_array($result))
                            {
                                $user_id = $array['id'];
                                $is_found = 1;
                            }
                            if($is_found == 1)
                            {
                                printf("
                                <form id='goToMain' action='main.php' method='POST'>
                                    <input type='hidden' name='user_id' value=$user_id>
                                </form>
                                <script>document.getElementById('goToMain').submit();</script>
                                ");
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
                </td>
            </tr>
        </table>
    </body>
</html>