<?php
    include "connection.php";
    if(isset($_GET['id']))
    {
        $id_favourites = $_GET['id'];
        $query = mysqli_query($descr, "DELETE FROM favourites WHERE id=$id_favourites");
        header("Location: films.php");
        exit();
    }
?>