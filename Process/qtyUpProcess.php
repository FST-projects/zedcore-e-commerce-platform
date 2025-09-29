<?php

include "connection.php";

session_start();
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pid = $_POST["pid"];

    $product_qty_rs = Database::search("SELECT `qty` FROM `product` WHERE  `id`='" . $pid . "'");
    $product_qty = $product_qty_rs->fetch_assoc();

    $user_qty_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "' AND `product_id` = '" . $pid . "'");
    $user_qty = $user_qty_rs->fetch_assoc();

    if (isset($user_qty["user_qty"])) {
        $uqty = $user_qty["user_qty"];
        $uqty = (int)$uqty + 1;
    } else {
        $uqty = 1;
    }

    if ($user_qty_rs->num_rows == 1) {
        if ($uqty <= ($product_qty["qty"])) {

            Database::iud("UPDATE `cart` SET `user_qty` = '" . $uqty . "' WHERE `user_id` = '" . $email . "' AND `cart_id` = '" . $user_qty["cart_id"] . "'");
            echo ("success");
        }
    }
} else {
    echo("Something went wrong. Try relogin!");
}
