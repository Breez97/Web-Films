<html>
    <head>
        <title>Киномания</title>
        <link rel="icon" type="image/x-icon" href="icon.ico">
        <link rel="stylesheet" href="css/css_fonts.css">
        <link rel="stylesheet" href="css/css_main.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            if(isset($_SESSION["user_id"]))
            {
                $user_id = $_SESSION["user_id"];
                include "connection.php";
                $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE id=$user_id");
                while($array = mysqli_fetch_array($result))
                {
                    $name = $array['name'];
                }
            }
        ?>

        <script src="change.js"></script>

        <div class="main-container">

            <div class="header-container">
                <div class="website-navigation">
                    <div class="logo">
                        <a href="main.php" class="logo-button">Киномания</a>
                    </div>
                    <div class="text-links">
                        <a href="films.php">Фильмы</a>
                    </div>
                    <div class="text-links">
                        <a href="serials.php">Сериалы</a>
                    </div>
                    <div class="text-links">
                        <a href="showss.php">Шоу</a>
                    </div>
                    <div class="text-links">
                        <a href="about.php">О нас</a>
                    </div>
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
                                        <div class='search-authorization'>
                                            <div>
                                                <a href='personal_acc.php' class='acc'></a>
                                            </div>
                                            <div>
                                                <a href='logout.php' class='logout'></a>
                                            </div>
                                        </div>
                                    ");
                                }
                            ?>
                        </div>
                    </div>
                </div>
                
                <div class="slider">
                    <div class="slides">
                        <input type="radio", name="r" id="r1" checked>
                        <input type="radio", name="r" id="r2">
                        <input type="radio", name="r" id="r3">
                        <input type="radio", name="r" id="r4">

                        <?php
                            $number = 1;
                            include "connection.php";
                            $result = mysqli_query($descr, "SELECT * FROM header_films ORDER BY RAND() LIMIT 4");
                            while($array = mysqli_fetch_array($result))
                            {
                                printf("
                                    <div class='slide s$number'>
                                        <img src='{$array["image_link"]}'>
                                        <div class='info'>
                                            <div class='film-title'>{$array["title"]}</div>
                                        </div>
                                    </div>
                                ");
                                $number += 1;
                            }
                        ?>

                    </div>
                    <div class="darker"></div>
                </div>

                <div class="navigation">
                    <label for="r1" class="bar"></label>
                    <label for="r2" class="bar"></label>
                    <label for="r3" class="bar"></label>
                    <label for="r4" class="bar"></label>
                </div>
            </div>

            <div class="content-container">
                
            </div>

            <div class="footer-container">

            </div>

        </div>
    </body>
</html>