<?php

session_start();
if (isset($_POST["admin"]) && !empty($_POST["admin"])) {
    include "connection.php";


    $adminDetails_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email` = '" . $_POST["admin"] . "'");
    if ($adminDetails_rs->num_rows == 1) {
        Database::iud("UPDATE `admin` SET `req_password` = '1' WHERE `admin_email` = '" . $_POST["admin"] . "'");
        echo "success";
    } else {
        echo "Account not found!";
    }
} else {
    echo "Enter Email Address to make the request";
}
