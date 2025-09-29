<?php

include "connection.php";
$id =  $_POST["id"];
session_start();

if (isset($_SESSION['u'])) {
    $email = $_SESSION["u"]["email"];

    $tik_rs = Database::search("SELECT `tik` FROM `cart` WHERE `user_id` = '" . $email . "' AND  `product_id`='" . $id . "' ");
    $tik = $tik_rs->fetch_assoc();

    if ($tik["tik"] == 0) {
        Database::iud("UPDATE `cart` SET `tik` = '1' WHERE `user_id` = '" . $email . "' AND  `product_id`='" . $id . "' ");
    } else if ($tik["tik"] == 1) {
        Database::iud("UPDATE `cart` SET `tik` = '0' WHERE `user_id` = '" . $email . "' AND  `product_id`='" . $id . "' ");
    }

    $user_city = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '$email'");
    $user_city = $user_city->fetch_assoc();
    $city_rs_del = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $user_city["city_city_id"] . "'");
    $cityfetch_rs_del = $city_rs_del->fetch_assoc();
    $delivery_fee_district = 700;
    $delivery_fee_cal = Database::search("SELECT * FROM `delivery_fees` WHERE `district_id_del` = '" . $cityfetch_rs_del["district_district_id"] . "'");
    if ($delivery_fee_cal->num_rows == 1) {
        $delivery = $delivery_fee_cal->fetch_assoc();
        $delivery_fee_district = $delivery["fee"];
    }

    $user_cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "' AND  `tik` = '1' ");

    $TP = 0;
    $DP = 0;

    $items = 0;


    if ($user_cart_rs->num_rows > 0) {
        $items = $user_cart_rs->num_rows;
        for ($x = 0; $user_cart_rs->num_rows  > $x; $x++) {
            $user_cart = $user_cart_rs->fetch_assoc();

            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $user_cart["product_id"] . "'");
            $product_data = $product_rs->fetch_assoc();

            $TP = $TP + $user_cart["user_qty"] * $product_data["price"];
        }

        $DP = $delivery_fee_district * $user_cart_rs->num_rows;

        $TT = (int)$TP + (int)$DP;

        $array["totItems"] = $items;
        $array["price"] = $TP;
        $array["del"] = $DP;
        $array["total"] = $TT;

        echo json_encode($array);
    } else if ($user_cart_rs->num_rows == 0) {
        $array["totItems"] = 0;
        $array["price"] = 0;
        $array["del"] = 0;
        $array["total"] = 0;

        echo json_encode($array);
    }
}
