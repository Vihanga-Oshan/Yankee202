<?php
require "connection.php";

if (empty($_SESSION["u"])) {
    $_SESSION["u"] = "";
}
$total = 0;
$subtal = 0;
$shipping = 0;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="single-product.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    
    <link rel="icon" href="Resources/logo.svg">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <title>Cart</title>
</head>

<body class="bodytop " style="overflow-x: hidden;" onload="finalsubcal();">
    <?php include "header.php" ?>
    <div class="product-container" style="background-color:#bde6fae4;"></div>
    <div class="Sproduct " style="background-color:#bde6fae4 ;padding-bottom:20;">
        <div class="" style="min-height:100vh;">
            <div class="d-lg-flex justify-content-lg-center  " style="margin: 0; padding: 0;">
                <div class="row offset-lg-1 col-lg-11 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4 wrapper2 mt-3" style="padding: 0;margin: 0;">
                    <?php

                    if (isset($_SESSION["u"])) {
                    ?>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-12  bodere" style="height: 70vh;overflow-y: scroll;">
                            <div class="row" style="font-size: 12px;border-bottom: solid 0.25px rgba(128, 128, 128, 0.46);">
                                <div class="col-2"></div>
                                <div class="col-3">
                                    <p>Product</p>
                                </div>
                                <div class="col-2">
                                    <p>Price</p>
                                </div>
                                <div class="col-2">
                                    <p>Amount</p>
                                </div>
                                <div class="col-2">
                                    <p>Subtotal</p>
                                </div>
                                <div class="col-1"></div>
                            </div>
                            <?php

                            if (isset($_SESSION["u"])) {
                            ?>

                                <div id="cart-empty-msg" style="width: 100%;height:80%;text-align:center;letter-spacing: 2px;" class="d-flex justify-content-center align-items-center d-none">

                                    Cart Is Empty

                                </div> <?php
                                    } else {
                                        ?>

                                <div class="d-flex justify-content-center align-items-center flex-column" style="height:80%;">
                                    <div class="d-flex justify-content-center flex-column  align-items-center">
                                           <!-- Empty View -->

                                    <div class="col-12">
                                        <div class="row">
                                            <div class="col-12 emptyCart"></div>
                                            <div class="col-12 text-center mb-2">
                                                <label class="form-label fs-1 fw-bold">
                                                    You have no items in your Cart yet.
                                                </label>
                                            </div>
                                            <div class="offset-lg-4 col-12 col-lg-4 mb-4 d-grid">
                                                <a href="home.php" class="btn btn-outline-info fs-3 fw-bold">
                                                    Start Shopping
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Empty View -->



                                    </div>
                                    <div>
                                    <button class="btn btn-primary">Sign in to your account

                                        </button>
                                    </div>

                                </div>
                            <?php

                                    }
                            ?>




                            <?php
                            if (isset($_SESSION["u"])) {
                                $cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_email`='" . $_SESSION["u"]["email"] . "'");
                                $cart_num = $cart_rs->num_rows;

                                if (!$cart_num == 0) {

                        

                                

                                    for ($x = 0; $x < $cart_num; $x++) {
                                        $cart_data = $cart_rs->fetch_assoc();

                                        $product_rs = Database::search("SELECT * FROM `product` WHERE `id`='" . $cart_data["product_id"] . "'");
                                        $product_data = $product_rs->fetch_assoc();

                                        $total = $total + ($product_data["price"] * $cart_data["cart_qty"]);



                                        $seller_rs = Database::search("SELECT * FROM `user` WHERE `email`='" . $product_data["user_email"] . "'");
                                        $seller_data = $seller_rs->fetch_assoc();
                                        $seller = $seller_data["fname"] . " " . $seller_data["lname"];

                                        $image_rs = Database::search("SELECT * FROM `images` WHERE `product_id`='" . $cart_data["product_id"] . "'");
                                        $image_num = $image_rs->num_rows;
                                        $img = array();

                                        if ($image_num != 0) {

                                            for ($z = 0; $z < $image_num; $z++) {
                                                $image_data = $image_rs->fetch_assoc();
                                                $img[$z] = $image_data["path"];



                                    ?>


                                                <div class="row mt-3" style="font-size: 16px; font-family: 'Lato', sans-serif; " id="cart-con-<?php echo ($cart_data['cart_id']); ?>">
                                                    <div class="col-2 pt-2">
                                                        <div class="cart-img" style="background-image: url(<?php echo ($img[$z]) ?>);"></div>
                                                    </div>
                                                    <div class="col-3 pt-2">
                                                        <p><?php echo $product_data["title"]; ?></p>
                                                    </div>
                                                    <div class="col-2 pt-2">
                                                        <p><?php echo ($product_data['price']); ?></p>
                                                    </div>
                                                    <div class="col-2 pt-1"><input id="cart-amount-<?php echo ($cart_data['cart_id']); ?>" type="number" class="form-control" min="1" value="<?php echo ($cart_data['cart_qty']); ?>" style="width: 50%;" onchange="updateSubTotal('<?php echo ($product_data['price']); ?>','<?php echo ($cart_data['cart_id']); ?>');"></div>
                                                    <div class="col-2 pt-2">
                                                        <p id="cart-sub-<?php echo ($cart_data['cart_id']); ?>" class="subtotals"><?php echo ((int)$product_data['price'] * (int)$cart_data['cart_qty']); ?></p>
                                                    </div>
                                                    <div class="col-1 pt-2"><button class="btn btn-close" onclick="deleteFromCart(<?php echo $cart_data['cart_id']; ?>);"></button></div>
                                                </div>
                            <?php
                                            }
                                        }
                                    }
                                }
                            }
                            ?>



                        </div>

                </div>
            </div>

            <!-- summary -->
            <div class="row offset-lg-2 col-lg-8 col-md-12 col-12 product-dis d-md-flex justify-content-md-center py-4 wrapper2 mt-5  ">
                <div class="row">

                    <div class="col-12">
                        <label class="form-label fs-3 ">Summary</label>
                    </div>



                    <div class="total-price">
                        <table class="col-3" ><tr>
                                <td>Subtotal </td>
                                <td id="final-total">$200.00</td>
                            </tr>
                            <tr>
                                <td>Tax </td>
                                <td id=""> LKR 00.00</td>
                            </tr>
                        </table>
                    </div>


                    <div class="col-6 mt-2">
                        <span class="fs-4 fw-bold">Total</span>
                    </div>

                    <div class="col-6 mt-2 text-end">
                        <span id="final-sub" class="fs-4 fw-bold">0.00</span>
                    </div>

                    <div class="col-12 mt-3 mb-3 d-grid">
                        <button class="btn btn-primary fs-5 fw-bold" onclick="checkout();">CHECKOUT</button>
                    </div>

                </div>
            </div>
            <!-- summary --><?php
                        } else {
                            ?>
            <div class="d-flex justify-content-center align-items-center flex-column" style="height:70vh;">
                <div class="d-flex justify-content-center flex-column  align-items-center">
                    <img src="./images/emptycart.svg" style="width:80%" />
                    <h3 class="py-3 text-align-center">
                        <b>Your Cart is empty</b>
                    </h3>



                </div>
                <div>
                    <a href="index.php" style="text-decoration: none;">
                        <button class="btn btn-primary">Sign in to your account

                        </button>
                    </a>
                </div>

            </div>


        <?php

                        }
        ?>
        </div>





    </div>
    </div>
    <?php include "footer.php" ?>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe("pk_test_51PMyUGDLRGeC8WnLlqb9MTEYJc9qg1VQ6niJUKLChFHtg9QKpa2TTLvgqd2dxbotDMCpPcMGCxoVvqPfyfNdKtl300KkBmH0Ss");

        async function checkout() {

            const fetchClientSecret = async () => {
                const response = await fetch('./create-checkout-session.php', {
                        method: 'POST',
                    })
                    .then(function(response) {
                        return response.json();
                    })
                    .then(function(session) {
                        return stripe.redirectToCheckout({
                            sessionId: session.sessionId
                        });
                    })
                    .then(function(result) {
                        if (result.error) {
                            alert(result.error.message);
                        }
                    })
                    .catch(function(error) {
                        console.error('Error:', error);
                    });



            };

            fetchClientSecret();


        }
    </script>
    <script src="script.js"></script>


</body>

</html>