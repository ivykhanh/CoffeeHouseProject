<?php include('./config/constants.php'); ?>
<?php
if (isset($_GET['category_id'])) {
    $category_id = $_GET['category_id'];
    $sql = "SELECT title FROM category where id=$category_id";

    $res = mysqli_query($conn, $sql);

    $row = mysqli_fetch_assoc($res);

    $category_title = $row['title'];
} else {
    header('location:' . SITEURL);
} ?>


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
                <li><a href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a class="active" href="<?php echo SITEURL; ?>shop.php">Shop</a></li>
                <!-- <li><a href="<?php echo SITEURL; ?>cart.php" id="bag-outline"><ion-icon name="bag-outline"></ion-icon></a>

                </li> -->
                <a href="#" id="close"><ion-icon name="close-outline"></ion-icon></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>


    <section id="hero" style="background-image: url(./img/banner/banner5.jpg);">
        <h2>COFFEE SHOP</h2>
        <h4>KG Xin Chào</h4>
    </section>


    <section id="page-header">
        <h2>Drink on <?php echo $category_title; ?></h2>
    </section>

    <section class="section-p1">
        <div class="search">
            <div class="search-box">
                <form action="<?php echo SITEURL; ?>shop-search.php" method="POST">
                    <input type="search" name="search" placeholder="Search here for drink . . ." required>
                    <input type="submit" name="submit" value="Search" id="sm-search">
                </form>
            </div>
        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Products</h2>
        <p>KG Coffee Shop</p>
        <div class="pro-container">
            <?php
            $sql2 = "SELECT * FROM drink WHERE category_id=$category_id";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row2 = mysqli_fetch_assoc($res2)) {
                    $id = $row2['id'];
                    $title = $row2['title'];
                    $price = $row2['price'];
                    $description = $row2['description'];
                    $image_name = $row2['image_name'];
            ?>
                    <div class="pro">
                        <?php
                        if ($image_name == "") {
                            echo "<div class='error'>Image not avaiable</div>";
                        } else {
                        ?>
                            <img src="<?php echo SITEURL; ?>/img/drink/<?php echo $image_name; ?>" alt="">
                        <?php
                        }
                        ?>
                        <div class="des">
                            <span><?php echo $description; ?></span>
                            <h5><?php echo $title; ?></h5>
                            <div class="star">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <h4>$<?php echo $price; ?></h4>
                        </div>
                        <a href="<?php echo SITEURL; ?>cart.php?drink_id=<?php echo $id ?>"><ion-icon name="cart-outline" class="cart"></ion-icon></a>
                    </div>
            <?php
                }
            } else {
                echo "<div class='error'>Drink not avaiable.</div>";
            }

            ?>
        </div>
    </section>


    <section id="sm-banner">
        <img src="img/banner/banner2.jpg">
        <img src="img/banner/banner4.jpg">
    </section>


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