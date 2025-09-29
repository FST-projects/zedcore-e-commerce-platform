<?php

session_start();
if (isset($_SESSION["admin"])) {
    include "connection.php";


    $adminDetails_rs = Database::search("SELECT * FROM `admin` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");
    if ($adminDetails_rs->num_rows == 1) {
        Database::iud("UPDATE `admin` SET `req_password` = '1' WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");
        echo "success";
    } else {
        echo "Something went wrong";
    }
} else {
    echo "Something went wrong";
}
