<!DOCTYPE html>

<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="bootstrap.css" />
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="style2.css" />
     <script>window.onscroll = function() {scrollFunction()};</script>
    
</html>

</head>

<body >
<div id="navbar"  >
 
        <?php

        session_start();

        if (isset($_SESSION["u"])) {

            $data = $_SESSION["u"];

        ?>
 
          <span class="blueline text-lg-start "  > <a class="a" href="userProfile.php"><b>Welcome </b><?php echo $data["fname"]; ?> |</a></span>
           <span class="text-lg-start  a signout" onclick="signout();">Sign Out</span>
        <?php

        } else {

        ?>

            <a style="background-color:inherit;" href="home.php" class="text-decoration-none fw-bold a">Sign In or Register</a>

        <?php

        }

?>

<div id="navbar-right" class="dropdown  d-lg-none d-md-none d-block  ">
  <button class="btn btn-secondary " type="button" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fa-solid fa-circle-chevron-down"></i>
  </button>
  <ul class="dropdown-menu">
    <li><a class="blueline a" href="index.php">Home</a></li>
    <li><a class="blueline a" onclick="closeNav2()" href="cart.php">Cart</a></li>
    <li><a class="blueline a" onclick="closeNav2()" href="watchlist.php">Watchlist</a></li>
    <li><a class="blueline a" onclick="closeNav2()" href="my-order.php">Orders</a></li>
    <li><a class="blueline a" onclick="closeNav2()" href="userProfile.php">My Profile</a></li>
  </ul>
</div>

  <div id="navbar-right" class="d-lg-block d-md-block d-none " >
    <a class="blueline a" href="index.php">Home</a>
    <a class="blueline a" onclick="closeNav2()" href="cart.php">Cart</a>
   
    <a class="blueline a" onclick="closeNav2()" href="my-order.php">Orders</a>
    <a class="blueline a" onclick="closeNav2()" href="watchlist.php">Watchlist</a>
    <a class="blueline a" onclick="closeNav2()" href="userProfile.php">My Profile</a>
    
    
    <div id="myNav" class="overlay">
    <a href="javascript:void(0)" class="closebtn a btn btn-light" onclick="closeNav()">&times;</a>
    <div class="overlay-content"><ul>
    <a style="background-color:inherit;" href="#"><li class="aa " >About</li></a>
    <a style="background-color:inherit;" href="#"><li class="aa" >Services</li></a>
    <a style="background-color:inherit;" href="#"><li class="aa" >Clients</li></a>
    <a style="background-color:inherit;" href="#"><li class="aa" >Contact Us</li></a>
    </ul>
    </div>
    </div>
    <a class="aa blueline a" href="#about"  onclick="openNav(),closeNav2()">Help</a>
  </div>

  

</div>





  



<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>

<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
<script src="script.js"></script>
<script src="bootstrap.js"></script>
</body>
</html>