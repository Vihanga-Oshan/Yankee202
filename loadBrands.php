<?php

require "connection.php";

if (isset($_GET["c"])) {

    $category_id = $_GET["c"];

    
    $brand_rs = Database::search("SELECT * FROM `brand` WHERE `category_cat_id`='" . $category_id . "'");
    $brand_num = $brand_rs->num_rows;

    for ($x = 0; $x < $brand_num; $x++) {
        $brand_data = $brand_rs->fetch_assoc();

?>

        <option value="<?php echo $brand_data["brand_id"]; ?>"><?php echo $brand_data["brand_name"]; ?></option>

<?php

    }
}

?>