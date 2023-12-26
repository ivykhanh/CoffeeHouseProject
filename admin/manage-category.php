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
    <link rel="icon" href="../img/logo.png">
</head>

<body>
    <section id="header">
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a class="active" href="manage-category.php">Category</a></li>
                <li><a href="manage-drink.php">Drink</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>

    <div class="main-content">
        <div class="section-p1">
            <h3><strong>Manage Category</strong></h3>
            <br />
            <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>

            <br /><br /> <br><br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['remove'])) {
                echo $_SESSION['remove'];
                unset($_SESSION['remove']);
            }
            if (isset($_SESSION['delete'])) {
                echo $_SESSION['delete'];
                unset($_SESSION['delete']);
            }

            if (isset($_SESSION['no-category-found'])) {
                echo $_SESSION['no-category-found'];
                unset($_SESSION['no-category-found']);
            }
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }
            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            if (isset($_SESSION['failed-remove'])) {
                echo $_SESSION['failed-remove'];
                unset($_SESSION['failed-remove']);
            }

            ?>


            <br>

            <table width="100%">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Featured</th>
                    <th>Active</th>
                    <th>Actions</th>
                </tr>

                <?php
                $sql = "SELECT * FROM category";

                $res = mysqli_query($conn, $sql);

                $count = mysqli_num_rows($res);

                $sn = 1;

                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $title = $row['title'];
                        $image_name = $row['image_name'];
                        $featured = $row['featured'];
                        $active = $row['active'];

                ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $title; ?></td>
                            <td>
                                <?php
                                if ($image_name != "") {
                                ?>
                                    <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" width="100px">
                                <?php

                                } else {
                                    echo "<div class='error'>Image not Added</div>";
                                }
                                ?>
                            </td>

                            <td><?php echo $featured; ?></td>
                            <td><?php echo $active; ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-category.php?id=<?php echo $id; ?>" class="btn-secondary">Update Category</a>
                                <a href="<?php echo SITEURL; ?>admin/delete-category.php?id=<?php echo $id; ?>&image_name=<?php echo $image_name; ?>" class="btn-danger">Delete Category</a>
                            </td>
                        </tr>
                    <?php
                    }
                } else {
                    ?>
                    <tr>
                        <td>
                            <div class="error">No Category Added.</div>
                        </td>
                    </tr>
                <?php
                }
                ?>


            </table>

        </div>
    </div>



    <?php include('partials/footer.php') ?>