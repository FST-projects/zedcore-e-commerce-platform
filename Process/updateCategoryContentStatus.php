<?php
session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '9'");
    if ($permissionValidation->num_rows  == 1) {
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id_verify = Database::search("SELECT * FROM `home_content_manage` WHERE `category_id`='" . $_POST["id"] . "'");
            if ($id_verify->num_rows == 1) {
                $oldImgs = $id_verify->fetch_assoc();
                $availableImgcount = 0;
                if (isset($oldImgs["img1"]) && !empty($oldImgs["img1"])) {
                    $availableImgcount = $availableImgcount + 1;
                }
                if (isset($oldImgs["img2"]) && !empty($oldImgs["img2"])) {
                    $availableImgcount = $availableImgcount + 1;
                }
                if (isset($oldImgs["img3"]) && !empty($oldImgs["img3"])) {
                    $availableImgcount = $availableImgcount + 1;
                }
                if ($availableImgcount > 0) {
                    if ($_POST["tik"] == "true") {
                        Database::iud("UPDATE `home_content_manage` SET `status`='1' WHERE `category_id`='" . $oldImgs["category_id"] . "'");
                        echo "success";
                    } else {
                        Database::iud("UPDATE `home_content_manage` SET `status`='2' WHERE `category_id`='" . $oldImgs["category_id"] . "'");
                        echo "success";
                    }
                } else {
                    echo "Atleast one slide should be available";
                }
            } else {
                echo "Category Not found!";
            }
        } else {
            echo "Something went wrong";
        }
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}
