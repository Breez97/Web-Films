<?php
    if(isset($_POST['film_id']) && isset($_POST['user_id']))
    {
        $film_id = $_POST['film_id'];
        $user_id = $_POST['user_id'];
        $page_name = "../pages/film_info.php?film_id=$film_id";

        include "connection.php";
        $query = mysqli_query($descr, "DELETE FROM comments_and_ratings WHERE film_id=$film_id AND user_id=$user_id");
        $result = mysqli_query($descr, "SELECT * FROM comments_and_ratings WHERE film_id=$film_id");
        $sum = 0;
        $count = 0;
        while($array = mysqli_fetch_array($result))
        {
            $sum += floatval($array['rating']);
            $count += 1;
        }

        $sum = number_format($sum / $count, 1);

        $query = mysqli_query($descr, "UPDATE films SET rating=$sum WHERE id=$film_id");

        header("Location: $page_name");
        exit();
    }
?>