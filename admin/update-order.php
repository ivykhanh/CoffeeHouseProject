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
                <li><a href="manage-drink.php">Drink</a></li>
                <li><a class="active" href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>

    <div class="main-content">
        <div class="section-p1">
            <h3><strong>Update Coffee Orders </strong></h3>

            <br><br>

            <?php
            if (isset($_GET['id'])) {
                $id = $_GET['id'];

                $sql = "SELECT * FROM drink_order WHERE id=$id";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                if ($count == 1) {
                    $row = mysqli_fetch_assoc($res);

                    $drink = $row['drink'];
                    $price = $row['price'];
                    $qty = $row['qty'];
                    $status = $row['status'];
                    $customer_name = $row['customer_name'];
                    $customer_contact = $row['customer_contact'];
                    $customer_email = $row['customer_email'];
                    $customer_address = $row['customer_address'];
                } else {
                    header('location:' . SITEURL . 'admin/manage-order.php');
                }
            } else {
                header('location:' . SITEURL . 'admin/manage-order.php');
            }

            if (isset($_POST['submit'])) {
                $id = $_POST['id'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];
                $total = $price * $qty;
                $status = $_POST['status'];

                $sql2 = "UPDATE drink_order SET
                    qty=$qty,
                    total = $total,
                    status='$status'
                    WHERE
                    id=$id
                
                ";
                $res2 = mysqli_query($conn, $sql2);

                if ($res2 == true) {
                    $_SESSION['update'] = "<div class='success'>Order Update Successfully.</div>";
                    header('location:' . SITEURL . 'admin/manage-order.php');
                } else {
                    $_SESSION['update'] = "<div class='error'>Failed to Update Order.</div>";
                    header('location:' . SITEURL . 'admin/manage-order.php');
                }
            }

            ?>


            <form action="" method="POST">
                <table>
                    <tr>
                        <td>Customer Name</td>
                        <td>
                            <?php echo $customer_name; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Contact</td>
                        <td>
                            <?php echo $customer_contact; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Email</td>
                        <td>
                            <?php echo $customer_email; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Customer Address</td>
                        <td>
                            <?php echo $customer_address; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Food Name</td>
                        <td><?php echo $drink; ?></td>
                    </tr>
                    <tr>
                        <td>Price</td>
                        <td>
                            $<?php echo $price; ?>
                        </td>
                    </tr>
                    <tr>
                        <td>Qty</td>
                        <td>
                            <input type="number" name="qty" value="<?php echo $qty; ?>">
                        </td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td>
                            <select name="status">
                                <option <?php if ($status == "Ordered") {
                                            echo "selected";
                                        } ?> value="Ordered">Ordered</option>
                                <option <?php if ($status == "On Delivery") {
                                            echo "selected";
                                        } ?> value="On Delivery">On Delivery</option>
                                <option <?php if ($status == "Delivered") {
                                            echo "selected";
                                        } ?> value="Delivered">Delivered</option>
                                <option <?php if ($status == "Cancelled") {
                                            echo "selected";
                                        } ?> value="Cancelled">Cancelled</option>
                            </select>
                        </td>
                    </tr>



                    <tr>
                        <td>
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                            <input type="submit" name="submit" value="Update Order" class="btn-primary">
                        </td>
                    </tr>

                </table>
            </form>
        </div>
    </div>

    <?php include('partials/footer.php') ?>