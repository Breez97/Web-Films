<html>
    <head>
        <title>Поиск</title>
        <link rel="icon" type="image/x-icon" href="icon.ico">
        <link rel="stylesheet" href="css/css_fonts.css">
        <link rel="stylesheet" href="css/css_header.css">
        <link rel="stylesheet" href="css/css_footer.css">
        <link rel="stylesheet" href="css/css_search.css">
        <link rel="stylesheet" href="css/css_films.css">
    </head>
    <body>
        <?php
            session_start();
            $user_id = NULL;
            $search_input = NULL;
            $is_film = 0;
            $is_serial = 0;
            $is_up = 0;
            $is_down = 0;
            if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
            if(isset($_POST['search_input']))
            {
                if($_POST['search_input'] != '') $search_input = $_POST['search_input'];
            }
            if(isset($_GET['search_input']))
            {
                if($_GET['search_input'] != '') $search_input = $_GET['search_input'];
            }
            if(isset($_GET['film'])) $is_film = 1;
            if(isset($_GET['serial'])) $is_serial = 1;
            if(isset($_GET['down'])) $is_down = 1;
            if(isset($_GET['up'])) $is_up = 1;
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
                                            <a href='logout.php?page_name=main' class='logout'></a>
                                        </div>
                                    </div>
                                ");
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="create-line"></div>

        <div class='input-field'>
            <form id="searchForm" action='search.php' method='POST'>
                <input type='text' class='input' name='search_input' id='searchInput' <?php printf("value='$search_input'");?>>
                <button class='input-button' type='submit'>Искать</button>
                <button class='input-button' type='button' onclick="resetForm()">Сбросить</button>
            </form>
        </div>

        <script>
            function resetForm() {
                document.getElementById('searchInput').value = '';
                document.getElementById('searchForm').submit();
            }
        </script>

        <form action='search.php' method='GET' class='filters-container'>
            <div class='filter-text'>Категория :
                <input type='checkbox' id='film' name='film' <?php if($is_film == 1) printf("checked");?>>
                <label for="category" class='cl-checkbox'>Фильм</label>
                <input type='checkbox' id='serial' name='serial' <?php if($is_serial == 1) printf("checked");?>>
                <label for="category" class='cl-checkbox'>Сериал</label>
            </div>
            <div class='filter-text'>Рейтинг : 
                <input type='checkbox' id='up' name='up' <?php if($is_up == 1) printf("checked");?>>
                <label for="up" class='cl-checkbox'>↑</label>
                <input type='checkbox' id='down' name='down' <?php if($is_down == 1) printf("checked");?>>
                <label for="down" class='cl-checkbox'>↓</label>
            </div>
            <input type='hidden' name='search_input' value='<?php printf("$search_input");?>'>
            <button type='submit'>Применить фильтры</button>
        </form>

        </div>

        <div class='selection-container'>
            <?php
                $film_ids = [];
                $titles = [];
                $header_images = [];
                $ratings = [];
                include "connection.php";
                $filter_category = '';
                $filter_order = '';
                if(!($is_film == 1 && $is_serial == 1))
                {
                    if($is_film == 1)
                    {
                        if($search_input == NULL) $filter = "WHERE category='film'";
                        else $filter = " AND category='film'";
                    }
                    if($is_serial == 1)
                    {
                        if($search_input == NULL) $filter = "WHERE category='serial'";
                        else $filter = " AND category='serial'";
                    }
                }
                if(!($is_up == 1 && $is_down == 1))
                {
                    if($is_up == 1) $filter_order = 'ORDER BY rating ASC';
                    if($is_down == 1) $filter_order = 'ORDER BY rating DESC';
                }
                if($search_input != NULL) $result = mysqli_query($descr, "SELECT * FROM films WHERE title LIKE '%$search_input%' $filter $filter_order");
                else $result = mysqli_query($descr, "SELECT * FROM films $filter $filter_order");
                $count = 0;
                while($array = mysqli_fetch_array($result))
                {
                    $film_ids[$count] = $array['id'];
                    $titles[$count] = $array['title'];
                    $header_images[$count] = $array['header_image'];
                    $ratings[$count] = $array['rating'];
                    $count += 1;
                }
                if($count != 0)
                {
                    for($i = 0; $i < $count; $i += 1)
                    {
                        if($i % 3 == 0) printf("<div class='cards-container'>");
                        printf("
                            <div class='film-card'>
                                <div class='film-image'>
                                    <img src='$header_images[$i]'>
                                </div>
                                <div class='film-title'><a href='film_info.php?film_id=$film_ids[$i]'>$titles[$i]</a></div>
                                <div class='add-to-favourite-rating'>
                                    <div class='rating'>Рейтинг : $ratings[$i] / 10</div>
                                    <div class='add-to-favourite'>
                        ");
                        if($user_id != NULL)
                        {
                            $id_favourites = NULL;
                            $result = mysqli_query($descr, "SELECT * FROM favourites WHERE user_id=$user_id AND film_id=$film_ids[$i]");
                            while($array = mysqli_fetch_array($result)) $id_favourites = $array['id'];
                            if($id_favourites != NULL) printf("<a href='remove_from_favourites.php?id=$id_favourites&page=search'>Удалить из избранных ✖</a>");
                            else printf("<a href='add_to_favourites.php?user_id=$user_id&film_id=$film_ids[$i]&page=search'>Добавить в избранное</a>");
                        }
                        else printf("<a href='auth_and_reg/auth.php'>Добавить в избранное</a>");
                        printf("</div></div></div>");
                        if($i % 3 == 2 || $i == $count - 1) printf("</div>");
                    }
                }
            ?>
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