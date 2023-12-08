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
        
        include "../connection.php";

        $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE login='$login' OR email='$email'");
        $is_found = 0;
        while($array = mysqli_fetch_array($result)) $is_found = 1;
        if($is_found == 0)
        {
            $query = mysqli_query($descr, "INSERT INTO users_auth(id, name, login, password, email) VALUES(NULL, '$name', '$login', '$password', '$email')");
            $is_found_new_user = 0;
            if($query)
            {
                $result = mysqli_query($descr, "SELECT * FROM users_auth WHERE login='$login' AND password='$password'");
                while($result = mysqli_fetch_array($result))
                {
                    $user_id = $result['id'];
                    $is_found_new_user = 1;
                }
                if($is_found_new_user == 1)
                {
                    printf("
                    <form id='go_to_main' action='../main.php' method='POST'>
                        <input type='hidden' name='user_id' value=$user_id>
                    </form>
                    <script>document.getElementById('go_to_main').submit();</script>
                    ");
                }
            }
        }
        
    }
?>