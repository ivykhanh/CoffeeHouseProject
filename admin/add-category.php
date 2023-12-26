<?php include('../config/constants.php');
include('./partials/login-check.php');
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://db.onlinewebfonts.com/c/d7e8a95865396cddca89b00080d2cba6?family=SoDo+Sans+SemiBold" rel="stylesheet">
    <title>Admin Category Page</title>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link type="text/css" rel="stylesheet" href="admin.css">
    <link rel="icon" href="img/logo.png">
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
            <h3>Add Category</h3>
            <br><br>

            <?php
            if (isset($_SESSION['add'])) {
                echo $_SESSION['add'];
                unset($_SESSION['add']);
            }

            if (isset($_SESSION['upload'])) {
                echo $_SESSION['upload'];
                unset($_SESSION['upload']);
            }
            ?>

            <form action="" method="POST" enctype="multipart/form-data">
                <table width="30%" style="width: 30%;">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" placeholder="Category Title">
                        </td>
                    </tr>

                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>



                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input type="radio" name="featured" value="Yes">Yes
                            <input type="radio" name="featured" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input type="radio" name="active" value="Yes">Yes
                            <input type="radio" name="active" value="No">No
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <input type="submit" name="submit" value="Add Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];

                if (isset($_POST['featured'])) {
                    $featured = $_POST['featured'];
                } else {
                    $featured = "No";
                }

                if (isset($_POST['active'])) {
                    $active = $_POST['active'];
                } else {
                    $active = "No";
                }

                // print_r($_FILES['image']);

                // die();

                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") {


                        $ext = end(explode('.', $image_name));
                        $image_name = "Drink_Category_" . rand(000, 999) . '.' . $ext;

                        $source_path = $_FILES['image']['tmp_name'];

                        $destionation_path = "../img/category/" . $image_name;

                        $upload = move_uploaded_file($source_path, $destionation_path);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image. </div>";

                            header('location:' . SITEURL . 'admin/add-category.php');

                            die();
                        }
                    }
                } else {
                    $image_name = "";
                }

                $sql = "INSERT INTO category SET
                    title='$title',
                    image_name='$image_name',
                    featured='$featured',
                    active='$active'
                ";


                $res = mysqli_query($conn, $sql);

                if ($res == true) {
                    $_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Fail to Added Category.</div>";
                    header('location:' . SITEURL . 'admin/manage-category.php');
                }
            }


            ?>


        </div>
    </div>











    <?php include('partials/footer.php') ?>