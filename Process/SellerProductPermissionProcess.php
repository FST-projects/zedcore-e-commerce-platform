<?php

session_start();
include("connection.php");

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '2'");
    if ($permissionValidation->num_rows  == 1) {

        if (isset($_POST["m"]) && !empty($_POST["m"])) {
            if ($_POST["m"] == "true") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '1' WHERE `id` = '1'");
            } else if ($_POST["m"] == "false") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '2' WHERE `id` = '1'");
            }
        }
        if (isset($_POST["b"]) && !empty($_POST["b"])) {
            if ($_POST["b"] == "true") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '1' WHERE `id` = '3'");
            } else if ($_POST["b"] == "false") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '2' WHERE `id` = '3'");
            }
        }
        if (isset($_POST["cat"]) && !empty($_POST["cat"])) {
            if ($_POST["cat"] == "true") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '1' WHERE `id` = '2'");
            } else if ($_POST["cat"] == "false") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '2' WHERE `id` = '2'");
            }
        }
        if (isset($_POST["clr"]) && !empty($_POST["clr"])) {
            if ($_POST["clr"] == "true") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '1' WHERE `id` = '4'");
            } else if ($_POST["clr"] == "false") {
                Database::iud("UPDATE `seller_product_add_permission` SET `status` = '2' WHERE `id` = '4'");
            }
        }
        echo "success";
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}
