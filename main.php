<html>
    <head>
        <title>Киномания</title>
        <link rel="stylesheet" href="css/css_common.css">
        <link rel="stylesheet" href="css/css_fonts.css">
        <link rel="stylesheet" href="css/css_main.css">
    </head>
    <body>
        <?php
            if(isset($_POST["user_id"]))
            {
                $user_id = $_POST["user_id"];
                include "connection.php";
                $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE id=$user_id");
                while($array = mysqli_fetch_array($result))
                {
                    $name = $array['name'];
                }
                printf("<h1>$name</h1>");
            }
        ?>
        <div class="container-header">
            <div class="logo">
                <a href="main.php" class="logo-button">Киномания</a>
            </div>
            <div>
                <a href="films.php">Фильмы</a>
            </div>
            <div>
                <a href="serials.php">Сериалы</a>
            </div>
            <div><a href="shows.php">Шоу</a></div>
            <div><a href="about.php">О нас</a></div>
            <div class="search-authorization">
                <div>
                    <a href="search.php" class="search"></a>
                </div>
                <div>
                    <a href="auth.php" class="authorization"></a>
                </div>
            </div>
        </div>
    </body>
</html>