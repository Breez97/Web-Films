<html>
    <head>
        <title>Админ панель</title>
        <link rel="icon" type="image/x-icon" href="../icon.ico">
        <link rel="stylesheet" href="../css/css_fonts.css">
        <link rel="stylesheet" href="../css/css_admin.css">
		<link rel="stylesheet" href="./css/css_ajax.css">
    </head>
    <body>
        <?php
            include "admin_session.php";
        ?>
        <div class='main-container'>
            <div class='header-text'>Удаление комментариев</div>
            <div class='buttons-container'>
                <form action='admin.php'>
                    <button type='submit'>Вернуться на главную</button>
                </form>
            </div>
            <?php
                include "../common/connection.php";
                $result = mysqli_query($descr, "SELECT comments_and_ratings.id, users.name, films.title, comments_and_ratings.comment FROM comments_and_ratings 
                INNER JOIN users ON comments_and_ratings.user_id = users.id
                INNER JOIN films ON comments_and_ratings.film_id = films.id");
                $ids = [];
                $names = [];
                $titles = [];
                $comments = [];
                $count = 0;
                while($array = mysqli_fetch_array($result))
                {
                    $ids[$count] = $array[0];
                    $names[$count] = $array[1];
                    $titles[$count] = $array[2];
                    $comments[$count] = $array[3];
                    $count += 1;
                }

                for($i = 0; $i < $count; $i += 1)
                {
                    printf("
                        <div class='film-container'>
							<div class='components-container'>
								<div class='comment-container'>
									<div class='film-main-text'>Имя пользователя</div>
									<div name='user-name' class='film-main-text'>$names[$i]</div>
								</div>
								<div class='comment-container'>
									<div class='film-main-text'>Название фильма</div>
									<div name='film-title' class='film-main-text'>$titles[$i]</div>
								</div>
                            </div>
                            <div class='components-container'>
								<div class='comment-container'>
									<div class='film-main-text'>Комментарий</div>
                                    <div class='film-main-text'>$comments[$i]</div>
								</div>
                            </div>
                            <div class='buttons-container'>
								<div class='film-main-text'><a class='delete-button' data-id='$ids[$i]'>Удалить</a></div>
                            </div>
                        </div>
                    ");
                }
            ?>
        </div>

		<div class='popup-bg'>
			<div class='popup-add'>
				<img class="close-popup" src="./img/cross.svg" alt="icon">
				<div class='form-container'>
					<div class='header-text'>Удаление комментария</div>
					<form method="POST" name="delete-form">
                        <div class="film-main-text yes-no-size" name="film-title"></div>
                        <div class="film-main-text size">Вы точно хотите удалить?</div>
                        <button name="yes-button" class="yes-no-button">Да</button>
                        <button name="no-button" class="yes-no-button">Нет</button>
                    </form>
				</div>
			</div>
			<div class="popup-info-container">
            </div>
		</div>

		<script src="./scripts/jquery.js"></script>
		<script src="./scripts/comments.js"></script>
    </body>
</html>