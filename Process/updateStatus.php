<?php

session_start();

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];



    if (isset($_GET["id"])) {
        $id = $_GET["id"];
        include "connection.php";

        $user_product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $id . "' AND `user_email` = '" . $email . "'");

        if ($user_product_rs->num_rows == 1) {

            $user_product_data = $user_product_rs->fetch_assoc();

            if ($user_product_data["status_status_id"] == 1) {
                Database::iud("UPDATE `product` SET `status_status_id` ='2' WHERE `id` = '" . $id . "' AND `user_email` = '" . $email . "'");
                echo("success");
            } else if ($user_product_data["status_status_id"] == 2) {
                Database::iud("UPDATE `product` SET `status_status_id` ='1' WHERE `id` = '" . $id . "' AND `user_email` = '" . $email . "'");
                echo("success");
            }
        } else if ($user_product_rs->num_rows == 0) {
            echo ("Access denied! Please contact zedcore assistance! ");
        }
    } else {
        echo ("Please select an item to activate or deactivate!");
    }
} else {
    echo ("We are unable to find you! Please try relogin.");
}
