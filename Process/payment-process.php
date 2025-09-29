<?php

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $orderId = $_POST["id"];


    $order_details_rs = Database::search("SELECT * FROM `purchase_history` WHERE `u_id` = '" . $_SESSION["u"]["id"] . "' AND `or_id` = '$orderId' AND `status` = '0'");
    if ($order_details_rs->num_rows > 0) {

        $address_rs = Database::search("SELECT * FROM `invoice_address` WHERE `o_id` = '" . $orderId . "' AND `user_id` = '" . $_SESSION["u"]["id"] . "'");
        if ($address_rs->num_rows > 0) {
            $address = $address_rs->fetch_assoc();
            $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $address["city_city_id"] . "'");
            $cityfetch_rs = $city_rs->fetch_assoc();
            $delivery_fee = 700;
            $delivery_fee_cal = Database::search("SELECT * FROM `delivery_fees` WHERE `district_id_del` = '" . $cityfetch_rs["district_district_id"] . "'");
            if ($delivery_fee_cal->num_rows == 1) {
                $delivery = $delivery_fee_cal->fetch_assoc();
                $delivery_fee = $delivery["fee"];
            }

            $city = $cityfetch_rs["city_name"];
            $uaddress = $address["line1"];
            $fname = $_SESSION["u"]["fname"];
            $lname = $_SESSION["u"]["lname"];
            $mobile = $_SESSION["u"]["mobile"];
            $amount = 0;
            $items = $order_details_rs->num_rows;
            for ($x = 0; $order_details_rs->num_rows > $x; $x++) {
                $order_details = $order_details_rs->fetch_assoc();
                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $order_details["p_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                $amount = $amount + ($product_data["price"] * $order_details["qty"]) + $delivery_fee;
            }

            $array;

            $merchant_id = "1224759";
            $merchant_secret = "MzE0MzYyMjQ3ODMzNTQxMTMyNjgyODg2ODcxNDk2MzkyNjY2ODEwOA==";
            $currency = "LKR";

            $hash = strtoupper(
                md5(
                    $merchant_id .
                        $orderId .
                        number_format($amount, 2, '.', '') .
                        $currency .
                        strtoupper(md5($merchant_secret))
                )
            );

            $array["id"] = $orderId;
            $array["item"] = $items;
            $array["amount"] = $amount;
            $array["fname"] = $fname;
            $array["lname"] = $lname;
            $array["mobile"] = $mobile;
            $array["address"] = $uaddress;
            $array["city"] = $city;
            $array["umail"] = $email;
            $array["mid"] = $merchant_id;
            $array["msecret"] = $merchant_secret;
            $array["currency"] = $currency;
            $array["hash"] = $hash;
            $array["uid"] = $_SESSION["u"]["id"];

            echo json_encode($array);
        } else {
            echo "addressNotFound";
        }
    } else {
        echo "orderNotFound";
    }
} else {
    echo ("fail");
}
