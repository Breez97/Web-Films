<?php
    include "connection.php";
    if(isset($_GET['id']) && isset($_GET['page']))
    {
        $id_favourites = $_GET['id'];
        $page_name = $_GET['page'];
        if($_GET['page'] == 'films') $page_name = "../pages/films.php";
        else if($_GET['page'] == 'serials') $page_name = "../pages/serials.php";
        else if($_GET['page'] == 'personal_acc') $page_name = "../pages/personal_acc.php";
        else if($_GET['page'] == 'search') $page_name = "../pages/search.php";
        else $page_name = "../pages/$page_name";
        $query = mysqli_query($descr, "DELETE FROM favourites WHERE id=$id_favourites");
    }
    header("Location: $page_name");
    exit();
?>