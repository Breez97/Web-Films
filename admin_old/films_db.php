<html>
    <head>
        <title>Фильмы_бд</title>
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
            <table width=90%>
                <tr>
                    <td class='id-text'>id</td>
                    <td class='title-text'>title</td>
                    <td class='category-text'>category</td>
                    <td class='image-text'>header_image</td>
                    <td class='image-text'>small_image</td>
                    <td class='rating-text'>rating</td>
                    <td class='description-text-header'>description</td>
                    <td class='genre-text'>genre</td>
                </tr>
                <?php
                    include "../connection.php";
                    $ids = [];
                    $titles = [];
                    $categories = [];
                    $header_images = [];
                    $small_images = [];
                    $ratings = [];
                    $descriptions = [];
                    $genres = [];
                    $count = 0;
                    $result = mysqli_query($descr, "SELECT * FROM films, films_info WHERE films.id = films_info.film_id");
                    while($array = mysqli_fetch_array($result))
                    {
                        $ids[$count] = $array[0];
                        $titles[$count] = $array[1];
                        $categories[$count] = $array[2];
                        $header_images[$count] = $array[3];
                        $small_images[$count] = $array[4];
                        $ratings[$count] = $array[5];
                        $words = preg_split('/\s+/', $array[8]);
                        $descriptions[$count] = implode(' ', array_slice($words, 0, 30));
                        $genres[$count] = $array[9];
                        $count += 1;
                    }

                    for($i = 0; $i < $count; $i += 1)
                    {
                        printf("
                            <tr>
                                <td class='id-text'>$ids[$i]</td>
                                <td class='title-text'>$titles[$i]</td>
                                <td class='category-text'>$categories[$i]</td>
                                <td class='image-text'><img src='../$header_images[$i]' width='200px'></td>
                                <td class='image-text'><img src='../$small_images[$i]' width='150px'></td>
                                <td class='rating-text'>$ratings[$i]</td>
                                <td class='description-text'>$descriptions[$i]</td>
                                <td class='genre-text'>$genres[$i]</td>
                            </tr>
                        ");
                    }
                ?>
                
            </table>
            <div class='button-container-row'>
                <form action='films_db_add.php'>
                    <button type='submit'>Добавить</button>
                </form>
                <form action='films_db_update.php'>
                    <button type='submit'>Изменить</button>
                </form>
                <form action='films_db_delete.php'>
                    <button type='submit'>Удалить</button>
                </form>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>
        </div>
    </body>
</html>