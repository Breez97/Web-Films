<?php
    include "connection.php";
    if(isset($_GET['user_id']) && isset($_GET['film_id']) && isset($_GET['page']))
    {
        $user_id = $_GET['user_id'];
        $film_id = $_GET['film_id'];
        if($_GET['page'] == 'films') $page_name = "../pages/films.php";
        if($_GET['page'] == 'serials') $page_name = "../pages/serials.php";
        if($_GET['page'] == 'personal_acc') $page_name = "../pages/personal_acc.php";
        if($_GET['page'] == 'search') $page_name = "../pages/search.php";
        if($_GET['page'] == 'film_info') $page_name = "../pages/film_info.php?film_id=$film_id";
        $query = mysqli_query($descr, "INSERT INTO favourites(id, user_id, film_id) VALUES (NULL, $user_id, $film_id)");
    }
    header("Location: $page_name");
    exit();
?>