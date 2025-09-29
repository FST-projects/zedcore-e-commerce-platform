<?php

session_start();

if (isset($_SESSION["u"])) {

    $email = $_SESSION['u']["email"];

    include "connection.php";

    $address1 = $_POST["a1"];
    $city = $_POST["c"];
    $district = $_POST["d"];
    $province = $_POST["p"];
    $zipcode = $_POST["z"];

    if (empty($address1)) {
        echo ("Please enter your address!");
    } else if ($city == 0) {
        echo ("Please select your city!");
    } else if ($district == 0) {
        echo ("Please select your district!");
    } else if ($province == 0) {
        echo ("Please select your province/state!");
    } else if (empty($zipcode)) {
        echo ("Please enter the zip code!");
    } else {

        $preData_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");

        if ($preData_rs->num_rows == 1) {
            //update user address information
            Database::iud("UPDATE `user_has_address` SET `city_city_id` = '" . $city . "' , `line1` = '" . $address1 . "' , `postal_code` = '" . $zipcode . "' WHERE `user_email` = '" . $email . "'");
            echo ("success");
        } else if ($preData_rs->num_rows == 0) {
            //insert new user address information
            Database::iud("INSERT INTO `user_has_address` (`user_email` , `city_city_id`, `line1` , `postal_code`) VALUES ('" . $email . "' , '" . $city . "' , '" . $address1 . "' , '" . $zipcode . "') ");
            echo ("success");
        } else {
            die("Error: More than one record found! Please contact support for assistance.");
        }
    }
} else {
    header("Location: ../signin.php");
}
