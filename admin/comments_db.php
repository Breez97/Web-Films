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
            <div class='header-text'>Удаление комментариев</div>
            <div class='buttons-container'>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>
            <?php
                include "../common/connection.php";
                $result = mysqli_query($descr, "SELECT comments_and_ratings.id, users.name, films.title, comments_and_ratings.comment FROM comments_and_ratings 
                INNER JOIN users ON comments_and_ratings.user_id = users.id
                INNER JOIN films ON comments_and_ratings.film_id = films.id");
                $ids = [];
                $names = [];
                $titles = [];
                $comments = [];
                $count = 0;
                while($array = mysqli_fetch_array($result))
                {
                    $ids[$count] = $array[0];
                    $names[$count] = $array[1];
                    $titles[$count] = $array[2];
                    $comments[$count] = $array[3];
                    $count += 1;
                }

                for($i = 0; $i < $count; $i += 1)
                {
                    printf("
                        <div class='film-container'>
                            <div class='components-container'>
                                <div class='description-container'>
                                    <div class='film-main-text'>Имя пользователя</div>
                                    <div class='film-main-text'>$names[$i]</div>
                                </div>
                                <div class='description-container'>
                                    <div class='film-main-text'>Название фильма</div>
                                    <div class='film-main-text'>$titles[$i]</div>
                                </div>
                                <div class='description-container-1'>
                                    <div class='film-main-text'>Комментарий</div>
                                    <div class='film-main-text'>$comments[$i]</div>
                                </div>
                            </div>
                            <div class='buttons-container'>
                                <div class='film-main-text'><a href='comment_delete_func.php?comment_id=$ids[$i]'>Удалить</a></div>
                            </div>
                        </div>
                    ");
                }
            ?>
        </div>
    </body>
</html>