<?php
    if(isset($_POST['new_title']) && isset($_POST['new_category']) && isset($_POST['new_description']) && isset($_POST['new_genre']) && isset($_FILES['new_header_image']) && isset($_FILES['new_small_image']))
    {
        $header_images_dir = '../films_images/header_images/';
        $small_images_dir = '../films_images/small_images/';
        
        $new_title = $_POST['new_title'];
        $new_category = $_POST['new_category'];
        $new_header_image = 'films_images/header_images/' . $_FILES['new_header_image']['name'];
        $new_small_image = 'films_images/small_images/' . $_FILES['new_small_image']['name'];
        $new_rating = 0;
        if(isset($_POST['new_rating']) && $_POST['new_rating'] != '') $new_rating = $_POST['new_rating'];
        $new_description = $_POST['new_description'];
        $new_genre = $_POST['new_genre'];
        
        move_uploaded_file($_FILES['new_header_image']['tmp_name'], $header_images_dir . $_FILES['new_header_image']['name']);
        move_uploaded_file($_FILES['new_small_image']['tmp_name'], $small_images_dir . $_FILES['new_small_image']['name']);

        include "../common/connection.php";
        $query = mysqli_query($descr, "INSERT INTO films(id, title, category, header_image, small_image, rating) VALUES (NULL, '$new_title', '$new_category', '$new_header_image', '$new_small_image', $new_rating)");
        $result = mysqli_query($descr, "SELECT * FROM films ORDER BY id DESC LIMIT 1");
        while($array = mysqli_fetch_array($result)) $last_id = $array['id'];
        $query = mysqli_query($descr, "INSERT INTO films_info(id, film_id, description, genre) VALUES (NULL, $last_id, '$new_description','$new_genre')");
        header("Location: films_db.php");
        exit();
    }
    else
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>