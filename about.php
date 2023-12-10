<html>
    <head>
        <title>О нас</title>
        <link rel="icon" type="image/x-icon" href="icon.ico">
        <link rel="stylesheet" href="css/css_fonts.css">
        <link rel="stylesheet" href="css/css_about.css">
        <link rel="stylesheet" href="css/css_header.css">
        <link rel="stylesheet" href="css/css_footer.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
        ?>
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
                                            <a href='logout.php?page_name=films' class='logout'></a>
                                        </div>
                                    </div>
                                ");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-container">
            <div class="main-text">Техническая поддержка</div>
            <div class="support-text">Мы с удовольствием ответим на интересующие вас вопросы</div>
            <div class="support-text">✉ support@kinomania.ru ✉</div>
            <div class="support-text">С нами также можно связаться по телефону</div>
            <div class="support-text">🕿 +7 (916) 844-65-90 🕿</div>
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
    </body>
</html>