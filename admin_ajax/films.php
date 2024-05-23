<html>
    <head>
        <title>Админ панель</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
        <link rel="stylesheet" href="./css/css_ajax.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
        ?>
        <div class='main-container'>
            <div class='header-text'>Добавление, изменение и удаление фильмов</div>
            <div class='buttons-container'>
                <form action='#'>
                    <button type='submit' class="open-popup">Добавить фильм</button>
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
                                <div class='film-main-text'><a class='update-button' data-id='$ids[$i]'>Изменить</a></div>
                                <div class='film-main-text'><a class='delete-button' data-id='$ids[$i]'>Удалить</a></div>
                            </div>
                        </div>
                    ");
                }
            ?>
        </div>

        <div class="popup-bg">
            <div class="popup-add">
                <img class="close-popup" src="./img/cross.svg" alt="icon">
                <div class="form-container">
                    <div class='header-text'>Добавление фильма</div>
                    <form method="POST" name="add-form" enctype="multipart/form-data">
                        <div class="film-main-text size">Название фильма</div>
                        <input type="text" name="new-title" class="input-field" placeholder="Название" required>
                        <div class="film-main-text size">Категория</div>
                        <select name='new-category' id='category-select'>
                            <option value='film'>Фильм</option>
                            <option value='serial'>Сериал</option>
                        </select>
                        <div class="film-main-text size">Заглавная картинка (1920x1080)</div>
                        <input type="file" name="header-image" accept="image/*" required>
                        <div class="film-main-text size">Маленькая картинка (1000x1000)</div>
                        <input type="file" name="small-image" accept="image/*" required>
                        <div class="film-main-text size">Описание</div>
                        <textarea name="new-description"></textarea>
                        <div class="film-main-text size">Рейтинг (от 0 до 10)</div>
                        <input type="number" class="input-field" name="new-rating" placeholder="Рейтинг" min="0" max="10" required>
                        <div class="film-main-text size">Жанр</div>
                        <input type="text" class="input-field" name="new-genre" placeholder="Жанр" required>
                        <button type='submit'>Добавить</button>
                    </form>
                </div>
            </div>
            <div class="popup-info-container">
            </div>
        </div>

        <script src="./scripts/jquery.js"></script>
        <script src="./scripts/films_common.js"></script>
        <script src="./scripts/films_add.js"></script>
    </body>
</html>