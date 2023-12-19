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
            <div class='header-text'>Добавление, изменение и удаление фильмов</div>
            <div class='buttons-container'>
                <form action='film_add.php'>
                    <button type='submit'>Добавить фильм</button>
                </form>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>
            <?
                include "../common/connection.php";
                $ids = [];
                $titles = [];
                $categories = [];
                $header_images = [];
                $small_images = [];
                $descriptions = [];
                $ratings = [];
                $genres = [];
                $count = 0;
                $result = mysqli_query($descr, "SELECT * FROM films, films_info WHERE films.id = films_info.film_id");
                while($array = mysqli_fetch_array($result))
                {
                    $ids[$count] = $array[0];
                    $titles[$count] = $array[1];
                    if($array[2] == 'film') $category_name = 'Фильм';
                    if($array[2] == 'serial') $category_name = 'Сериал';
                    $categories[$count] = $category_name;
                    $header_images[$count] = $array[3];
                    $small_images[$count] = $array[4];
                    $words = preg_split('/\s+/', $array[8]);
                    $descriptions[$count] = implode(' ', array_slice($words, 0, 30));
                    $ratings[$count] = $array[5];
                    $genres[$count] = $array[9];
                    $count += 1;
                }

                for($i = 0; $i < $count; $i += 1)
                {
                    printf("
                        <div class='film-container'>
                            <div class='film-title-text'>$titles[$i]</div>
                            <div class='film-main-text'>$categories[$i]</div>
                            <div class='components-container'>
                                <div class='main-image'>
                                    <div class='film-main-text'>Заглавная картинка</div>
                                    <img src='../$header_images[$i]' width='200px'>
                                </div>
                                <div class='small-image'>
                                    <div class='film-main-text'>Маленькая картинка</div>
                                    <img src='../$small_images[$i]' width='150px'>
                                </div>
                                <div class='description-container'>
                                    <div class='film-main-text'>Описание</div>
                                    <div class='description-text'>$descriptions[$i]</div>
                                </div>
                                <div class='rating-container'>
                                    <div class='film-main-text'>Рейтинг</div>
                                    <div class='description-text'>$ratings[$i] / 10</div>
                                </div>
                                <div class='genre-container'>
                                    <div class='film-main-text'>Жанр</div>
                                    <div class='description-text'>$genres[$i]</div>
                                </div>
                            </div>
                            <div class='buttons-container'>
                                <div class='film-main-text'><a href='film_update.php?film_id=$ids[$i]'>Изменить</a></div>
                                <div class='film-main-text'><a href='film_delete_func.php?film_id=$ids[$i]'>Удалить</a></div>
                            </div>
                        </div>
                    ");
                }
            ?>
        </div>
    </body>
</html>