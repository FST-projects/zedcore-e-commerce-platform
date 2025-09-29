<?php

session_start();

include "connection.php";
if (isset($_SESSION["u"])) {
    $email = $_SESSION['u']["email"];

    if (isset($_GET["id"])) {

        $product_id = $_GET["id"];

        $product_details_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $product_id . "' AND `user_email` = '" . $email . "'");

        if ($product_details_rs->num_rows == 1) {
            $product_details_data = $product_details_rs->fetch_assoc();
            $_SESSION["p"] = $product_details_data;
            echo("success");

        } else {
            echo ("Something went wrong! Please try again later.");
        }
    } else {
        echo ("Something went wrong! Please try again later.");
    }
} else {
    header("Location: ../index.php");
}
