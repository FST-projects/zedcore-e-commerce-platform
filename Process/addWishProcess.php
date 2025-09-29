<?php
include "connection.php";

session_start();



if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $wid = $_GET["wid"];

    $user_rs = Database::search("SELECT  * FROM `user` WHERE `email` = '" . $email . "'");
    if ($user_rs->num_rows == 1) {

        $product_rs = Database::search("SELECT * FROM `product` WHERE  `id`='" . $wid . "' ");

        if ($product_rs->num_rows == 1) {  //if product exist in database 

            $user_wish_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $email . "' AND `wish_p_id` = '" . $wid . "'");

            
            if ($user_wish_rs->num_rows == 0) { // if the product new to wishlist
                Database::iud("INSERT INTO `wishlist` (`userwish_id`,`wish_p_id`) VALUES ('".$email."','".$wid."')");
                echo ("success");
            }else if ($user_wish_rs->num_rows == 1) { // if the product already on the wishlist remove it
                Database::iud("DELETE FROM `wishlist` WHERE `userwish_id` = '".$email."' AND `wish_p_id` = '".$wid."'");
                echo ("remove");
            }else if ($user_wish_rs->num_rows > 1) { // if the product already on the wishlist remove it
                echo ("something");
            }
        }
    } else {
        echo ("something"); // if user not exist in the database 
    }
} else {
    echo ("fail");  // if there's no session 
}
