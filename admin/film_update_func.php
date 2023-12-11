<?php
    if(isset($_POST['film_id']) && isset($_POST['new_title']) && isset($_POST['new_category']) && isset($_POST['new_description']) && isset($_POST['new_genre']))
    {
        $film_id = $_POST['film_id'];
        $new_title = $_POST['new_title'];
        $new_category = $_POST['new_category'];
        $new_rating = 0;
        if(isset($_POST['new_rating']) && $_POST['new_rating'] != '') $new_rating = $_POST['new_rating'];
        $new_description = $_POST['new_description'];
        $new_genre = $_POST['new_genre'];

        include "../connection.php";
        $query = mysqli_query($descr, "UPDATE films SET title='$new_title', category='$new_category', rating=$new_rating WHERE id=$film_id");
        $query = mysqli_query($descr, "UPDATE films_info SET description='$new_description', genre='$new_genre' WHERE film_id=$film_id");
        
        if(isset($_FILES['new_header_image']) && $_FILES['new_header_image']['error'] === 0)
        {
            $header_images_dir = '../films_images/header_images/';
            $new_header_image = 'films_images/header_images/' . $_FILES['new_header_image']['name'];
            move_uploaded_file($_FILES['new_header_image']['tmp_name'], $header_images_dir . $_FILES['new_header_image']['name']);
            $query = mysqli_query($descr, "UPDATE films SET header_image='$new_header_image' WHERE id=$film_id");
        }
        if(isset($_FILES['new_small_image']) && $_FILES['new_small_image']['error'] === 0)
        {
            $small_images_dir = '../films_images/small_images/';
            $new_small_image = 'films_images/small_images/' . $_FILES['new_small_image']['name'];
            move_uploaded_file($_FILES['new_small_image']['tmp_name'], $small_images_dir . $_FILES['new_small_image']['name']);
            $query = mysqli_query($descr, "UPDATE films SET small_image='$new_small_image' WHERE id=$film_id");
        }
        header("Location: films_db.php");
        exit();
    }
    else
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>