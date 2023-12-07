<html>
    <head>
        <title>Киномания</title>
        <link rel="icon" type="image/x-icon" href="icon.ico">
        <link rel="stylesheet" href="css/css_common.css">
        <link rel="stylesheet" href="css/css_fonts.css">
        <link rel="stylesheet" href="css/css_main.css">
        <link rel="stylesheet" href="css/css_sliders.css">
    </head>
    <body>
        <?php
            $user_id = NULL;
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

        <div class="slider middle">
            <div class="slides">
                <input type="radio" name="r" id="r1" checked>
                <input type="radio" name="r" id="r2">

                <div class="slide s1">
                    <div class="film-title">Главный герой</div>
                    <img src="carousel/good_guy.png">
                </div>
                <div class="slide s2">
                    <div class="film-title">Бегущий по лезвию</div>
                    <img src="carousel/bladerunner.png">              
                </div>
            </div>
            <div class="darker"></div>
        </div>

        <div class="navigation">
            <label for="r1" class="bar"></label>
            <label for="r2" class="bar"></label>            
        </div>

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
                    <?php
                        if($user_id == NULL)
                        {
                            printf("
                                <a href='auth_and_reg/auth.php' class='authorization'></a>
                            ");
                        }
                        else
                        {
                            printf("
                                <a href='account.php' class='personal-account'></a>
                            ");
                        }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>