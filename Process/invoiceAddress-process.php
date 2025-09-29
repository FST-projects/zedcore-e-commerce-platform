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
    $order_id = $_POST["id"];

    $order_rs = Database::search("SELECT * FROM `invoice_address` WHERE `o_id` = '$order_id' AND `user_id` = '" . $_SESSION["u"]["id"] . "'");

    if ($order_rs->num_rows == 1) {



        if (empty($address1)) {
            echo ("1");
        } else if ($city == 0) {
            echo ("2");
        } else if ($district == 0) {
            echo ("3");
        } else if ($province == 0) {
            echo ("4");
        } else if (empty($zipcode)) {
            echo ("5");
        } else {

            Database::iud("UPDATE `invoice_address` SET `city_city_id` = '$city', `line1` = '$address1', `postal_code` = '$zipcode' WHERE `o_id` = '$order_id' AND `user_id` = '" . $_SESSION["u"]["id"] . "'");
            echo($address1);
        }
    } else {
        echo ("fail");
    }
} else {
    header("Location: ../signin.php");
}
