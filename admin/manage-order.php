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
            <h3><strong>Manage Coffee Orders </strong></h3>
            <br />
            <br />
            <?php
            if (isset($_SESSION['update'])) {
                echo $_SESSION['update'];
                unset($_SESSION['update']);
            }

            ?>
            <br><br>

            <table>
                <tr>
                    <th>STT</th>
                    <th>Drink</th>
                    <th>Price</th>
                    <th>Qty</th>
                    <th>Total</th>
                    <th>Order Date</th>
                    <th>Status</th>
                    <th>Customer Name</th>
                    <th>Customer Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
                <?php
                $sql = "SELECT * FROM drink_order ORDER BY id DESC";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);

                $sn = 1;
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $id = $row['id'];
                        $drink = $row['drink'];
                        $price = $row['price'];
                        $qty = $row['qty'];
                        $total = $row['total'];
                        $order_date = $row['order_date'];

                        $status = $row['status'];
                        $customer_name = $row['customer_name'];
                        $customer_contact = $row['customer_contact'];
                        $customer_email = $row['customer_email'];
                        $customer_address = $row['customer_address'];

                ?>
                        <tr>
                            <td><?php echo $sn++; ?></td>
                            <td><?php echo $drink ?></td>
                            <td><?php echo $price ?></td>
                            <td><?php echo $qty ?></td>
                            <td><?php echo $total ?></td>
                            <td><?php echo $order_date ?></td>
                            <td><?php
                                if ($status == "Ordered") {
                                    echo "<label>$status</label>";
                                } elseif ($status == "On Delivery") {
                                    echo "<label style='color: #fbbc05'>$status</label>";
                                } elseif ($status == "Delivered") {
                                    echo "<label style='color: green'>$status</label>";
                                } elseif ($status == "Cancelled") {
                                    echo "<label style='color: red'>$status</label>";
                                }


                                ?></td>
                            <td><?php echo $customer_name ?></td>
                            <td><?php echo $customer_contact ?></td>
                            <td><?php echo $customer_email ?></td>
                            <td><?php echo $customer_address ?></td>
                            <td>
                                <a href="<?php echo SITEURL; ?>admin/update-order.php?id=<?php echo $id; ?>" class="btn-primary">Update Order</a>
                            </td>
                        </tr>
                <?php



                    }
                } else {
                    echo "<tr><td class='error'>Orders not Avaiable</td></tr>";
                }

                ?>



            </table>

        </div>
    </div>




    <?php include('partials/footer.php') ?>