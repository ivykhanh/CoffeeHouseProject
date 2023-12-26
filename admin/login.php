<?php include('../config/constants.php'); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Drink Order System</title>
    <link rel="stylesheet" type="text/css" href="admin.css">
    <link rel="icon" href="../img/logo.png">
</head>

<body class="login-bg">
    <div class="admin-login">
        <h3>Login</h3>


        <?php
        if (isset($_SESSION['login'])) {
            echo $_SESSION['login'];
            unset($_SESSION['login']);
        }

        if (isset($_SESSION['no-login-message'])) {
            echo $_SESSION['no-login-message'];
            unset($_SESSION['no-login-message']);
        }

        ?>
        <br><br>
        <form action="" method="POST">

            <label for="username">Username: </label> <br>
            <input type="text" name="username" placeholder="Enter Username"> <br><br>
            <label for="password">Password: </label> <br>
            <input type="password" name="password" placeholder="Enter Password"><br><br>
            <input type="submit" name="submit" value="Login" class="btn-primary">
            <br>
        </form>

    </div>

</body>

</html>

<?php

if (isset($_POST['submit'])) {
    echo $username = $_POST['username'];
    echo $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";

    $res = mysqli_query($conn, $sql);

    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $_SESSION['login'] = "<div class='success'>Login Successfully.</div>";
        $_SESSION['user'] = $username;
        header('location:' . SITEURL . 'admin/');
    } else {
        $_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div>";

        header('location:' . SITEURL . 'admin/login.php');
    }
}




?>