<?php
    if(isset($_POST['new_name']) && isset($_POST['new_login']) && isset($_POST['new_password']) && isset($_POST['new_email']))
    {
        $new_name = $_POST['new_name'];
        $new_login = $_POST['new_login'];
        $new_password = $_POST['new_password'];
        $new_email = $_POST['new_email'];
        $new_admin = 0;
        if(isset($_POST['new_admin'])) $new_admin = 1;

        include "../common/connection.php";
        $result = mysqli_query($descr, "SELECT * FROM users WHERE login='$new_login' OR email='$new_email'");
        $is_found = 0;
        while($array = mysqli_fetch_array($result)) $is_found = 1;

        if($is_found == 0)
        {
            $query = mysqli_query($descr, "INSERT INTO users(id, is_admin, name, login, password, email) VALUES (NULL, $new_admin, '$new_name', '$new_login', '$new_password', '$new_email')");
            header("Location: user_db.php");
            exit();
        }
        else
        {
            header("Location: user_add.php");
            exit();
        }
    }
    else
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>