<?php

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];



    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");  //get user address

    if ($city_rs->num_rows == 1) {


        $city_data = $city_rs->fetch_assoc();

        $user_cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "' AND  `tik` = '1' ");

        if ($user_cart_rs->num_rows > 0) {

            $order_id = uniqid();
            Database::iud("INSERT INTO `invoice_address` (`o_id`,`city_city_id`,`line1`,`postal_code`,`user_id`) VALUES ('$order_id','" . $city_data['city_city_id'] . "','" . $city_data['line1'] . "','" . $city_data['postal_code'] . "','" . $_SESSION["u"]["id"] . "')");

            for ($x = 0; $user_cart_rs->num_rows  > $x; $x++) {
                $user_cart = $user_cart_rs->fetch_assoc();

                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $user_cart["product_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                if ($product_data["qty"] > 0) {

                    Database::iud("INSERT INTO `purchase_history` (`p_id`,`or_id`,`u_id`,`qty`,`status`) VALUES ('" . $product_data["id"] . "','" . $order_id . "','" . $_SESSION["u"]["id"] . "','" . $user_cart["user_qty"] . "','0')");
                }
            }
            echo ($order_id);
        }
    } else {
        echo ("noAddress");
    }
} else {
    echo ("fail");
}
