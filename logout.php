<?php
    $page_name = 'main.php';
    if(isset($_GET['page_name'])) $page_name = $_GET['page_name'] . '.php';
    session_start();
    session_unset();
    session_destroy();
    header("Location: $page_name");
    exit();
?>