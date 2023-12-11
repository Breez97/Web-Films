<html>
    <head>
        <title>Обновление фильма</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
            include "../connection.php";
            if(isset($_GET['film_id']))
            {
                $film_id = $_GET['film_id'];
                $result = mysqli_query($descr, "SELECT * FROM films, films_info WHERE films.id=$film_id AND films_info.film_id=$film_id");
                while($array = mysqli_fetch_array($result))
                {
                    $old_title = $array[1];
                    $old_category = $array[2];
                    $old_header_image = $array[3];
                    $old_small_image = $array[4];
                    $old_rating = $array[5];
                    $old_description = $array[8];
                    $old_genres = $array[9];
                }
            }
            else
            {
                header('Location: films_db_update.php');
                exit();
            }
        ?>
        <div class='main-container'>
            <div class='header-text'>Обновление фильма</div>
            <form action='film_update_func.php' method='POST' enctype="multipart/form-data">
                <table width=90%>
                    <tr>
                        <td class='input-name'>Название : </td>
                        <td><input type='text' placeholder='Название' class='input' name='new_title' <?printf("value=$old_title");?> required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Категория : </td>
                        <td>
                            <select class='select' name='new_category' id='category-select'>
                                <option value='film' <?php if($old_category == 'film') printf('selected');?>>Фильм</option>
                                <option value='serial' <?php if($old_category == 'serial') printf('selected');?>>Сериал</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class='input-name'>Старая картинка (1920x1080) : </td>
                        <td><img src='<?php printf("../$old_header_image")?>' width='200px'></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Заглавная картинка (1920x1080) : </td>
                        <td><input type='file' placeholder='Категория' class='input-1' name='new_header_image'></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Старая картинка (1000x1000) : </td>
                        <td><img src='<?php printf("../$old_small_image")?>' width='200px'></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Маленькая картинка (1000x1000) : </td>
                        <td><input type='file' placeholder='Категория' class='input-1' name='new_small_image'></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Рейтинг : </td>
                        <td><input type='number' step='0.1' placeholder='Рейтинг' class='input' name='new_rating' min=0 max=10 <?php printf("value=$old_rating");?>></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Описание : </td>
                        <td><textarea type='input-box-area' placeholder='Описание' class='input' name='new_description' cols="60" rows="6" max="1000" required><?php printf("$old_description");?></textarea>
                    </tr>
                    <tr>
                        <td class='input-name'>Жанры : </td>
                        <td><input type='text' placeholder='Жанры' class='input' name='new_genre' <?php printf("value=$old_genres");?> required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <input type='hidden' name='film_id' value='<?php printf("$film_id");?>'>
                            <div class='button-container-row'>
                                <button type='submit'>Обновить</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <div class='button-container-row-1'>
                <form action='films_db_update.php'>
                    <button type='submit'>Вернуться назад</button>
                </form>
            </div>
        </div>
    </body>
</html>