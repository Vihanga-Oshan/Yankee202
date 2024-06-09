<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Watchlist | eShop</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />

    <link rel="icon" href="resource/yankeelogo.png" />
</head>

<body>

    <div class=" bodytop  product-container" style="background-color:#bde6fae4;">
        <div class="Sproduct " style="background-color:#bde6fae4 ;padding-bottom:20;">

            <?php include "header.php";

            require "connection.php";

            if (isset($_SESSION["u"])) {

            ?>

                <div class="" style="min-height:100vh;">
                    <div class="d-lg-flex justify-content-lg-center  " style="margin: 0; padding: 0;">
                        <div class="row offset-lg-1 col-lg-11 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4 wrapper2 mt-5" style="padding: 0;margin: 0;">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-12  bodere" style="min-height 50vh;max-height:70vh;overflow-y: scroll;">

                                <?php

                                $watch_rs = Database::search("SELECT * FROM `watchlist` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                $watch_num = $watch_rs->num_rows;

                                if ($watch_num == 0) {
                                ?>
                                    <!-- empty view -->
                                    <div class="d-flex justify-content-center align-items-center flex-column" style="height:70vh;">
                <div class="d-flex justify-content-center flex-column  align-items-center">
                    
                    <h3 class="py-3 text-align-center">
                        <b>Your Watchlist is empty</b>
                    </h3>



                </div>
                <div>
                                    <!-- empty view -->
                                <?php
                                } else {
                                ?>
                                    <!-- have products -->
                                    <div class="col-10 offset-1 ">
                                        <div class="row">
                                            <?php
                                            for ($x = 0; $x < $watch_num; $x++) {
                                                $watch_data = $watch_rs->fetch_assoc();
                                            ?>

                                                <div class="card mb-3 mx-0 mx-lg-2 col-12">
                                                    <div class="row g-0">
                                                        <div class="col-md-3 align-content-center">
                                                            <?php
                                                            $img = array();

                                                            $images_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='".$watch_data["product_id"]."'");
                                                            $images_data = $images_rs->fetch_assoc();
                                                                
                                                            ?>
                                                            <img src="<?php echo $images_data["path"]; ?>" class="img-fluid rounded-start" style="height: 100px;" />
                                                        </div>
                                                        <div class="col-md-3 align-content-center ">
                                                        <?php

                                                            $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='".$watch_data["product_id"]."'");
                                                            $product_data = $product_rs->fetch_assoc();

                                                            ?>
                                                            <h5 class="card-title fs-5 "><?php echo $product_data["title"]; ?></h5>
                                                        </div>
                                                        <div class="col-md-4 align-content-center ">
                                                            <div class="card-body">
                                                               
                                                                <?php

                                                                $clr_rs = Database::search("SELECT * FROM `color` WHERE `color_id`='".$product_data["color_clr_id"]."'");
                                                                $clr_data = $clr_rs->fetch_assoc();
                                                                
                                                                ?>
                                                                <span class="fs-6  text-black-50">Colour :<span class="  text-black"> <?php echo $clr_data["clr_name"]; ?></span></span><br />
                                                                
                                                                <?php

                                                                $condition_rs = Database::search("SELECT * FROM `condition` WHERE `condition_id`='".$product_data["condition_condition_id"]."'");
                                                                $condition_data = $condition_rs->fetch_assoc();
                                                                $seller_rs = Database::search("SELECT `fname` FROM `user` WHERE `email`='".$product_data["user_email"]."'");
                                                                $seller_data = $seller_rs->fetch_assoc();
                                                                
                                                                ?>
                                                                <span class="fs-6  text-black-50">Condition :<span class="  text-black"> <?php echo $condition_data["condition_name"]; ?></span></span>
                                                                <br />
                                                                <span class="fs-6  text-black-50">Price :</span>&nbsp;&nbsp;
                                                                <span class="fs-6  text-black">Rs. <?php echo $product_data["price"]; ?> .00</span>
                                                                <br />
                                                                <span class="fs-6  text-black-50">Quantity :</span>&nbsp;&nbsp;
                                                                <span class="fs-6  text-black"><?php echo $product_data["qty"]; ?> Items available</span>
                                                                <br />
                                                                <span class="fs-6  text-black-50">Seller :</span>
                                                                
                                                                <span class="fs-6  text-black"><?php echo $seller_data["fname"]; ?></span>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2   ">
                                                            <div class="card-body d-lg-grid ">
                                                                <a href="#" class="  btn btn-secondary mb-2">Buy Now</a>
                                                                <a href="#" class="btn btn-secondary mb-2">Add to Cart</a>
                                                                <a href="#" class="btn btn-secondary" 
                                                                onclick='removeFromWatchlist(<?php echo $watch_data["w_id"]; ?>);'>Remove</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                        <?php
                                            }
                                        }

                                        ?>





                                        </div>
                                    </div>
                                    <!-- have products -->


                            </div>
                        </div>
                    </div>
                </div>

            <?php

            } else {
                header("Location:home.php");
            }

            ?>

            <?php include "footer.php"; ?>

        </div>
    </div>

    <script src="bootstrap.bundle.js"></script>
    <script src="script.js"></script>
</body>

</html>