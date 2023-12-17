<html>
    <head>
        <title>Киномания</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_main.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
            include "../common/connection.php";
            $result = mysqli_query($descr, "SELECT * FROM users WHERE is_admin=1");
            while($array = mysqli_fetch_array($result))
            {
                if($array['id'] == $user_id) include "../common/logout.php";
            }
        ?>

        <script src="change.js"></script>

        <div class="main-container">

            <div class="header-container">
                <?php
                    include "../common/header.php";
                    print_header($user_id, 'main');
                ?>
                
                <div class="slider">
                    <div class="slides">
                        <input type="radio", name="r" id="r1" checked>
                        <input type="radio", name="r" id="r2">
                        <input type="radio", name="r" id="r3">
                        <input type="radio", name="r" id="r4">

                        <?php
                            $number = 1;
                            include "../common/connection.php";
                            $result = mysqli_query($descr, "SELECT * FROM films WHERE category='film' ORDER BY RAND() LIMIT 4");
                            while($array = mysqli_fetch_array($result))
                            {
                                printf("
                                    <div class='slide s$number'>
                                        <img src='../{$array["header_image"]}'>
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

            <?php 
                include "content_main.php";
                include "../common/footer.php";
            ?>

        </div>
    </body>
</html>