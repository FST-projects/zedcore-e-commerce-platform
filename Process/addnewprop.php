<?php

include "connection.php";

if (!empty($_POST["mv"]) && !empty($_POST["mn"])) {
    $model_id = $_POST['mv'];
    $model_name = $_POST['mn'];

    $all_model_rs = Database::search("SELECT * FROM `model` WHERE `model_name` = '" . $model_name . "'");


    if ($all_model_rs->num_rows == 0) {
        Database::iud("INSERT INTO `model` (`model_id`,`model_name`) VALUES ('$model_id','$model_name')");
        echo ("success");
    } else {
        echo ("success");
    }
}
if (!empty($_POST["bv"]) && !empty($_POST["bn"])) {
    $brand_id = $_POST['bv'];
    $brand_name = $_POST['bn'];

    $all_brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_name` = '" . $brand_name . "'");

    if ($all_brand_rs->num_rows == 0) {
        Database::iud("INSERT INTO `brand` (`brand_id`,`brand_name`) VALUES ('$brand_id','$brand_name')");
        echo ("success");
    } else {
        echo ("success");
    }
}


if (!empty($_POST["catv"]) && !empty($_POST["catn"])) {
    $cat_id = $_POST['catv'];
    $cat_name = $_POST['catn'];

    $all_cat_rs = Database::search("SELECT * FROM `category` WHERE `cat_name` = '" . $cat_name . "'");

    if ($all_cat_rs->num_rows == 0) {
        Database::iud("INSERT INTO `category` (`cat_id`,`cat_name`) VALUES ('$cat_id','$cat_name')");
        $home_rs = Database::search("SELECT * FROM `home_content_manage` WHERE `category_id` = '$cat_id'");
        if ($home_rs->num_rows == 0) {
            Database::iud("INSERT INTO `home_content_manage` (`category_id`,`img1`,`img2`,`img3`,`status`) VALUES ('$cat_id','','','','2')");
        }
        echo ("success");
    } else {
        echo ("success");
    }
}
if (!empty($_POST["cv"]) && !empty($_POST["cn"])) {
    $clr_id = $_POST['cv'];
    $clr_name = $_POST['cn'];


    $all_clr_rs = Database::search("SELECT * FROM `color` WHERE `clr_name` = '" . $clr_name . "'");

    if ($all_clr_rs->num_rows == 0) {
        Database::iud("INSERT INTO `color` (`clr_id`,`clr_name`) VALUES ('$clr_id','$clr_name')");
        echo ("success");
    } else {
        echo ("success");
    }
}
