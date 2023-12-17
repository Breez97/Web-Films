<html>
    <head>
        <title>Личный аккаунт</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_common.css">
        <link rel="stylesheet" href="../css/css_personal_acc.css">
        <link rel="stylesheet" href="../css/css_films_serials.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            $need_to_change = 0;
            $saved = 0;
            $error = 0;
            if(isset($_GET['change']))
            {
                if($_GET['change'] == 1) $need_to_change = 1;
            }
            if(isset($_GET['error'])) $error = 1;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
            if($user_id == NULL) header("Location: main.php");
            if(isset($_POST['update_name']) && isset($_POST['update_login']) && isset($_POST['update_email']) && isset($_POST['update_password']))
            {
                include "connection.php";

                $result = mysqli_query($descr, "SELECT * FROM users WHERE id=$user_id");
                while($array = mysqli_fetch_array($result))
                {
                    $temp_name = $array['name'];
                    $temp_login = $array['login'];
                    $temp_email = $array['email'];
                    $temp_password = $array['password'];
                }
                $query = mysqli_query($descr, "UPDATE users SET name='', login='', password='', email='' WHERE id=$user_id");

                $new_name = $_POST['update_name'];
                $new_login = $_POST['update_login'];
                $new_email = $_POST['update_email'];
                $new_password = $_POST['update_password'];
                $result = mysqli_query($descr, "SELECT * FROM users WHERE login='$new_login' OR email='$new_email'");
                $is_found = 0;
                while($array = mysqli_fetch_array($result)) $is_found = 1;
                if($is_found == 1)
                {
                    $query = mysqli_query($descr, "UPDATE users SET name='$temp_name', login='$temp_login', password='$temp_password', email='$temp_email' WHERE id=$user_id");
                    header("Location: personal_acc.php?error=1&change=1");
                    exit();
                }
                else
                {
                    $query = mysqli_query($descr, "UPDATE users SET name='$new_name', login='$new_login', password='$new_password', email='$new_email' WHERE id=$user_id");
                    header("Location: personal_acc.php");
                    exit();
                }
            }
        ?>
        <div class="header-container">
            <?php
                include "../common/header.php";
                print_header($user_id, 'films');
            ?>
        </div>

        <div class="create-line"></div>

        <div class="main-container">            
            <div class="text-container">
                <?php
                    include "../common/connection.php";
                    $result = mysqli_query($descr, "SELECT * FROM users WHERE id=$user_id");
                    while($array = mysqli_fetch_array($result))
                    {
                        $name = $array['name'];
                        $login = $array['login'];
                        $password = $array['password'];
                        $email = $array['email'];
                    }
                ?>
                <div class="header-text">Добро пожаловать в личный кабинет, <?php printf($name);?></div>
                <div class="info-text">Здесь вы можете посмотреть всю необходимую информацию</div>
            </div>
            
            <?php
                if($need_to_change == 1) printf("<form class='bio-container' action='personal_acc.php' method='POST'>");
                else printf("<div class='bio-container'>");
            ?>
                <div class="personal-user-info">
                    <div class="personal-user-text">
                        <div class="text-info"><b>Имя :</b> 
                            <?php
                                if($need_to_change == 0) printf("$name");
                            ?>
                        </div>
                        <?php
                            if($need_to_change == 1) printf("<input name='update_name' class='input-box' type='text' placeholder='Имя' value='$name' required>");
                        ?>
                    </div>
                    <div class="personal-user-text">
                        <div class="text-info"><b>Почта :</b> 
                            <?php
                                if($need_to_change == 0) printf("$email");
                            ?>
                        </div>
                        <?php
                            if($need_to_change == 1) printf("<input name='update_email' class='input-box' type='text' placeholder='Почта' value='$email' required>");
                        ?>
                    </div>
                    <div class="personal-user-text">
                        <div class="text-info"><b>Логин :</b> 
                            <?php
                             if($need_to_change == 0) printf("$login");
                            ?>
                        </div>
                        <?php
                            if($need_to_change == 1) printf("<input name='update_login' class='input-box' type='text' placeholder='Логин' value='$login' required>");
                        ?>
                    </div>
                    <div class="personal-user-text">
                        <div class="text-info"><b>Пароль :</b> 
                            <?php
                                $maskedPassword = str_repeat('*', mb_strlen($password));
                                if($need_to_change == 0) printf("$maskedPassword");
                            ?>
                        </div>
                        <?php
                            if($need_to_change == 1) printf("<input name='update_password' class='input-box' type='password' placeholder='Пароль' value='$password' required>");
                        ?>
                    </div>
                    <?php
                        if($error == 1)
                        {
                            printf("
                                <div class='personal-user-text'>
                                    <div class='text-info-error'>Такой логин или почта уже заняты</div>
                                </div>
                            ");
                        }
                    ?>
                    <div class="personal-user-text">
                        <?php
                            if($need_to_change == 0)
                            {
                                printf("
                                    <form action='personal_acc.php?change=1' method='POST'>
                                        <div class='personal-user-text'>
                                            <button type='submit'>Изменить</button>
                                        </div>
                                    </form>
                                ");
                            }
                            else
                            {
                                printf("
                                <div class='personal-user-text'>
                                    <button type='submit'>Сохранить</button>
                                </div>
                                ");
                            }
                        ?>
                    </div>
                </div>
            </div>
            <?php
                if($need_to_change == 0) printf("</div>");
                else printf("</form>");
            ?>
            <div class="favourites-container">
                <div class="top-text">Избранное</div>
                <div class="selection-container">
                    <?php
                        include "../common/connection.php";
                        $ids = [];
                        $count_favourites = 0;
                        $result = mysqli_query($descr, "SELECT * FROM favourites WHERE user_id=$user_id");
                        while($array = mysqli_fetch_array($result))
                        {
                            $ids[$count_favourites] = $array['film_id'];
                            $count_favourites += 1;
                        }

                        $count = 0;
                        $films_ids = [];
                        $title = [];
                        $header_images = [];
                        $ratings = [];
                        $result = mysqli_query($descr, "SELECT * FROM films");
                        while($array = mysqli_fetch_array($result))
                        {
                            if(in_array($array['id'], $ids))
                            {
                                $film_ids[$count] = $array['id'];
                                $titles[$count] = $array['title'];
                                $header_images[$count] = $array['header_image'];
                                $ratings[$count] = $array['rating'];
                                $count += 1;
                            }
                        }

                        if($count == 0) printf("<div class='top-text-error'>Вы ничего не добавили в избранное</div>");
                        else
                        {
                            for($i = 0; $i < $count; $i += 1)
                            {
                                if($i % 3 == 0) printf("<div class='cards-container'>");
                                $result = mysqli_query($descr, "SELECT id FROM favourites WHERE user_id=$user_id AND film_id=$film_ids[$i]");
                                while($array = mysqli_fetch_array($result)) $id_favourites = $array['id'];
                                printf("
                                    <div class='film-card'>
                                        <div class='film-image'>
                                            <img src='../$header_images[$i]'>
                                        </div>
                                        <div class='film-title'><a href='../common/film_info.php?film_id=$film_ids[$i]'>$titles[$i]</a></div>
                                        <div class='add-to-favourite-rating'>
                                            <div class='rating'>Рейтинг : $ratings[$i] / 10</div>
                                            <div class='add-to-favourite'>
                                                <a href='../common/remove_from_favourites.php?id=$id_favourites&page=personal_acc'>Удалить из избранных ✖</a>
                                            </div>
                                        </div>
                                    </div>
                                ");
                                if($i % 3 == 2 || $i == $count - 1) printf("</div>");
                            }
                        }
                    ?>
                </div>
            </div>

            <div class="comments-container">
                <div class="top-text">Ваши оценки и комментарии</div>
                <?php
                    include "../common/connection.php";
                    $ids = [];
                    $films_ids = [];
                    $films_titles = [];
                    $comments = [];
                    $ratings = [];
                    $count = 0;
                    $result = mysqli_query($descr, "SELECT comments_and_ratings.id, comments_and_ratings.comment, comments_and_ratings.rating, films.id, films.title FROM comments_and_ratings, films WHERE comments_and_ratings.film_id = films.id AND comments_and_ratings.user_id=$user_id");
                    while($array = mysqli_fetch_array($result))
                    {
                        $ids = $array[0];
                        $film_ids[$count] = $array[3];
                        $films_titles[$count] = $array[4];
                        $comments[$count] = $array[1];
                        $ratings[$count] = $array[2];
                        $count += 1;
                    }

                    for ($i = 0; $i < $count; $i += 1) 
                    {
                        printf("
                            <div class='comment-container'>
                                <div class='comment-film-name'>
                                    <a href='../common/film_info.php?film_id=$film_ids[$i]'>$films_titles[$i]</a>
                                </div>
                                <div class='comment-film-rating'>
                                    Ваша оценка: $ratings[$i] / 10
                                </div>
                                <div class='comment-film-comment'>
                                    $comments[$i]
                                </div>
                            </div>
                        ");
                    }
                ?>
            </div>
        </div>

        <?php include "../common/footer.php"; ?>
        
    </body>
</html>