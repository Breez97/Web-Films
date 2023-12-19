<html>
    <head>
        <title>Админ панель</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
        ?>
        <div class='main-container'>
            <div class='header-text'>Добавление, изменение и удаление пользователей</div>
            <div class='buttons-container'>
                <form action='user_add.php'>
                    <button type='submit'>Добавить пользователя</button>
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
                                <div class='description-container'>
                                    <div class='film-main-text'>Имя</div>
                                    <div class='film-main-text'>$names[$i]</div>
                                </div>
                                <div class='description-container'>
                                    <div class='film-main-text'>Логин</div>
                                    <div class='film-main-text'>$logins[$i]</div>
                                </div>
                                <div class='description-container'>
                                    <div class='film-main-text'>Пароль</div>
                                    <div class='film-main-text'>$passwords[$i]</div>
                                </div>
                                <div class='description-container'>
                                    <div class='film-main-text'>Почта</div>
                                    <div class='film-main-text'>$emails[$i]</div>
                                </div>
                                <div class='description-container'>
                                    <div class='film-main-text'>Админ</div>
                                    <div class='film-main-text'>$is_admins[$i]</div>
                                </div>
                            </div>
                            <div class='buttons-container'>
                                <div class='film-main-text'><a href='user_update.php?user_id=$ids[$i]'>Изменить</a></div>
                                <div class='film-main-text'><a href='user_delete_func.php?user_id=$ids[$i]'>Удалить</a></div>
                            </div>
                        </div>
                    ");
                }
            ?>
        </div>
    </body>
</html>