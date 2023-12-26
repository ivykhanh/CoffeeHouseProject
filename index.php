<?php include('./config/constants.php'); ?>




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://db.onlinewebfonts.com/c/d7e8a95865396cddca89b00080d2cba6?family=SoDo+Sans+SemiBold" rel="stylesheet">
    <title>KG Website</title>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js"></script>
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <link rel="icon" href="./img/logo.png">


</head>

<body>
    <section id="header">
        <a href="#"><img src="img/logo.png" class="logo" alt=""></a>
        <div>
            <ul id="navbar">
                <li><a class="active" href="<?php echo SITEURL; ?>">Home</a></li>
                <li><a href="<?php echo SITEURL; ?>shop.php">Shop</a></li>
                <!-- <li><a href="<?php echo SITEURL; ?>cart.php" id="bag-outline"><ion-icon name="bag-outline"></ion-icon></a>
                </li> -->
                <a href="#" id="close"><ion-icon name="close-outline"></ion-icon></a>
            </ul>
        </div>
        <div id="mobile">
            <i id="bar" class="fas fa-outdent"></i>
        </div>
    </section>


    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 50% off!</p>
        <button>Shop Now</button>
    </section>


    <br>
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

    <?php
    if (isset($_SESSION['order'])) {
        echo $_SESSION['order'];
        unset($_SESSION['order']);
    }


    ?>

    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="img/f1.png" alt="">
            <h6>Free Shipping</h6>
        </div>
        <div class="fe-box">
            <img src="img/f2.png" alt="">
            <h6>Oneline Order</h6>
        </div>
        <div class="fe-box">
            <img src="img/f3.png" alt="">
            <h6>Save Money</h6>
        </div>
        <div class="fe-box">
            <img src="img/f5.png" alt="">
            <h6>Happy Sell</h6>
        </div>
        <div class="fe-box">
            <img src="img/f6.png" alt="">
            <h6>F24/7 Support</h6>
        </div>
    </section>

    <section id="product1" class="section-p1 hp-category">
        <h2>Category</h2>
        <p>Coffe shop</p>
        <div class="pro-container">

            <?php
            $sql = "SELECT* FROM category WHERE active='Yes' AND featured='Yes' LIMIT 4";
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);


            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $image_name = $row['image_name'];

            ?>
                    <a href="<?php echo SITEURL; ?>shop-category.php?category_id=<?php echo $id; ?>" id="imagecategory">
                        <div class="pro">
                            <?php
                            if ($image_name == "") {
                                echo "<div class='error'>Image Not Avaiable.</div>";
                            } else {
                            ?>
                                <img src="<?php echo SITEURL; ?>img/category/<?php echo $image_name; ?>" alt="">
                            <?php
                            }
                            ?>
                            <div class="des">
                                <h3><?php echo $title; ?></h3>
                                <div class="star">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                            </div>
                        </div>
                    </a>
            <?php

                }
            } else {
                echo "<div class='error'>Category Not Added.</div>";
            }

            ?>




        </div>
    </section>

    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <div class="pro-container">
            <?php
            $sql2 = "SELECT * FROM drink WHERE active='Yes' AND featured='Yes'  ORDER BY RAND() LIMIT 4";

            $res2 = mysqli_query($conn, $sql2);

            $count2 = mysqli_num_rows($res2);

            if ($count2 > 0) {
                while ($row = mysqli_fetch_assoc($res2)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
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

    <section class="section-p1" id="sm-banner">
        <img src="img/banner/banner2.jpg">
        <img src="img/banner/banner4.jpg">
    </section>

    <?php include('partials-frontend/footer.php') ?>