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
            <h3><strong>Manage Admin></strong></h3>
            <br />
            <a href="add-admin.php" class="btn-primary">Add Admin</a>

            <br /> <br />


            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }


            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            if (isset($_SESSION['user-not-found'])) {
                echo $_SESSION['user-not-found'];
                unset($_SESSION['user-not-found']);
            }

            if (isset($_SESSION['pwd-not-match'])) {
                echo $_SESSION['pwd-not-match'];
                unset($_SESSION['pwd-not-match']);
            }

            if (isset($_SESSION['change-pwd'])) {
                echo $_SESSION['change-pwd'];
                unset($_SESSION['change-pwd']);
            }

            ?>

            <br><br><br>

            <table width="100%">
                <tr>
                    <th>ID</th>
                    <th width="25%">Fullname</th>
                    <th width="20%">Username</th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM admin";
                $res = mysqli_query($conn, $sql);

                if ($res == TRUE) {
                    $count = mysqli_num_rows($res);
                    $stt = 1;


                    if ($count > 0) {
                        while ($rows = mysqli_fetch_assoc($res)) {
                            $id = $rows['id'];
                            $full_name = $rows['full_name'];
                            $username = $rows['username'];
                ?>
                            <tr>
                                <td><?php echo $stt++; ?></td>
                                <td><?php echo $full_name; ?></td>
                                <td><?php echo $username; ?></td>
                                <td>
                                    <a href="<?php echo SITEURL; ?>/admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
                                    <a href="<?php echo SITEURL; ?>/admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                    <a href="<?php echo SITEURL; ?>/admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

                                </td>
                            </tr>

                <?php

                        }
                    } else {
                    }
                }


                ?>


            </table>
            <?php echo $count; ?>
        </div>
    </div>


    <?php include('partials/footer.php') ?>