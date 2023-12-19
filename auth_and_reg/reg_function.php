<?php
    $name = NULL;
    $login = NULL;
    $password = NULL;
    $email = NULL;
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['name_new'];
        $login = $_POST['login_new'];
        $password = $_POST['password_new'];
        $email = $_POST['email_new'];
        
        include "../common/connection.php";

        $result = mysqli_query($descr, "SELECT * FROM users WHERE login='$login' OR email='$email'");
        $is_found = 0;
        while($array = mysqli_fetch_array($result)) $is_found = 1;
        if($is_found == 0)
        {
            $query = mysqli_query($descr, "INSERT INTO users(id, is_admin, name, login, password, email) VALUES(NULL, 0, '$name', '$login', '$password', '$email')");
            $is_found_new_user = 0;
            if($query)
            {
                $result = mysqli_query($descr, "SELECT * FROM users WHERE login='$login' AND password='$password'");
                while($result = mysqli_fetch_array($result))
                {
                    $user_id = $result['id'];
                    $is_found_new_user = 1;
                }
                if($is_found_new_user == 1)
                {
                    session_start();
                    $_SESSION['user_id'] = $user_id;
                    header("Location: ../main/main.php");
                    exit();
                }
            }
        }
        
    }
?>