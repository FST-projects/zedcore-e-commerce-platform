<?php

include "connection.php";

if (!empty($_POST["mv"])) {
    $model_id = $_POST['mv'];

    $all_model_rs = Database::search("SELECT * FROM `model` WHERE `model_id` = '" . $model_id . "'");


    if ($all_model_rs->num_rows == 1) {
        Database::iud("DELETE FROM `model` WHERE `model_id` = '".$model_id."'");
        echo ("success");
    } else {
        echo ("success");
    }
}
if (!empty($_POST["bn"])) {
    $brand_id = $_POST['bn'];

    $all_brand_rs = Database::search("SELECT * FROM `brand` WHERE `brand_id` = '" . $brand_id . "'");

    if ($all_brand_rs->num_rows == 1) {
        Database::iud("DELETE FROM `brand` WHERE `brand_id` = '".$brand_id."'");
        echo ("success");
    } else {
        echo ("success");
    }
}


if (!empty($_POST["catn"])) {
    $cat_id = $_POST['catn'];

    $all_cat_rs = Database::search("SELECT * FROM `category` WHERE `cat_id` = '" . $cat_id . "'");

    if ($all_cat_rs->num_rows == 1) {
        Database::iud("DELETE FROM `category` WHERE `cat_id` = '".$cat_id."'");
        echo ("success");
    } else {
        echo ("success");
    }
}
if (!empty($_POST["cn"])) {
    $clr_id = $_POST['cn'];


    $all_clr_rs = Database::search("SELECT * FROM `color` WHERE `clr_id` = '" . $clr_id . "'");

    if ($all_clr_rs->num_rows == 1) {
        Database::iud("DELETE FROM `color` WHERE `clr_id` = '".$clr_id."'");
        echo ("success");
    } else {
        echo ("success");
    }
}


