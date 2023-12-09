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
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
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
                                                <a href='logout.php?page_name=main' class='logout'></a>
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
                            $result = mysqli_query($descr, "SELECT * FROM films WHERE category='film' ORDER BY RAND() LIMIT 4");
                            while($array = mysqli_fetch_array($result))
                            {
                                printf("
                                    <div class='slide s$number'>
                                        <img src='{$array["header_image"]}'>
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
                <div class="card">
                    <div class="card-image left-image">
                        <img src="images/main_window/card_1.png">
                    </div>
                    <div class="card-description">
                        <div class="header-text">Откройте Вселенную Киномагии!</div>
                        <div class="main-text">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Киномания - это ваш билет в мир невероятных историй. Здесь вы можете наслаждаться последними фильмами, запускать сериалы, исследовать увлекательные шоу. У нас есть трейлеры, оценки, и комментарии от наших пользователей, чтобы вы могли сделать осознанный выбор. А еще, поделитесь своим мнением и участвуйте в обсуждении - ваш голос важен!
                        </div>
                    </div>
                    <div class="card-image right-image">
                        <img src="images/main_window/card_1_1.png">
                    </div>
                </div>
                <div class="card right">
                    <div class="card-image left-image">
                        <img src="images/main_window/card_2_1.png">
                    </div>
                    <div class="card-description">
                        <div class="header-text">Ваше Место в Мире Киноискусства!</div>
                        <div class="main-text">&nbsp;&nbsp;&nbsp;На Киномании мы предоставляем вам возможность стать частью нашего киноклуба. Здесь вы найдете множество трейлеров, эксклюзивные оценки и отзывы. Проведите вечер в компании лучших фильмов, узнайте, что смотрят ваши друзья, и делитесь своими впечатлениями. Ваш взгляд - это часть нашего киносообщества!</div>
                    </div>
                    <div class="card-image right-image">
                        <img src="images/main_window/card_2.png">
                    </div>
                </div>
                <div class="card">
                    <div class="card-image left-image">
                        <img src="images/main_window/card_3.png">
                    </div>
                    <div class="card-description">
                        <div class="header-text">Оценивайте, Комментируйте, Обсуждайте!</div>
                        <div class="main-text">&nbsp;&nbsp;&nbsp;Киномания - это не просто сайт, это интерактивная платформа для настоящих киноманов. Оценивайте фильмы, давайте свой взгляд на сериалы, и оставляйте комментарии, чтобы поделиться своими впечатлениями. Наши обсуждения станут местом, где вы можете обменяться идеями и открыть для себя новые шедевры. Добро пожаловать в мир киномагии, где ваше мнение ценится!</div>
                    </div>
                    <div class="card-image right-image">
                        <img src="images/main_window/card_3_1.png">
                    </div>
                </div>
            </div>
            
            <div class="create-line"></div>
            <div class="footer-container">
                <div class="text-contact">Мы в социальных сетях<br>Открыты для связи в любое время</div>
                <div class="socials">
                    <div class="social social-inst">
                        <a href="#"><img src="images/main_window/inst_icon.png"></a>
                    </div>
                    <div class="social social-vk">
                        <a href="#"><img src="images/main_window/vk_icon.png"></a>
                    </div>
                    <div class="social social-whatsapp">
                        <a href="#"><img src="images/main_window/whatsapp_icon.png"></a>
                    </div>
                    <div class="social social-twitter">
                        <a href="#"><img src="images/main_window/twitter_icon.png"></a>
                    </div>
                </div>
            </div>

        </div>
    </body>
</html>