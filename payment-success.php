<?php

require "connection.php";


session_start();

$products = $_SESSION['cart_products'];
$num = count($products);


$unique_id = $_SESSION['unique_id'];
date_default_timezone_set('Asia/Colombo');

$currentDateTime = date('Y-m-d H:i:s');
echo($_SESSION["u"]["email"]);
Database::iud("DELETE FROM cart WHERE cart.user_email='" .$_SESSION["u"]["email"]. "';");

Database::iud("INSERT IGNORE  INTO `order` (id,user_email,date,status) VALUES ('" . $unique_id . "','" .$_SESSION["u"]["email"]. "','" . $currentDateTime . "','pending')");
for ($x = 0; $x < $num; $x++) {
    $d = $products[$x];
    Database::iud("INSERT IGNORE INTO order_product( order_id,product_id,quantity) VALUES ( '" . $unique_id . "','" . $d['id'] . "','" . $d['amount'] . "')");
}

Database::$connection->commit();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Success</title>

  
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@700&family=Raleway:wght@300;400;600;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="Resources/logo.svg">


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</head>

<body class="" style="overflow:hidden; ">



    <div class="product-container">
        <div class="Sproduct " style="background-color:#bde6fae4 ;padding-bottom:20;">
            <div class="" style="min-height:100vh;">
            <div class="d-lg-flex justify-content-lg-center   " style="margin: 0; padding: 0;">
            <div class="row offset-lg-1 col-lg-11 col-md-12  col-12 product-dis d-md-flex justify-content-md-center py-4 wrapper2 mt-5" style="padding: 0;margin: 0;">
                <h2 style="font-size:30px;text-align:center" class="my-4 text-primary">Order Placed </h2>

                <div class="d-flex justify-content-center my-5"><svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="200" height="200" viewBox="0 0 40 40">
                        <path fill="#bae0bd" d="M20,38.5C9.8,38.5,1.5,30.2,1.5,20S9.8,1.5,20,1.5S38.5,9.8,38.5,20S30.2,38.5,20,38.5z"></path>
                        <path fill="#5e9c76" d="M20,2c9.9,0,18,8.1,18,18s-8.1,18-18,18S2,29.9,2,20S10.1,2,20,2 M20,1C9.5,1,1,9.5,1,20s8.5,19,19,19	s19-8.5,19-19S30.5,1,20,1L20,1z"></path>
                        <polyline fill="none" stroke="#fff" stroke-miterlimit="10" stroke-width="3" points="11.2,20.1 17,25.9 30.2,12.7"></polyline>
                    </svg>
                </div>

                <div style="font-size:30px;text-align:center">Order ID : <?php echo ($unique_id); ?></div>

                <div class="d-flex justify-content-center py-2 gap-4">
                    <a href="invoice.php?id=<?php echo($unique_id);?>" class="btn bg-primary " style=" ;color:white">
                        
                        

                            Download Invoice
                        
                    </a>
                    <a href="home.php" class="btn bg-secondary " style=" ;color:white">
                        
                        

                        Home
                    
                </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://js.stripe.com/v3/"></script>
    <script src="script.js"></script>



</body>

</html>