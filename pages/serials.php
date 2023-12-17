<html>
    <head>
        <title>Сериалы</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_common.css">
        <link rel="stylesheet" href="../css/css_films_serials.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
        ?>
        <div class="header-container">
            <?php
                include "../common/header.php";
                print_header($user_id, 'films');
            ?>
        </div>

        <div class="create-line"></div>

        <div class="main-container">
            <?php
                include "../common/connection.php";
                $film_ids = [];
                $titles = [];
                $small_images = [];
                $genres = [];
                $result = mysqli_query($descr, "SELECT films.id, films.title, films.small_image, films_info.genre FROM films, films_info WHERE films.category='serial' AND films.id = films_info.film_id ORDER BY films.rating DESC LIMIT 3");
                $count = 0;
                while($array = mysqli_fetch_array($result))
                {
                    $film_ids[$count] = $array[0];
                    $titles[$count] = $array[1];
                    $small_images[$count] = $array[2];
                    $genres[$count] = $array[3];
                    $count += 1;
                }
                if($count == 0) printf("<div class='top-text'>На данный момент сериалов нет</div>");
                else
                {
                    printf("
                        <div class='top-text'>Топ лучших сериалов</div>
                        <div class='top-films-container'>
                    ");
                    for($i = 0; $i < $count && $i < 3; $i += 1)
                    {
                        printf("
                            <a href='film_info.php?film_id=$film_ids[$i]'>
                                <div class='top-film'>
                                    <div class='text-description'>
                                        <div class='text-description-title'>$titles[$i]</div>
                                        <div class='text-description-genre'>Жанр: $genres[$i]</div>
                                    </div>
                                    <img class='top-film-image' src='../$small_images[$i]'>
                                </div>
                            </a>
                        ");
                    }
                    printf("</div>");
                }
            ?>
            <div class="selection-container">

                <?php
                    include "../common/connection.php";
                    $film_ids = [];
                    $titles = [];
                    $header_images = [];
                    $ratings = [];
                    $result = mysqli_query($descr, "SELECT * FROM films WHERE category='serial'");
                    $count = 0;
                    while($array = mysqli_fetch_array($result))
                    {
                        $film_ids[$count] = $array['id'];
                        $titles[$count] = $array['title'];
                        $header_images[$count] = $array['header_image'];
                        $ratings[$count] = $array['rating'];
                        $count += 1;
                    }
                    if($count != 0)
                    {
                        printf("<div class='top-text'>Подборка сериалов</div>");
                        for($i = 0; $i < $count; $i += 1)
                        {
                            if($i % 3 == 0) printf("<div class='cards-container'>");
                            printf("
                                <div class='film-card'>
                                    <div class='film-image'>
                                        <img src='../$header_images[$i]'>
                                    </div>
                                    <div class='film-title'><a href='film_info.php?film_id=$film_ids[$i]'>$titles[$i]</a></div>
                                    <div class='add-to-favourite-rating'>
                                        <div class='rating'>Рейтинг : $ratings[$i] / 10</div>
                                        <div class='add-to-favourite'>");
                            if($user_id != NULL)
                            {
                                $id_favourites = NULL;
                                $result = mysqli_query($descr, "SELECT * FROM favourites WHERE user_id=$user_id AND film_id=$film_ids[$i]");
                                while($array = mysqli_fetch_array($result)) $id_favourites = $array['id'];
                                if($id_favourites != NULL) printf("<a href='../common/remove_from_favourites.php?id=$id_favourites&page=serials'>Удалить из избранных ✖</a>");
                                else printf("<a href='../common/add_to_favourites.php?user_id=$user_id&film_id=$film_ids[$i]&page=serials'>Добавить в избранное</a>");
                            }
                            else printf("<a href='../auth_and_reg/auth.php'>Добавить в избранное</a>");
                            printf("</div></div></div>");
                            if($i % 3 == 2 || $i == $count - 1) printf("</div>");
                        }
                    }
                ?>
            </div>
        </div>

        <?php include "../common/footer.php"; ?>

    </body>
</html>