<?php
    if(isset($_GET['comment_id']))
    {
        $comment_id = $_GET['comment_id'];
        include "../connection.php";
        $film_ids = [];
        $count = 0;
        $result = mysqli_query($descr, "SELECT * FROM comments_and_ratings WHERE id=$comment_id");
        while($array = mysqli_fetch_array($result))
        {
            $film_ids[$count] = $array['film_id'];
            $count += 1;
        }
        $query = mysqli_query($descr, "DELETE FROM comments_and_ratings WHERE id=$comment_id");
        for($i = 0; $i < $count; $i += 1)
        {
            $result = mysqli_query("SELECT * FROM comments_and_ratings WHERE WHERE film_id=$film_ids[$i]");
            $sum = 0;
            while($array = mysqli_fetch_array($result))
            {
                $sum += floatval($array['rating']);
                $count += 1;
            }
            $sum = number_format($sum / $count, 1);
            $query = mysqli_query($descr, "UPDATE films SET rating=$sum WHERE id=$film_ids[$i]");
        }
        header("Location: comments_db.php");
        exit();
    }
    else
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>