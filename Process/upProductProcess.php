<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {

    if (isset($_SESSION["p"])) {
        $pid = $_SESSION["p"]["id"];
        $email = $_SESSION["u"]["email"];

        $title = $_POST["t"];
        $qty = $_POST["q"];
        $desc = $_POST["de"];
        $spec = $_POST["sp"];




        if (empty($qty) || $qty < 1) {
            echo ("Enter valid Product quantity!");
        } else if (empty($title)) {
            echo ("Enter Product Title!");
        } else if (empty($desc)) {
            echo ("Enter Product description!");
        } else if (empty($spec)) {
            echo ("Enter Product specification!");
        } else {


            $qty_rs = Database::search("SELECT * FROM `product` WHERE `id` = '$pid'");
            $pQty = $qty_rs->fetch_assoc();
            if ($pQty["qty"] == 0) {
                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '$pid'");
                $product_img = $product_img_rs->fetch_assoc();
                $user_list_rs = Database::search("SELECT * FROM `wishlist` WHERE `wish_p_id` = '$pid'");
                for ($i = 0; $i < $user_list_rs->num_rows; $i++) {
                    $user_list = $user_list_rs->fetch_assoc();
                    $title = $pQty["title"];
                    Database::iud("INSERT `alerts` (`msg_header`,`d-status`,`alert_msg`,`user_id`,`read_status`,`pid`,`p_img`) VALUES ('Product is back!','0','$title product is available to purchase! Buy Now','" . $user_list["userwish_id"] . "','0','$pid','" . $product_img["img_path"] . "')");
                }
            }

            Database::iud("UPDATE `product` SET `spec` = '" . $spec . "' , `title` = '" . $title . "' , `qty` = '" . $qty . "' , `description` = '" . $desc . "' WHERE `id` = '" . $pid . "'");


            $length = sizeof($_FILES);

            if ($length <= 5 && $length > 0) {

                function sanitizeFileName($title)
                {
                    return preg_replace('/[^a-zA-Z0-9-_\.]/', '', $title);
                }
                $allowed_extentions = array("image/jpeg", "image/jpg", "image/png", "image/svg+xml","image/webp");
                $title = sanitizeFileName($title);

                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '$pid'");
                $img_num = $img_rs->num_rows;

                for ($y = 0; $y < $img_num; $y++) {
                    $img_data = $img_rs->fetch_assoc();
                    unlink('../' . $img_data['img_path']);
                    Database::iud("DELETE FROM `product_img` WHERE `product_id` = '" . $pid . "'");
                }


                for ($x = 0; $x < $length; $x++) {


                    if (isset($_FILES["image" . $x])) {

                        $img = $_FILES["image" . $x];
                        $extention = $img["type"];



                        if (in_array($extention, $allowed_extentions)) {
                            $newExtention;

                            if ($extention == "image/jpeg") {
                                $newExtention = ".jpeg";
                            } else if ($extention == "image/jpg") {
                                $newExtention = ".jpg";
                            } else if ($extention == "image/png") {
                                $newExtention = ".png";
                            } else if ($extention == "image/svg+xml") {
                                $newExtention = ".svg";
                            } else if ($extention == "image/webp") {
                                $newExtention = ".webp";
                            }

                            $name = uniqid() . $newExtention;
                            $direct = "ProductPic/" . $title . "_" . $x . "_" . $name;
                            $file_name = "../" . $direct;


                            if (move_uploaded_file($img["tmp_name"], $file_name)) {

                                Database::iud("INSERT INTO `product_img` (`img_path`, `product_id`) VALUES ('" . $direct . "', '" . $pid . "')");
                            }
                        } else {
                            echo ("File format not supported!");
                        }
                    }
                }
            }
            echo ("success");
        }
    } else {
        echo ("Unable to find the product! please try again!");
    }
} else {
    echo (" Login details not found! please try relogin.");
}
