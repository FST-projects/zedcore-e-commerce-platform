<?php

include "connection.php";

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];

    $product_rs = Database::search("SELECT *,product.id AS prodid FROM `product` INNER JOIN category ON category.cat_id = product.category_cat_id INNER JOIN model_has_brand ON model_has_brand.id = product.model_has_brand_id INNER JOIN brand ON brand.brand_id = model_has_brand.brand_brand_id INNER JOIN model ON model.model_id = model_has_brand.model_model_id INNER JOIN shop ON shop.seller_id = product.user_email WHERE `product`.`id` = '" . $pid . "'");
    $product_data = $product_rs->fetch_assoc();

    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '".$product_data["prodid"]."'");
    $product_img = $product_img_rs->fetch_assoc();

    

    $added_date = explode(" ",$product_data["datetime_added"]);

    if ($product_rs->num_rows == 1) {
?>
        <i class="close icon"></i>
        <div class="header">
            <?php echo $product_data["title"]; ?>
        </div>
        <?php
        ?>
        <div class="image content">
            <div class="ui medium image">
                <img src="<?php echo $product_img["img_path"] ?>">
            </div>
            <div class="description">
                <div class="modeldescrip">
                    <span class="outfit" style="font-size: 20px; font-weight: 500;">Name : </span><span style="font-size: 18px;"><?php echo $product_data["title"] ?></span>
                </div>
                <div class="modeldescrip">
                    <span class="outfit" style="font-size: 20px; font-weight: 500;">Category : </span><span style="font-size: 18px;"><?php echo $product_data["cat_name"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span class="outfit" style="font-size: 20px; font-weight: 500;">Brand : </span><span style="font-size: 18px;"><?php echo $product_data["brand_name"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">model : </span><span style="font-size: 18px;"><?php echo $product_data["model_name"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Product added Date : </span><span style="font-size: 18px;"><?php echo $added_date["0"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Shop : </span><span style="font-size: 18px;"><?php echo $product_data["shop_name"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Price : </span><span style="font-size: 18px; color: red;">LKR <?php echo $product_data["price"]; ?>.00</span>
                </div>
            </div>
        </div>
        <div class="actions">
            <div style="position: absolute; height: 35px; display: flex; align-items: center; align-content: center;">
                <div class="ui star rating" data-rating="4" data-max-rating="5"></div>
                <span></span>
            </div>
            <div class="ui black deny button">
                Close
            </div>
        </div>

<?php
    }
} else {
    echo ("Something went wrong! please reload and try again.");
}

?>