<html>
    <head>
        <title>Пользователи_бд</title>
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
            <table width=90%>
                <tr>
                    <td class='id-text'>id</td>
                    <td class='title-text'>name</td>
                    <td class='genre-text'>login</td>
                    <td class='genre-text'>password</td>
                    <td class='genre-text'>email</td>
                    <td class='id-text'>is_admin</td>
                </tr>
                <?php
                    include "../connection.php";
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
                        $is_admins[$count] = $array[1];
                        $names[$count] = $array[2];
                        $logins[$count] = $array[3];
                        $passwords[$count] = $array[4];
                        $emails[$count] = $array[5];
                        $count += 1;
                    }

                    for($i = 0; $i < $count; $i += 1)
                    {
                        printf("
                            <tr>
                                <td class='id-text'>$ids[$i]</td>
                                <td class='title-text'>$names[$i]</td>
                                <td class='genre-text'>$logins[$i]</td>
                                <td class='genre-text'>$passwords[$i]</td>
                                <td class='genre-text'>$emails[$i]</td>
                                <td class='id-text'>$is_admins[$i]</td>
                            </tr>
                        ");
                    }
                ?>
            </table>
            <div class='button-container-row'>
                <form action='users_db_add.php'>
                    <button type='submit'>Добавить</button>
                </form>
                <form action='users_db_update.php'>
                    <button type='submit'>Изменить</button>
                </form>
                <form action='users_db_delete.php'>
                    <button type='submit'>Удалить</button>
                </form>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>
        </div>
    </body>
</html>