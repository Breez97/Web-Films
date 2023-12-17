<html>
    <head>
        <title>О нас</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_common.css">
        <link rel="stylesheet" href="../css/css_about.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
        ?>
        <div class="header-container">
            <?php
                include "../common/header.php";
                print_header($user_id, 'films');
            ?>
        </div>

        <div class="create-line"></div>

        <div class="main-container">
            <div class="main-text">Техническая поддержка</div>
            <div class="support-text">Мы с удовольствием ответим на интересующие вас вопросы</div>
            <div class="support-text">✉ support@kinomania.ru ✉</div>
            <div class="support-text">С нами также можно связаться по телефону</div>
            <div class="support-text">🕿 +7 (916) 844-65-90 🕿</div>
        </div>

        <?php include "../common/footer.php"; ?>

    </body>
</html>