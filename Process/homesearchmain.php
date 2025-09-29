<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $user_ses = $_SESSION["u"];
}

$search_txt = $_POST["s"];

$all_product_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id`=`product`.`model_has_brand_id` WHERE `title` LIKE '%{$search_txt}%' LIMIT 6");
if ($all_product_rs->num_rows > 0) {
    for ($x = 0; $x < $all_product_rs->num_rows; $x++) {
        $all_product_data = $all_product_rs->fetch_assoc();


?>
        <div id="resultcard" class="resultcard " onclick="choseProd(<?php echo $all_product_data['model_model_id'] ?>);">
            <?php echo $all_product_data["title"] ?>
        </div>

    <?php
    }
} else {
    ?>
    <div id="resultcard" class="resultcard ">
        Product not Found!
    </div>
<?php
}



?>