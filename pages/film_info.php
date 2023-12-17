<html>
    <head>
        <title>Обзор</title>
        <link rel="icon" type="image/x-icon" href="icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_common.css">
        <link rel="stylesheet" href="../css/css_film_info.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            $need_to_add = NULL;
            $need_to_change = NULL;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
            if(isset($_GET["film_id"])) $film_id = $_GET["film_id"];
            if(isset($_GET['add'])) $need_to_add = 1;
            if(isset($_GET['change'])) $need_to_change = 1;
        ?>

        <div class="header-container">
            <?php
                include "../common/header.php";
                print_header($user_id, 'films');
            ?>
        </div>

        <div class="create-line"></div>

        <?php
            include "../common/connection.php";
            $title = NULL;
            $description = NULL;
            $header_image = NULL;
            $rating = NULL;
            $genre = NULL;
            $result = mysqli_query($descr, "SELECT films.title, films.rating, films.header_image, films_info.description, films_info.genre FROM films, films_info WHERE films.id=$film_id AND films_info.film_id=$film_id");
            while($array = mysqli_fetch_array($result))
            {
                $title = $array[0];
                $description = $array[3];
                $header_image = $array[2];
                $rating = $array[1];
                $genre = $array[4];
            }

            printf("
                <div class='header-image'>
                    <img src='../$header_image'>
                </div>
                <div class='description-container'>
                    <div class='film-title'>$title</div>
                    <div class='film-genre'>Жанр: $genre</div>
                </div>
            ");

            if($user_id == NULL)
            {
                printf("
                <div class='description-container'>
                    <div class='film-genre'>Рейтинг : $rating / 10</div>
                    <form action='../auth_and_reg/auth.php' method='POST'>
                        <button type='submit'>Добавить в избранное</button>
                    </form>
                </div>
                ");
            }
            else
            {
                $result = mysqli_query($descr, "SELECT * FROM favourites WHERE film_id=$film_id AND user_id=$user_id");
                $is_found = 0;
                while($array = mysqli_fetch_array($result)) $is_found = 1;

                if($is_found == 0)
                {
                    printf("
                    <div class='description-container'>
                        <div class='film-genre'>Рейтинг : $rating / 10</div>
                        <form action='add_to_favourites.php?user_id=$user_id&film_id=$film_id&page=film_info.php?film_id=$film_id' method='POST'>
                            <button type='submit'>Добавить в избранное</button>
                        </form>
                    </div>
                    ");
                }
                else
                {
                    $result = mysqli_query($descr, "SELECT * FROM favourites WHERE film_id=$film_id AND user_id=$user_id");
                    $id = NULL;
                    while($array = mysqli_fetch_array($result)) $id = $array['id'];
                    printf("
                    <div class='description-container'>
                        <div class='film-genre'>Рейтинг : $rating / 10</div>
                        <form action='remove_from_favourites.php?id=$id&page=film_info.php?film_id=$film_id' method='POST'>
                            <button type='submit'>Удалить из избранных</button>
                        </form>
                    </div>
                    ");
                }
            }
            printf("
                <div class='full-description'>$description</div>
            ");

            if($user_id == NULL)
            {
                $result = mysqli_query($descr, "SELECT comments_and_ratings.comment, comments_and_ratings.rating, users.name FROM comments_and_ratings, users WHERE users.id=comments_and_ratings.user_id AND film_id=$film_id");
            }
            else
            {
                $result = mysqli_query($descr, "SELECT comments_and_ratings.comment, comments_and_ratings.rating, users.name FROM comments_and_ratings, users WHERE users.id=comments_and_ratings.user_id AND film_id=$film_id AND user_id!=$user_id");
            }

            $name = [];
            $comment = [];
            $rating = [];
            $count = 0;
            while($array = mysqli_fetch_array($result))
            {
                $name[$count] = $array[2];
                $comment[$count] = $array[0];
                $rating[$count] = $array[1];
                $count += 1;
            }
            if($count == 0)
            {
                printf("
                    <div class='comments-container'>
                        <div class='top-text'>Комментарии пользователей</div>
                        <div class='top-text'>Пользователи пока не оставили никаких комментариев</div>
                    </div>
                ");
            }
            else
            {
                printf("
                    <div class='comments-container'>
                    <div class='top-text'>Комментарии пользователей</div>
                ");
                for($i = 0; $i < $count; $i += 1)
                {
                    printf("
                        <div class='comment-container'>
                            <div class='comment-film-name'>$name[$i]</div>
                            <div class='comment-film-rating'>Оценка пользователя : $rating[$i] / 10</div>
                            <div class='comment-film-rating'>$comment[$i]</div>
                        </div>
                    ");
                }
                printf("</div>");
            }

            if($user_id != NULL)
            {
                $result = mysqli_query($descr, "SELECT * FROM comments_and_ratings WHERE film_id=$film_id AND user_id=$user_id");
                $comment = NULL;
                $rating = NULL;
                while($array = mysqli_fetch_array($result))
                {
                    $comment = $array['comment'];
                    $rating = $array['rating'];
                }

                printf("
                    <div class='comments-container'>
                    <div class='top-text'>Ваши оценка и комментарий</div>
                    <div class='comment-container'>
                ");

                if($need_to_add == 1)
                {
                    printf("
                        <form action='add_comment_and_rating.php' method='POST'>
                            <div class='comment-film-name'>
                                <input class='input-box' type='number' step='0.1' placeholder='Оценка' name='new_rating' required min=0 max=10>
                            </div>
                            <div class='comment-film-name'>
                                <textarea class='input-box-area' placeholder='Комментарий' name='new_comment' required maxlength=100></textarea>
                            </div>
                            <input type='hidden' name='film_id' value=$film_id>
                            <input type='hidden' name='user_id' value=$user_id>
                            <div class='comment-film-name'>
                                <button type='submit'>Добавить</button>
                            </div>
                        </form>
                    ");
                }
                else
                {
                    if($comment == NULL && $rating == NULL)
                    {
                        printf("
                            <form action='film_info.php?film_id=$film_id&add=1' method='POST'>
                                <button type='submit'>Добавить рейтинг <br>и комментарий</button>
                            </form>
                        ");
                    }
                    else
                    {
                        if($need_to_change == 0)
                        {
                            printf("
                                <div class='comment-film-rating'>Оценка : $rating / 10</div>
                                <div class='comment-film-rating'>$comment</div>
                                <form action='film_info.php?film_id=$film_id&change=1' method='POST'>
                                    <button type='submit'>Изменить</button>
                                </form>
                                <form action='remove_comment_and_rating.php' method='POST'>
                                    <input type='hidden' name='film_id' value=$film_id>
                                    <input type='hidden' name='user_id' value=$user_id>
                                    <button type='submit'>Удалить</button>
                                </div>
                            ");
                        }
                        else
                        {
                            printf("
                                <form action='change_comment_and_rating.php' method='POST'>
                                    <div class='comment-film-name'>
                                        <input class='input-box' type='number' step='0.1' placeholder='Оценка' name='new_rating' required min=0 max=10 value=$rating>
                                    </div>
                                    <div class='comment-film-name'>
                                        <textarea class='input-box-area' placeholder='Комментарий' name='new_comment' required maxlength=1000>$comment</textarea>
                                    </div>
                                    <input type='hidden' name='film_id' value=$film_id>
                                    <input type='hidden' name='user_id' value=$user_id>
                                    <div class='comment-film-name'>
                                        <button type='submit'>Сохранить</button>
                                    </div>
                                </form>
                            ");
                        }
                    }
                }
                printf("</div></div>");
            }
        ?>

        <div class="create-line"></div>

        <?php include "../common/footer.php"; ?>

    </body>
</html>