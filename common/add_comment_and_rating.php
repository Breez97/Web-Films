<?php
    if(isset($_POST['new_rating']) && isset($_POST['new_comment']) && isset($_POST['film_id']) && isset($_POST['user_id']))
    {
        $new_rating = $_POST['new_rating'];
        $new_comment = $_POST['new_comment'];
        $film_id = $_POST['film_id'];
        $user_id = $_POST['user_id'];
        $page_name = "../pages/film_info.php?film_id=$film_id";

        include "connection.php";
        $query = mysqli_query($descr, "INSERT INTO comments_and_ratings(id, user_id, film_id, comment, rating) VALUES (NULL, $user_id, $film_id,'$new_comment', '$new_rating')");

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