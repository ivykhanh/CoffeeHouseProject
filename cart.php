<?php include('./config/constants.php'); ?>

<?php
if (isset($_GET['drink_id'])) {
    $drink_id = $_GET['drink_id'];

    $sql = "SELECT * FROM drink WHERE id=$drink_id";

    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);
    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);

        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header('location:' . SITEURL);
        exit();
    }
} else {
    header('location:' . SITEURL);
    exit();
}

?>


<?php
if (isset($_POST['submit'])) {
    $drink = $title;
    $price = $price;
    $qty = $_POST['qty'];
    $total = $price * $qty;
    $order_date = date("Y-m-d h:i:sa");
    $status = "Ordered";
    $customer_name = $_POST['full-name'];
    $customer_contact = $_POST['contact'];
    $customer_email = $_POST['email'];
    $customer_address = $_POST['address'];


    $sql2 = "INSERT INTO drink_order SET
                    drink='$drink',
                    price = $price,
                    qty = $qty,
                    total=$total,
                    order_date = '$order_date',
                    status = '$status',
                    customer_name ='$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'

                ";

    $res2 = mysqli_query($conn, $sql2);

    if ($res2 == true) {
        $_SESSION['order'] = "<div class='success'>Drink Order Successfully.</div>";
        header('location:' . SITEURL);
        exit();
    } else {
        $_SESSION['order'] = "<div class='error'>Failed to Order Drink.</div>";
        header('location:' . SITEURL);
        exit();
    }
}




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://db.onlinewebfonts.com/c/d7e8a95865396cddca89b00080d2cba6?family=SoDo+Sans+SemiBold" rel="stylesheet">
    <title>KG Website</title>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="icon" href="img/logo.png">


</head>

<body>
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a class="active" href="cart.php" id="bag-outline"><ion-icon name="bag-outline"></ion-icon></a>

                </li>
                <a href="#" id="close"><ion-icon name="close-outline"></ion-icon></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>

    <section id="page-header">
        <h2>#STAYHOME</h2>
    </section>


    <form action="" method="POST">
        <section id="cart" class="section-p1">
            <table width="100%">
                <thead>
                    <tr>
                        <td>Image</td>
                        <td>Product</td>
                        <td>Price</td>
                        <td>Quantity</td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image not available.</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>img/drink/<?php echo $image_name; ?>" alt="">
                            <?php
                            }
                            ?>
                        </td>
                        <td><?php echo $title; ?>
                            <input type="hidden" name="drink" value="<?php echo $title; ?>">
                        </td>

                        <td>$<?php echo $price; ?>
                            <input type="hidden" name="price" value="<?php echo $price; ?>">
                        </td>

                        <td>
                            <input type="number" name="qty" value="1" required>
                        </td>
                    </tr>
                </tbody>
            </table>
        </section>


        <section id="cart-body" class="section-p1">
            <div class="cart-wrapper">
                <h3>Payment Form</h3>

                <div class="input_group">
                    <div class="input_box">
                        <input type="text" name="full-name" placeholder="Full Name" required class="name">
                        <ion-icon name="person-circle-outline" class="icon"></ion-icon>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input type="tel" name="contact" placeholder="Telephone" required class="name">
                        <ion-icon name="call-outline" class="icon"></ion-icon>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input type="email" name="email" placeholder="Email Address" required class="name">
                        <ion-icon name="mail-outline" class="icon"></ion-icon>
                    </div>
                </div>
                <div class="input_group">
                    <div class="input_box">
                        <input name="address" rows="2" placeholder="Address" required class="name">
                        <ion-icon name="map-outline" class="icon"></ion-icon>
                    </div>
                </div>

                <input type="submit" name="submit" value="Confirm Order" class="form-submit">

            </div>
        </section>
    </form>


    <?php include('partials-frontend/footer.php') ?>




    <!-- <hr>
    
    <footer class="section-p1">
        <div class="col" id="col">
            <img src="img/logo.png" id="footer-logo" alt="">
            <h4>Contact</h4>
            <p><strong>Address:</strong> 182/32 Alley 182, Tran Hung Dao Street, An Nghiep District, Can Tho City</p>
            <p><strong>Phone:</strong> (+84) 969908953</p>
            <div class="icon-footer">
                <a><i class="fab fa-facebook-f"></i></a>
                <a><i class="fab fa-instagram"></i></a>
                <a><i class="fab fa-youtube"></i></a>
            </div>
        </div>
        <div class="copyright">
            <p>@2023, KG Gear - Tran Gia Khanh B2017049</p>
        </div>
    </footer>





    <script src="script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
</body>
</html> -->