<?php
    session_start();
    $user_id = NULL;
    if(isset($_SESSION["user_id"])) $user_id = $_SESSION["user_id"];
    include "../connection.php";
    $is_admin = 0;
    $result = mysqli_query($descr, "SELECT * FROM users WHERE id=$user_id AND is_admin=1");
    while($array = mysqli_fetch_array($result)) $is_admin = 1;
    if($is_admin == 0)
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>