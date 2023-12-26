<?php include('../config/constants.php');
include('./partials/login-check.php');

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $current_image = $_POST['current_image'];
    $category = $_POST['category'];
    $featured = $_POST['featured'];
    $active = $_POST['active'];
    if (isset($_FILES['image']['name'])) {
        $image_name = $_FILES['image']['name'];
        if ($image_name != "") {

            // $ext = end(explode('.', $image_name));
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);
            $image_name = "Drink_Name_" . rand(000, 999) . '.' . $ext;

            $src_path = $_FILES['image']['tmp_name'];

            $dest_path = "../img/category/" . $image_name;

            $upload = move_uploaded_file($src_path, $dest_path);

            if ($upload == false) {
                $_SESSION['upload'] = "<div class='error'>Failed to Upload New Image. </div>";

                header('location:' . SITEURL . 'admin/manage-drink.php');

                die();
            }
            // if ($current_image != "") {


            //     $remove_path = "../img/category/" . $current_image;

            //     $remove = unlink($remove_path);

            //     if ($remove == false) {
            //         $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current Image.</div>";
            //         header('location:' . SITEURL . 'admin/manage-drink.php');
            //         die();
            //     }
            // }
            if (file_exists("../img/category/" . $current_image)) {
                $remove_path = "../img/category/" . $current_image;

                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['remove-failed'] = "<div class='error'>Failed to remove current Image.</div>";
                    header('location:' . SITEURL . 'admin/manage-drink.php');
                    die();
                }
            }
        } else {
            $image_name = $current_image;
        }
    } else {
        $image_name = $current_image;
    }

    $sql3 = "UPDATE drink SET
        title='$title',
        description = '$description',
        price=$price,
        image_name = '$image_name',
        category_id='$category',
        featured='$featured',
        active='$active'
        WHERE id=$id                
    ";

    $res3 = mysqli_query($conn, $sql3);

    if ($res3 == true) {
        $_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
        header('location:' . SITEURL . 'admin/manage-drink.php');
    } else {
        $_SESSION['update'] = "<div class='error'>Failed to Update Category.</div>";
        header('location:' . SITEURL . 'admin/manage-drink.php');
    }
}
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
            <h3><strong>Update Drink</strong></h3>
            <br /><br>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];
                $sql2 = "SELECT * FROM drink WHERE id=$id";

                $res2 = mysqli_query($conn, $sql2);

                $row2 = mysqli_fetch_assoc($res2);

                $title = $row2['title'];
                $description = $row2['description'];
                $price = $row2['price'];
                $current_image = $row2['image_name'];
                $current_category = $row2['category_id'];
                $featured = $row2['featured'];
                $active = $row2['active'];
            } else {
                header('location:' . SITEURL . 'admin/manage-drink.php');
            }
            ?>


            <form action="" method="POST" enctype="multipart/form-data">
                <table width="30%">
                    <tr>
                        <td>Title:</td>
                        <td>
                            <input type="text" name="title" value="<?php echo $title; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Description:</td>
                        <td>
                            <textarea name="description" cols="30" rows="5"><?php echo $description; ?></textarea>
                        </td>
                    </tr>
                    <tr>
                        <td>Price:</td>
                        <td>
                            <input type="number" name="price" value="<?php echo $price; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Current Image:</td>
                        <td>
                            <?php
                            if ($current_image != "") {
                            ?>
                                <img src="<?php echo SITEURL; ?>img/drink/<?php echo $current_image; ?>" width="150px">
                            <?php
                            } else {
                                echo "<div class='error'>Image Not Added</div>";
                            }
                            ?>
                        </td>
                    </tr>

                    <tr>
                        <td>New Image:</td>
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
                                        $category_title = $row['title'];
                                        $category_id = $row['id'];

                                ?>
                                        <option <?php if ($current_category == $category_id) {
                                                    echo "selected";
                                                } ?>value="<?php echo $category_id; ?>"><?php echo $category_title; ?></option>
                                <?php
                                    }
                                } else {
                                    echo "<option value='0'>Category Not Avaiable.</option>";
                                }
                                ?>
                            </select>
                        </td>
                    </tr>

                    <tr>
                        <td>Featured:</td>
                        <td>
                            <input <?php if ($featured == "Yes") {
                                        echo "checked";
                                    } ?> type="radio" name="featured" value="Yes"> Yes

                            <input <?php if ($featured == "No") {
                                        echo "checked";
                                    } ?> type="radio" name="featured" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>Active:</td>
                        <td>
                            <input <?php if ($active == "Yes") {
                                        echo "checked";
                                    } ?> type="radio" name="active" value="Yes"> Yes

                            <input <?php if ($active == "No") {
                                        echo "checked";
                                    } ?> type="radio" name="active" value="No"> No
                        </td>
                    </tr>

                    <tr>
                        <td>

                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
                            <input type="submit" name="submit" value="Update Category" class="btn-secondary">
                        </td>
                    </tr>
                </table>
            </form>





        </div>
    </div>


    <?php include('partials/footer.php') ?>