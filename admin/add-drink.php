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
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a class="active" href="manage-drink.php">Drink</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>

    <div class="main-content">
        <div class="section-p1">
            <h3><strong>Add Drink</strong></h3>
            <br><br>

            <?php
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
                            <input type="text" name="title" placeholder="Title of the Drink">
                        </td>
                    </tr>

                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5" placeholder="Desription of the Drink"></textarea>
                        </td>
                    </tr>

                    <tr>
                        <td>Price</td>
                        <td>
                            <input type="number" name="price">
                        </td>
                    </tr>


                    <tr>
                        <td>Select Image: </td>
                        <td>
                            <input type="file" name="image">
                        </td>
                    </tr>

                    <tr>
                        <td>Category:</td>
                        <td>
                            <select name="category">
                                <?php
                                $sql = "SELECT * FROM category WHERE active='Yes'";

                                $res = mysqli_query($conn, $sql);

                                $count = mysqli_num_rows($res);

                                if ($count > 0) {
                                    while ($row = mysqli_fetch_assoc($res)) {
                                        $id = $row['id'];
                                        $title = $row['title'];

                                ?>

                                        <option value="<?php echo $id; ?>"><?php echo $title ?></option>
                                    <?php
                                    }
                                } else {
                                    ?>
                                    <option value="1">No Category Found</option>
                                <?php
                                }
                                ?>

                            </select>
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
                            <input type="submit" name="submit" value="Add Drink" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>

            <?php
            if (isset($_POST['submit'])) {
                $title = $_POST['title'];
                $description = $_POST['description'];
                $price = $_POST['price'];
                $category = $_POST['category'];
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

                if (isset($_FILES['image']['name'])) {
                    $image_name = $_FILES['image']['name'];
                    if ($image_name != "") {
                        // $ext = end(explode('.', $image_name));
                        $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                        $image_name = "Drink_Name_" . rand(0000, 9999) . "." . $ext;
                        $src = $_FILES['image']['tmp_name'];
                        $dst = "../img/drink/" . $image_name;
                        $upload = move_uploaded_file($src, $dst);

                        if ($upload == false) {
                            $_SESSION['upload'] = "<div class='error'>Failed to Upload Image.</div>";
                            header('location:' . SITEURL . 'admin/add-drink.php');
                            // die();
                            exit();
                        }
                    }
                } else {
                    $image_name = "";
                }

                $sql2 = "INSERT INTO drink SET
                    title = '$title',
                    description = '$description',
                    price = $price,
                    image_name = '$image_name',
                    category_id= $category,
                    featured = '$featured',
                    active='$active'
                ";

                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['add'] = "<div class='success'>Food Added Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-drink.php');
                } else {
                    $_SESSION['add'] = "<div class='error'>Failed to Add Food.</div>";
                    header('location:' . SITEURL . 'admin/manage-drink.php');
                }
            }
            ?>


        </div>
    </div>







    <?php include('partials/footer.php') ?>