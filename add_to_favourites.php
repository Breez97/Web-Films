<?php
    include "connection.php";
    if(isset($_GET['user_id']) && isset($_GET['film_id']))
    {
        $user_id = $_GET['user_id'];
        $film_id = $_GET['film_id'];
        $query = mysqli_query($descr, "INSERT INTO favourites(id, user_id, film_id) VALUES (NULL, $user_id, $film_id)");
        header("Location: films.php");
        exit();
    }
?>