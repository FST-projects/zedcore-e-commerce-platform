<?php

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $pid = $_POST["pid"];




    $city_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'"); 

    if ($city_rs->num_rows == 1) {


        $city_data = $city_rs->fetch_assoc();

        $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");
        $product_data = $product_rs->fetch_assoc();


        if ($product_data["qty"] > 0) {
            $user_cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "' AND  `product_id` = '$pid' ");
            $user_cart = $user_cart_rs->fetch_assoc();

            if (isset($user_cart["user_qty"]) && !$user_cart["user_qty"] == null) {
                $qty = $user_cart["user_qty"];
            }


            if (isset($_POST["qty"]) && $_POST["qty"] > 0) {
                if ($_POST["qty"] <= $product_data["qty"]) {
                    $qty = $_POST["qty"];
                } else {
                    $qty = $product_data["qty"];
                }
            }

            $order_id = uniqid();
            Database::iud("INSERT INTO `purchase_history` (`p_id`,`or_id`,`u_id`,`qty`,`status`) VALUES ('" . $product_data["id"] . "','" . $order_id . "','" . $_SESSION["u"]["id"] . "','$qty','0')");
            Database::iud("INSERT INTO `invoice_address` (`o_id`,`city_city_id`,`line1`,`postal_code`,`user_id`) VALUES ('$order_id','" . $city_data['city_city_id'] . "','" . $city_data['line1'] . "','" . $city_data['postal_code'] . "','" . $_SESSION["u"]["id"] . "')");
            echo ($order_id);
        } else {
            echo ($order_id);
        }


    } else {
        echo ("noaddress");
    }
} else {
    echo ("fail");
}
