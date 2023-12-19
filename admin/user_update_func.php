<?php
    if(isset($_POST['new_name']) && isset($_POST['new_login']) && isset($_POST['new_password']) && isset($_POST['new_email']) && isset($_POST['user_id']))
    {
        $user_id = $_POST['user_id'];
        $new_name = $_POST['new_name'];
        $new_login = $_POST['new_login'];
        $new_password = $_POST['new_password'];
        $new_email = $_POST['new_email'];
        $new_admin = 0;
        if(isset($_POST['new_admin'])) $new_admin = 1;

        include "../common/connection.php";
        $result = mysqli_query($descr, "SELECT * FROM users WHERE (login='$new_login' OR email='$new_email') AND id != $user_id");
        $is_found = 0;
        while($array = mysqli_fetch_array($result)) $is_found = 1;

        if($is_found == 0)
        {
            $query = mysqli_query($descr, "UPDATE users SET is_admin=$new_admin, name='$new_name', login='$new_login', password='$new_password',email='$new_email' WHERE id=$user_id");
            header("Location: users_db.php");
            exit();
        }
        else
        {
            header("Location: users_db_update.php");
            exit();
        }
    }
    else
    {
        header("Location: ../auth_and_reg/auth.php");
        exit();
    }
?>