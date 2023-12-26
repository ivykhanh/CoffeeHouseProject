<?php include('../config/constants.php');
include('./partials/login-check.php'); ?>



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
            <h3><strong>Change Password</strong></h3>
            <br><br>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
            }
            ?>


            <form action="" method="POST">
                <table width="30%">
                    <tr>
                        <td> Current Password: </td>
                        <td><input type="password" name="current_password" placeholder="Current Password"></td>
                    </tr>


                    <tr>
                        <td> New Password: </td>
                        <td><input type="password" name="new_password" placeholder="New Password"></td>
                    </tr>

                    <tr>
                        <td> Confirm Password: </td>
                        <td><input type="password" name="confirm_password" placeholder="Confirm Password"></td>
                    </tr>

                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Change Password" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>



    <?php
    if (isset($_POST['submit'])) {

        $id = $_POST['id'];
        $current_password = md5($_POST['current_password']);
        $new_password = md5($_POST['new_password']);
        $confirm_password = md5($_POST['confirm_password']);

        $sql = "SELECT * from admin where id=$id AND password='$current_password'";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $count = mysqli_num_rows($res);

            if ($count == 1) {
                if ($new_password == $confirm_password) {
                    $sql2 = "UPDATE admin set
                    password='$new_password'
                    where id=$id
                    ";
                    $res2 = mysqli_query($conn, $sql2);
                    if ($res2 == true) {
                        $_SESSION['change-pwd'] = "<div class='success'>Password Changed Successfully.</div>";
                        header('location:' . SITEURL . 'admin/manage-admin.php');
                    } else {
                        $_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password</div>";
                        header('location:' . SITEURL . 'admin/manage-admin.php');
                    }
                } else {
                    $_SESSION['pwd-not-match'] = "<div class='error'>Password Did not Match</div>";
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            } else {
                $_SESSION['user-not-found'] = "<div class='error'>User Not Found</div>";
                header('location:' . SITEURL . 'admin/manage-admin.php');
            }
        }
    }

    ?>



    <?php include('partials/footer.php') ?>