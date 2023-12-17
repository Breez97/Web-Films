<?php
    function print_header($user_id, $pagename)
    {
        if($pagename == 'main')
        {
            $pagename = 'main.php';
        }
        else
        {
            $pagename = '../main/main.php';
        }
        printf("
            <div class='website-navigation'>
                <div class='logo'>
                    <a href='$pagename' class='logo-button'>Киномания</a>
                </div>
                <div class='text-links'>
                    <a href='../pages/films.php'>Фильмы</a>
                </div>
                <div class='text-links'>
                    <a href='../pages/serials.php'>Сериалы</a>
                </div>
                <div class='text-links'>
                    <a href='../pages/about.php'>О нас</a>
                </div>
                <div class='search-authorization'>
                    <div>
                        <a href='../pages/search.php' class='search'></a>
                    </div>
                    <div>");
        if($user_id == NULL)
        {
            printf("
                <a href='../auth_and_reg/auth.php' class='authorization'></a>
            ");
        }
        else
        {
            printf("
                <div class='search-authorization'>
                    <div>
                        <a href='../pages/personal_acc.php' class='acc'></a>
                    </div>
                    <div>
                        <a href='../common/logout.php' class='logout'></a>
                    </div>
                </div>
            ");
        }
        printf("</div></div></div>");
    }
?>