<?php

include "connection.php";

session_start();

if (isset($_SESSION["u"])) {

    $email = $_SESSION["u"]["email"];

    Database::iud("UPDATE `cart`  SET `tik` = '0' WHERE `user_id` = '$email'");
    echo ("success");
} else {
    header("Location: home.php");
}
