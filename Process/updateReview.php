<?php

include "connection.php";

session_start();

if (isset($_SESSION["u"])) {
    if (!empty($_POST["r"])) {
        $reviewId = $_POST["r"];
        $starRate = $_POST["s"];
        $txt = $_POST["t"];
        $alert_id = $_POST["a"];
        echo($alert);

        $email = $_SESSION["u"]["email"];

        $alert_rs =  Database::search("SELECT * FROM `alerts` WHERE `id` = '" . $reviewId . "'");
        $alert = $alert_rs->fetch_assoc();

        Database::iud("INSERT INTO `review` (`review`,`stars`,`product_id`,`rev_user_id`,`alert_id`) VALUES ('" . $txt . "','" . $starRate . "','" . $alert["pid"] . "','" . $email . "','$alert_id')");
    }
}
