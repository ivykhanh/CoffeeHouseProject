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
        <?php
        $search = $_POST['search'];
        ?>
        <h2>Drink On <?php echo $search; ?></h2>
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

            $search = $_POST['search'];

            $sql = "SELECT * FROM drink WHERE title LIKE '%$search%' OR description LIKE '%$search%' ";

            $res = mysqli_query($conn, $sql);

            $count = mysqli_num_rows($res);

            if ($count > 0) {
                while ($row = mysqli_fetch_assoc($res)) {
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