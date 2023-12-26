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
            <h3><strong>Update Admin</strong></h3>
            <br><br>

            <?php
            $id = $_GET['id'];
            $sql = "SELECT * from admin where id=$id";
            $res = mysqli_query($conn, $sql);
            if ($res == true) {
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $full_name = $row['full_name'];
                    $username = $row['username'];
                } else {
                    header('location:' . SITEURL . 'admin/manage-admin.php');
                }
            }
            ?>



            <form action="" method="POST">
                <table width="30%">
                    <tr>
                        <td> Full Name: </td>
                        <td><input type="text" name="full_name" value="<?php echo $full_name; ?>" placeholder="Enter your name"></td>
                    </tr>


                    <tr>
                        <td> User Name: </td>
                        <td><input type="text" name="username" value="<?php echo $username; ?>" placeholder="Your Username"></td>
                    </tr>
                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="submit" name="submit" value="Update Admin" class="btn-secondary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        $id = $_POST['id'];
        $full_name = $_POST['full_name'];
        $username = $_POST['username'];

        $sql = "UPDATE admin SET
        full_name='$full_name',
        username='$username'
        where id='$id'
        ";

        $res = mysqli_query($conn, $sql);
        if ($res == true) {
            $_SESSION['update'] = "<div class='success'>Admin Updated Successfully</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        } else {
            $_SESSION['update'] = "<div class='error'>Failed to Update Admin</div>";
            header('location:' . SITEURL . 'admin/manage-admin.php');
        }
    }
    ?>







    <?php include('partials/footer.php') ?>