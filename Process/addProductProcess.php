<?php

session_start();
include "connection.php";

$email = $_SESSION["u"]["email"];

$category = $_POST["ca"];
$brand = $_POST["b"];
$model = $_POST["m"];
$title = $_POST["t"];
$condition = $_POST["con"];
$color = $_POST["col"];
$qty = $_POST["q"];
$desc = $_POST["de"];
$spec = $_POST["sp"];
$price = $_POST["p"];
$length = sizeof($_FILES);

if (empty($model)) {
    echo ("Select Product model!");
} else if (empty($brand)) {
    echo ("Select Product brand!");
} else if (empty($category)) {
    echo ("Select Product category!");
} else if (empty($color)) {
    echo ("Select Product color!");
} else if (empty($qty) || $qty < 1) {
    echo ("Enter valid Product quantity!");
} else if (empty($condition)) {
    echo ("Select Product condition!");
} else if (empty($title)) {
    echo ("Enter Product Title!");
} else if (empty($desc)) {
    echo ("Enter Product description!");
} else if (empty($spec)) {
    echo ("Enter Product specification!");
} else if ($length == 0) {
    echo ("Insert Product Images!");
} else if (empty($price) || !is_numeric($price)) {
    echo ("Enter valid Product price!");
} else {

    //if category has brand table hasnt any model from brand
    $mhb_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `model_model_id` = '" . $model . "' AND `brand_brand_id` = '$brand'");

    $model_has_brand_id;

    if ($mhb_rs->num_rows > 0) {
        $mhb_data = $mhb_rs->fetch_assoc();
        $model_has_brand_id = $mhb_data["id"];
    } else {
        Database::iud("INSERT INTO `model_has_brand` (`model_model_id`,`brand_brand_id`) VALUES ('" . $model . "','" . $brand . "')");
        $model_has_brand_id = Database::$connection->insert_id;
    }

    //if category has brand table hasnt any brand from category
    $chb_rs = Database::search("SELECT * FROM `category_has_brand` WHERE `category_cat_id` = '" . $category . "' AND `brand_brand_id` = '$brand'");
    if ($chb_rs->num_rows > 0) {
    } else {
        Database::iud("INSERT INTO `category_has_brand` (`category_cat_id`,`brand_brand_id`) VALUES ('" . $category . "','" . $brand . "')");
        Database::iud("INSERT INTO `home_content_manage` (`category_id`,`img1`,`img2`,`img3`,`status`) VALUES ('$category','','','','2')");
    }


    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format("Y-m-d H:i:s");

    $tatus = 1;

    Database::iud("INSERT INTO `product` (`price`,`qty`,`description`,`spec`,`title`,`datetime_added`,`view`,`category_cat_id`,`model_has_brand_id`,`condition_condition_id`,`status_status_id`,`admin_status`,`user_email`) VALUES 
    ('" . $price . "','" . $qty . "','" . $desc . "','" . $spec . "','" . $title . "','" . $date . "','0','" . $category . "','" . $model_has_brand_id . "','" . $condition . "','" . $tatus . "','1','" . $email . "')");

    $product_id = Database::$connection->insert_id;

    //adding brand color
    Database::iud("INSERT INTO `product_has_color` (`product_id`,`color_clr_id`) VALUES ('" . $product_id . "','" . $color . "')");

    $length = sizeof($_FILES);

    if ($length <= 5 && $length > 0) {
        function sanitizeFileName($title)
        {
            return preg_replace('/[^a-zA-Z0-9-_\.]/', '', $title);
        }
        $allowed_extentions = array("image/jpeg", "image/jpg", "image/png", "image/svg+xml","image/webp");
        $title = sanitizeFileName($title);
        for ($x = 0; $x < $length; $x++) {


            if (isset($_FILES["image" . $x])) {

                $img = $_FILES["image" . $x];
                $extention = $img["type"];



                if (in_array($extention, $allowed_extentions)) {
                    $newExtention;

                    if ($extention == "image/jpeg") {
                        $newExtention = ".jpeg";
                    } else if ($extention == "image/jpg") {
                        $newExtention = ".jpg";
                    } else if ($extention == "image/png") {
                        $newExtention = ".png";
                    } else if ($extention == "image/svg+xml") {
                        $newExtention = ".svg";
                    } else if ($extention == "image/webp") {
                        $newExtention = ".webp";
                    }

                    $name = uniqid() . $newExtention;
                    $direct = "ProductPic//" . $title . "_" . $x . "_" . $name;
                    $file_name = "../ProductPic//" . $title . "_" . $x . "_" . $name;

                    if (move_uploaded_file($img["tmp_name"], $file_name)) {
                        Database::iud("INSERT INTO `product_img` (`img_path`,`product_id`) VALUES ('" . $direct . "','" . $product_id . "')");
                    }
                } else {
                    echo ("File format not supported!");
                }
            }
        }
        echo ("success");
    } else {
        echo ('Number of images must be between 1 and 5');
    }
}
