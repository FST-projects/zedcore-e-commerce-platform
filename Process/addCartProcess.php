<?php
include "connection.php";

session_start();



if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $pid = $_GET["pid"];

    $user_rs = Database::search("SELECT  * FROM `user` WHERE `email` = '" . $email . "'");
    if ($user_rs->num_rows == 1) {

        $product_qty_rs = Database::search("SELECT `qty` FROM `product` WHERE  `id`='" . $pid . "' ");
        $product_qty = $product_qty_rs->fetch_assoc();

        $user_qty_rs = Database::search("SELECT `user_qty` FROM `cart` WHERE `user_id` = '" . $email . "' AND `product_id` = '" . $pid . "'");

        if ($user_qty_rs->num_rows == 1) {
            $user_qty = $user_qty_rs->fetch_assoc();

            $uqty = $user_qty["user_qty"];
            $uqty = (int)$uqty + 1;

            if ($product_qty["qty"] >= $uqty) {  //if the product already on the cart update qty only
                Database::iud("UPDATE `cart` SET `user_qty` = '" . $uqty . "' WHERE `user_id` = '" . $email . "' AND `product_id` = '" . $pid . "'");
                echo ("success");
            } else if ($uqty > $product_qty["qty"]) { // if the user qty exceed the product qty
                echo "exceed";
            }
        } else {
            $uqty = 1;

            if (isset($_GET["qty"]) && $_GET["qty"] > 0) {
                if ($_GET["qty"] <= $product_qty["qty"]) {
                    $uqty = $_GET["qty"];
                } else {
                    $uqty = $product_qty["qty"];
                }
            }

            if ($product_qty["qty"] >= $uqty) { // if the product is new to cart
                Database::iud("INSERT INTO `cart` (`user_id`,`product_id`,`user_qty`,`tik`) VALUES ('" . $email . "','" . $pid . "','" . $uqty . "','0')");
                echo ("success");
            } else if ($uqty > $product_qty["qty"]) { // if the user qty exceed the product qty
                echo "exceed";
            }
        }





        $user_qty_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $email . "' AND `wish_p_id` = '" . $pid . "'");
        $user_qty = $user_qty_rs->fetch_assoc();

        if ($user_qty_rs->num_rows == 1) {

            Database::iud("DELETE FROM `wishlist` WHERE `userwish_id` = '" . $email . "' AND `wish_p_id` = '" . $user_qty["wish_p_id"] . "'");
        }
    } else {
        echo ("something"); // if user not exist in the database 
    }
} else {
    echo ("fail");  // if there's no session 
}
