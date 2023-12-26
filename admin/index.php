<?php include('../config/constants.php');
include('./partials/login-check.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://db.onlinewebfonts.com/c/d7e8a95865396cddca89b00080d2cba6?family=SoDo+Sans+SemiBold" rel="stylesheet">
    <title>Admin Page</title>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link type="text/css" rel="stylesheet" href="admin.css">
    <link rel="icon" href="../img/logo.png">
</head>

<body>
    <section id="header">
        <div>
            <ul id="navbar">
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="manage-admin.php">Admin</a></li>
                <li><a href="manage-category.php">Category</a></li>
                <li><a href="manage-drink.php">Drink</a></li>
                <li><a href="manage-order.php">Order</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </div>
    </section>

    <div class="main-content">
        <div class="section-p1">
            <h4><strong>DASHBOARD</strong></h4>
            <br><br>
            <?php
            if (isset($_SESSION['login'])) {
                echo $_SESSION['login'];
                unset($_SESSION['login']);
            }
            ?>
            <br><br>
            <div id="col-1">
                <div class="col-4">

                    <?php
                    $sql = "SELECT * FROM category";
                    $res = mysqli_query($conn, $sql);
                    $count = mysqli_num_rows($res);


                    ?>


                    <h4><?php echo $count; ?></h4>
                    <br>
                    Categories
                </div>
                <div class="col-4">
                    <?php
                    $sql2 = "SELECT * FROM drink";
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);


                    ?>
                    <h4><?php echo $count2; ?></h4>
                    <br>
                    Drink
                </div>
                <div class="col-4">
                    <?php
                    $sql3 = "SELECT * FROM drink_order";
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);


                    ?>
                    <h4><?php echo $count3; ?></h4>
                    <br>
                    Don Hang
                </div>
                <div class="col-4">
                    <?php
                    $sql4 = "SELECT SUM(total) AS Total FROM drink_order WHERE status='Delivered'";
                    $res4 = mysqli_query($conn, $sql4);
                    $row4 = mysqli_fetch_assoc($res4);
                    $total_renevue = $row4['Total'];


                    ?>
                    <h4>$<?php echo $total_renevue; ?></h4>
                    <br>
                    Doanh Thu
                </div>
            </div>
        </div>
    </div>


    <?php include('partials/footer.php'); ?>