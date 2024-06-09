<?php
 include "header.php";
require "connection.php";



    $pid = $_GET["id"];

    $product_rs = Database::search("SELECT product.id,product.price,product.qty,product.description,product.title,
    product.datetime_added,product.delivery_fee_colombo,product.delivery_fee_other,product.category_cat_id,
    product.model_has_brand_id,product.condition_condition_id,product.status_status_id,product.user_email,product.color_clr_id,
    model.model_name AS mname,brand.brand_name AS bname FROM `product` INNER JOIN `model_has_brand` ON 
    model_has_brand.model_model_id=product.model_has_brand_id INNER JOIN `brand` ON brand.brand_id=model_has_brand.brand_brand_id 
    INNER JOIN `model` ON model.model_id=model_has_brand.model_model_id WHERE product.id='" . $pid . "'");

    $product_num = $product_rs->num_rows;
    $product_data = $product_rs->fetch_assoc();



                                            $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $pid . "'");
                                            $image_num = $image_rs->num_rows;
                                            $img = array();

                                            if ($image_num != 0) {

                                                for ($x = 0; $x < $image_num; $x++) {
                                                    $image_data = $image_rs->fetch_assoc();
                                                    $img[$x] = $image_data["path"];
                                            
                                                }
                                            } 
                                                ?>

       
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">

            <title><?php echo $product_data["title"]; ?> | eShop</title>

            <link rel="stylesheet" href="bootstrap.css" />
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
            <link rel="stylesheet" href="single-product.css" />
            <link rel="stylesheet" href="style.css" />

            <link rel="icon" href="resource/logo.svg" />
        </head>

        <body style="background-color:#71DAF1;">

        <div class="product-container bodytop" ></div>
    <div class="Sproduct" >
        <div class="" >
            <div class="d-lg-flex justify-content-lg-center " style="margin: 0; padding: 0;">
                <div class="row offset-lg-1 col-lg-10 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4"
                    style="padding: 0;margin: 0;">
                    <div class="col-12 col-sm-12 col-md-6 col-lg-6 bodere">
                        <div class="image1" style="background-image: url(<?php echo($img[0]);?>);"></div>
                        

                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
                        <nav class="pb-5" style="border-bottom:solid 0.5px rgba(128, 128, 128, 0.23);">
                            <ol class="breadcrumb pt-5 ">
                                <li class="breadcrumb-item "><a href="#"
                                        style="color: rgb(120, 117, 117);text-decoration: none;">Home</a></li>
                                <li class="breadcrumb-item "><a href="#"
                                        style="color: rgb(120, 117, 117);text-decoration: none;">Store</a></li>
                                <li class="breadcrumb-item active" style="color: rgb(120, 117, 117);"><?php echo($product_data["title"]);?>
                                </li>
                            </ol>
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <h5 class="product-head"><?php echo($product_data["title"]);?></h5>
                                </div>
                                <div class="col-6 col-sm-12 col-md-6 col-lg-6 ">
                                    <H5 style="font-weight: 800;font-family: 'Lato', sans-serif;color: rgb(198, 33, 33);
                                ">LKR <?php echo($product_data["price"]);?></H5>
                                    <div class="d-flex flex-row">
                                        <label class="pt-2 pe-1" style="font-size: 14px;">Amount: </label>
                                        <input type="number" min="1" step="1" value="1" class="form-control "
                                            style="width: 30%; height: 30%;" id="amount-product">
                                    </div>
                                    <button class="btn btn-success mt-2" onclick="addToCart(<?php echo $product_data['id'] ?>);">ADD TO CART</button>
                                </div>

                            </div>
                        </nav>
                        <div>
                            <h4 class="py-3">Description :</h4>
                            <P style="font-size: 13px;">
                            <?php echo($product_data["description"]);?>
                            </P>
                        </div>

                    </div>

                </div>
            </div>





        </div>
    </div>
   
<?php include "footer.php"?>
<script src="script.js"></script>
        </body>

        </html>

