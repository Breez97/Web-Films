<?php
    if(isset($_GET['film_id']))
    {
        $film_id = $_GET['film_id'];
        include "../common/connection.php";
        $query = mysqli_query($descr, "DELETE FROM films WHERE films.id=$film_id");
        $query = mysqli_query($descr, "DELETE FROM films_info WHERE film_id=$film_id");
        header("Location: films_db.php");
        $query = mysqli_query($descr, "DELETE FROM favourites WHERE film_id=$film_id");
        $query = mysqli_query($descr, "DELETE FROM comments_and_ratings WHERE film_id=$film_id");
        exit();
    }
    else
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>