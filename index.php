<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>YanKee</title>

    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
    <script src="https://js.stripe.com/v3/"></script>
    <link rel="icon" href="resource/yankeelogo.png" />

</head>

<body>

<?php include "header.php"; ?>
    <div style=" padding:0;" class="bodytop container-fluid " >
    <div class="row mt-5 d-lg-none d-block" >
    <div class="row mb-2 ">

        

<div class="col-12 offset-1 col-lg-6">

    <div class="input-group mt-3 mb-3">
        <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

        <select class="form-select" style="max-width: 250px;" id="basic_search_select">
            <option value="0">All Categories</option>

            <?php
            

            for ($x = 0; $x < $category_num; $x++) {
                $category_data = $category_rs->fetch_assoc();

            ?>

                <option value="<?php echo $category_data["id"]; ?>"><?php echo $category_data["name"]; ?></option>

            <?php

            }

            ?>

        </select>

    </div>

</div>

<div class="col-12 col-lg-2 d-grid">
    <button class="btn btn-outline-primary mt-3 mb-3" onclick="basicSearch(0);">Search</button>
</div>


</div>

            </div>

          

            <div class="col-12" id="basicSearchResult">
                <div class="row">

                    <!-- Carousel -->
<div class="col-8 imgshow d-none d-lg-block">
                    <div class="bg-image img1">

                    <div class="col-8 mainCategories"><div class="mainCategoriestext">Popular Categories</div>
                    <a href="cart.php"><div class="col-12 mt-4 d-flex maincartimglist  ">
                        
                   
                    <?php
                    require "connection.php";

                    $category_rs = Database::search("SELECT * FROM `category`");
                    $category_num = $category_rs->num_rows;

                    for ($x = 0; $x < $category_num; $x++) {
                        $category_data = $category_rs->fetch_assoc();

                    ?>

<div class="col-2 maincatimg" style="background-image:url( <?php echo $category_data["img"]; ?> )"></div>

                    <?php

                    }

                    ?>

                    
                    </div></a>
                    
                </div> 



                    </div>
                   
                    <div class="bg-text">

          

<div class="col-12 searchbox  d-lg-block  justify-content-center">
    <div class="row mb-2 ">

        

        <div class="col-12 offset-2 col-lg-6">

            <div class="input-group mt-3 mb-3">
                <input type="text" class="form-control" aria-label="Text input with dropdown button" id="basic_search_txt">

                <select class="form-select" style="max-width: 250px;" id="basic_search_select">
                    <option value="0">Categories</option>

                    <?php
                    
                    $category_rss = Database::search("SELECT * FROM `category`");
                    $category_numm = $category_rss->num_rows;

                    for ($x = 0; $x < $category_numm; $x++) {
                        $category_dataa = $category_rss->fetch_assoc();

                    ?>

                        <option value="<?php echo $category_dataa["cat_id"]; ?>"><?php echo $category_dataa["cat_name"]; ?></option>

                    <?php

                    }

                    ?>

                </select>

            </div>

        </div>

        <div class="col-12 col-lg-2 d-grid">
            <button class="btn btn-outline-primary mt-3 mb-3" onclick="basicSearch(0);">Search</button>
        </div>

     
    </div>



                    </div>
                    </div></div>
                    <!-- Carousel -->

                    <?php

                    $c_rs = Database::search("SELECT * FROM `category`");
                    $c_num = $c_rs->num_rows;

                    for ($y = 0; $y < $c_num; $y++) {

                        $c_data = $c_rs->fetch_assoc();

                    ?>

                        
                        <!-- products -->

                        <div class="col-12 mb-3 mt-3">
<div class="row ">

    <div class="col-12">
        <div class="row justify-content-center gap-4">

            <?php

            $product_rs = Database::search("SELECT * FROM `product` WHERE `category_cat_id`='" . $c_data["cat_id"] . "' AND 
        `status_status_id`='1' ORDER BY `datetime_added` DESC LIMIT 4 OFFSET 0");

            $product_num = $product_rs->num_rows;

            for ($z = 0; $z < $product_num; $z++) {
                $product_data = $product_rs->fetch_assoc();
            ?>

                <div class="card item-card-border justify-content-center  col-6 col-lg-2 mt-2 mb-2" style=" height:22em;  padding:0;top:0px;">

                    <?php

                    $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $product_data["id"] . "'");
                    $image_data = $image_rs->fetch_assoc();

                    ?>

                    <img src="<?php echo $image_data["path"]; ?>" class=" item-img-border mb-5 mt-0" style="padding:15px; top:0px; height:16em;" />
                    <div class="card-body ms-0 m-0 intro text-center" style=" padding:15px;">
                    <div class="r">
                        <h5 class="card-title fw-bold fs-6"><?php echo $product_data["title"]; ?></h5>
                        
                        <span class="card-text ">Rs. <?php echo $product_data["price"]; ?> .00</span><br />
                        <?php

                        if ($product_data["qty"] > 0) {

                        ?>

                            <span class="card-text  ">In Stock</span><br />
                            <span class="card-text  "><?php echo $product_data["qty"]; ?> Items Available</span><br /><br /></div>
                            <div class="d-flex" style="margin:none;justify-content:space-between;">
                            
                            <a href='<?php echo "singleProductView.php?id=" . ($product_data["id"]); ?>' class=" btn btn-primary mt-2">Buy Now</a>
                            <button class=" btn btn-dark mt-2" onclick="addToCart(<?php echo $product_data['id'] ?>);">
                                <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                            </button>

                        <?php

                        } else {

                        ?>

                            <span class="card-text text-danger fw-bold"><br />Out of Stock</span><br />
                           <br />
                            <div class="d-flex" style="margin:none;justify-content:space-between;">
                            <button class=" btn btn-primary mt-2 disabled">Buy Now</button>
                            <button class=" btn btn-dark mt-2 disabled">
                                <i class="bi bi-cart-plus-fill text-white fs-5"></i>
                            </button>

                        <?php

                        }
                        if(isset($_SESSION["u"])){
                        $watchlist_rs = Database::search("SELECT * FROM `watchlist` WHERE `product_id`='" . $product_data["id"] . "' AND 
                        `user_email`='" . $_SESSION["u"]["email"] . "'");
                        $watchlist_num = $watchlist_rs->num_rows;

                        if ($watchlist_num == 1) {
                        ?>
                            <button class=" btn btn-outline-light mt-2 border border-primary" 
                            onclick='addToWatchlist(<?php echo $product_data["id"]; ?>); '>
                                <i class="bi bi-heart-fill text-danger fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                            </button>
                        <?php
                        }else{
                            ?>
                            <button class=" btn btn-outline-light mt-2 border border-primary" 
                            onclick='addToWatchlist(<?php echo $product_data["id"]; ?>); '>
                            <i class="bi bi-heart-fill text-dark fs-5" id="heart<?php echo $product_data["id"]; ?>"></i>
                        </button>
                            <?php
                        }}

                        ?>

                            </div>  
                            </div>
                </div>

            <?php
            }

            ?>

        </div>
    </div>

</div>
</div>

                        <!-- products -->

                    <?php

                    }

                    ?>



                </div>
            </div>

            

        </div>
    </div></div>
   
    <script src="bootstrap.bundle.js"></script>
    <script src="https://js.stripe.com/v3/"></script>
    <script src="script.js"></script>

</body>

</html>