
<?php
    $connect = mysqli_connect('localhost', 'root', 'root', 'register-bd');

    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);


    $check_user = mysqli_query($connect, "SELECT `login`, `pass` FROM `users` WHERE `login` = '$login'");


    if ($check_user -> num_rows == 1) {
        echo "1 person found";
        $row = $check_user -> fetch_assoc();
        if (password_verify($_POST['pass'], $row['pass'])) {
            setcookie('user', $row['login'], time() + 3600, "/");
            header('Location: /');
        }
    } else {
            header('Location: /no_user.html');
    }
