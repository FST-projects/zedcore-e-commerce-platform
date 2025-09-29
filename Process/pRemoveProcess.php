<?php

include "connection.php";

session_start();
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pid = $_POST["pid"];

    $user_qty_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "' AND `product_id` = '" . $pid . "'");
    $user_qty = $user_qty_rs->fetch_assoc();

    if ($user_qty_rs->num_rows == 1) {

        Database::iud("DELETE FROM `cart` WHERE `user_id` = '" . $email . "' AND `cart_id` = '" . $user_qty["cart_id"] . "'");
        echo ("success");

    }
} else {
    echo("Something went wrong. Try relogin!");
}
