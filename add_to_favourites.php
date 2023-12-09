<?php
    include "connection.php";
    if(isset($_GET['user_id']) && isset($_GET['film_id']) && isset($_GET['page']))
    {
        if($_GET['page'] == 'films') $page_name = "films.php";
        if($_GET['page'] == 'serials') $page_name = "serials.php";
        $user_id = $_GET['user_id'];
        $film_id = $_GET['film_id'];
        $query = mysqli_query($descr, "INSERT INTO favourites(id, user_id, film_id) VALUES (NULL, $user_id, $film_id)");
    }
    header("Location: $page_name");
    exit();
?>