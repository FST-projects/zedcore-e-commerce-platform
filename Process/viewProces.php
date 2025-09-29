<?php

include "connection.php";
session_start();

$pid = $_GET["id"];


$product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");

if ($product_rs->num_rows == 1) {
    $product_data = $product_rs->fetch_assoc();

    $view = (int)$product_data["view"] + 1;
    Database::iud("UPDATE `product` SET `view`='" . $view . "' WHERE  `id`= '" . $pid . "'");

    echo ("success");

    if (isset($_SESSION["u"])) {
        Database::iud("INSERT INTO `recommend_product` (`user_id`,`product_id`) VALUES ('" . $_SESSION["u"]["id"] . "','$pid')");
    }
} else {
    echo ("Something went wrong! Product not found!");
}
