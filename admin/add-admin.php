<?php include('../config/constants.php');
include('./partials/login-check.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://db.onlinewebfonts.com/c/d7e8a95865396cddca89b00080d2cba6?family=SoDo+Sans+SemiBold" rel="stylesheet">
    <title>Admin Home Page</title>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link type="text/css" rel="stylesheet" href="admin.css">
    <link rel="icon" href="img/logo.png">
</head>

<body>
    <section id="header">
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-drink.php">Drink</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>


    <div class="main-content">
        <div class="section-p1">
            <h3>Add Admin</h3>
            <br><br>

            <form action="" method="POST">
                <table style="width: 30%;">
                    <tr>
                        <td> Full Name: </td>
                        <td><input type="text" name="full_name" placeholder="Enter your name"></td>
                    </tr>


                    <tr>
                        <td> User Name: </td>
                        <td><input type="text" name="user_name" placeholder="Your Username"></td>
                    </tr>

                    <tr>
                        <td> Password: </td>
                        <td><input type="password" name="password" placeholder="Your Password"></td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>


        </div>
    </div>



    <?php
    if (isset($_POST['submit'])) {
        $full_name = $_POST['full_name'];
        $username = $_POST['user_name'];
        $password = md5($_POST['password']);

        $sql = "INSERT INTO admin SET
            full_name='$full_name',
            username='$username',
            password='$password'
        ";

        $res = mysqli_query($conn, $sql) or die(mysqli_error($conn));

        if ($res == TRUE) {
            $_SESSION['add'] = "<div class='success'>Admin Added Successfully.</div>";
            header("location:" . SITEURL . 'admin/manage-admin.php');
        } else {
            $_SESSION['add'] = "Failed to Add Admin";
            header("location:" . SITEURL . 'admin/manage-admin.php');
        }
    }
    ?>




    <?php include('partials/footer.php') ?>