<?php

require "connection.php";

$txt = $_POST["t"];
$select = $_POST["s"];

$query = "SELECT * FROM `product`";

if (!empty($txt) && $select == 0) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%'";
} else if (empty($txt) && $select != 0) {
    $query .= " WHERE `category_cat_id`='" . $select . "'";
} else if (!empty($txt) && $select != 0) {
    $query .= " WHERE `title` LIKE '%" . $txt . "%' AND `category_cat_id`='" . $select . "'";
}

?>

<div class="row">
    <div class="offset-lg-1 col-12 col-lg-10 text-center">
        <div class="row">

            <?php


            if ("0" != ($_POST["page"])) {
                $pageno = $_POST["page"];
            } else {
                $pageno = 1;
            }

            $product_rs = Database::search($query);
            $product_num = $product_rs->num_rows;

          

            for ($x = 0; $x < $product_num; $x++) {
                $selected_data = $product_rs->fetch_assoc();

            ?>

                <div class="card" style="width: 18rem;">
                    <img src="resource/mobile_images/iphone12.jpg" class="card-img-top" />
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $selected_data["title"] ?></h5>
                        <p class="card-text"><?php echo $selected_data["description"] ?></p>
                        <a href="#" class="btn btn-primary">Go somewhere</a>
                    </div>
                </div>

            <?php

            }
            ?>

            

        </div>
    </div>
   
</div>