<?php

require "connection.php";

if(isset($_GET["id"])){

    $wid = $_GET["id"];

    $w_rs = Database::search("SELECT * FROM `watchlist` WHERE `w_id`='".$wid."'");
    $w_data = $w_rs->fetch_assoc();

    $umail = $w_data["user_email"];
    $pid = $w_data["product_id"];

   
    Database::iud("DELETE FROM `watchlist` WHERE `w_id`='".$wid."'");

    echo ("Product has been removed");

}else{
    echo ("something went wrong");
}

?>