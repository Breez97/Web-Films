<html>
    <head>
        <title>Админ панель</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
    </head>
    <body>
        <?php
            include("../admin/admin_session.php");
        ?>
        <div class="main-container">
            <div class='header-text'>Добро пожаловать на страницу администратора</div>
            <div class='main-text'>Здесь вы можете просмотреть всю необходимую информацию</div>
            <form action='films.php' class='button-container'>
                <button type='submit'>Фильмы</button>
            </form>
            <form action='users.php' class='button-container'>
                <button type='submit'>Пользователи</button>
            </form>
            <form action='comments.php' class='button-container'>
                <button type='submit'>Комментарии</button>
            </form>
            <form action='../auth_and_reg/auth.php' class='button-container'>
                <button type='submit'>Выйти</button>
            </form>
        </div>
    </body>
</html>