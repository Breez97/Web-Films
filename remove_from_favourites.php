<?php
    include "connection.php";
    if(isset($_GET['id']) && isset($_GET['page']))
    {
        if($_GET['page'] == 'films') $page_name = "films.php";
        if($_GET['page'] == 'serials') $page_name = "serials.php";
        $id_favourites = $_GET['id'];
        $query = mysqli_query($descr, "DELETE FROM favourites WHERE id=$id_favourites");
    }
    header("Location: $page_name");
    exit();
?>