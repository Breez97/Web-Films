<html>
    <head>
        <title>Добавление фильма</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin_func.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
        ?>
        <div class='main-container'>
            <div class='header-text'>Добавление нового фильма</div>
            <form action='film_add_func.php' method='POST' enctype="multipart/form-data">
                <table width=90%>
                    <tr>
                        <td class='input-name'>Название : </td>
                        <td><input type='text' placeholder='Название' class='input' name='new_title' required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Категория : </td>
                        <td>
                            <select class='select' name='new_category' id='category-select'>
                                <option value='film'>Фильм</option>
                                <option value='serial'>Сериал</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td class='input-name'>Заглавная картинка (1920x1080) : </td>
                        <td><input type='file' placeholder='Категория' class='input-1' name='new_header_image' required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Маленькая картинка (1000x1000) : </td>
                        <td><input type='file' placeholder='Категория' class='input-1' name='new_small_image' required></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Рейтинг : </td>
                        <td><input type='number' step='0.1' placeholder='Рейтинг' class='input' name='new_rating' min=0 max=10></td>
                    </tr>
                    <tr>
                        <td class='input-name'>Описание : </td>
                        <td><textarea type='input-box-area' placeholder='Описание' class='input' name='new_description' cols="60" rows="6" max="1000" required></textarea>
                    </tr>
                    <tr>
                        <td class='input-name'>Жанры : </td>
                        <td><input type='text' placeholder='Жанры' class='input' name='new_genre' required></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <div class='button-container'>
                                <button type='submit'>Добавить</button>
                            </div>
                        </td>
                    </tr>
                </table>
            </form>
            <div class='button-container-row-1'>
                <form action='films_db.php'>
                    <button type='submit'>Вернуться назад</button>
                </form>
            </div>
        </div>
    </body>
</html>