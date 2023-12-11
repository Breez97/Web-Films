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
            <div class='header-text'>Удаление комментариев</div>
            <table width=90%>
                <tr>
                    <td class='id-text'>id</td>
                    <td class='title-text'>name</td>
                    <td class='title-text'>title</td>
                    <td class='description-text-header'>comment</td>
                    <td class='rating-text'>rating</td>
                </tr>
                <?php
                    include "../connection.php";
                    $result = mysqli_query($descr, "SELECT comments_and_ratings.id, users.name, films.title, comments_and_ratings.comment, comments_and_ratings.rating FROM comments_and_ratings 
                    INNER JOIN users ON comments_and_ratings.user_id = users.id
                    INNER JOIN films ON comments_and_ratings.film_id = films.id");
                    $ids = [];
                    $names = [];
                    $titles = [];
                    $comments = [];
                    $ratings = [];
                    $count = 0;
                    while($array = mysqli_fetch_array($result))
                    {
                        $ids[$count] = $array[0];
                        $names[$count] = $array[1];
                        $titles[$count] = $array[2];
                        $comments[$count] = $array[3];
                        $ratings[$count] = $array[4];
                        $count += 1;
                    }

                    for($i = 0; $i < $count; $i += 1)
                    {
                        printf("
                            <tr>
                                <td class='id-text'><a href='comments_delete_func.php?comment_id=$ids[$i]'>$ids[$i]</a></td>
                                <td class='title-text'>$names[$i]</td>
                                <td class='title-text'>$titles[$i]</td>
                                <td class='description-text-header'>$comments[$i]</td>
                                <td class='rating-text'>$ratings[$i]</td>
                            </tr>
                        ");
                    }
                ?>
            </table>
            <div class='button-container-row'>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>
        </div>
    </body>
</html>