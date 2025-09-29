<?php
session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '9'");
    if ($permissionValidation->num_rows  == 1) {
        $img1 = "";
        $img2 = "";
        $img3 = "";
        if (isset($_POST["id"]) && !empty($_POST["id"])) {
            $id_verify = Database::search("SELECT * FROM `home_content_manage` WHERE `category_id`='" . $_POST["id"] . "'");
            if ($id_verify->num_rows == 1) {
                $oldImgs = $id_verify->fetch_assoc();
                $allowed_extentions = array("image/jpeg", "image/jpg", "image/png", "image/svg+xml");

                if (isset($_FILES["image0"])) {

                    $img = $_FILES["image0"];
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
                        }

                        $name = uniqid() . $newExtention;
                        $direct = "ProductPic/slides/slide_" . $img["name"] . "_" . $name;
                        $file_name1 = "../ProductPic/slides/slide_" . $img["name"] . "_" . $name;
                        move_uploaded_file($img["tmp_name"], $file_name1);
                        if (isset($oldImgs["img1"]) && !empty($oldImgs["img1"])) {
                            unlink("../".$oldImgs["img1"]);
                        }
                        $img1 = $direct;
                    } else {
                        echo ("File format not supported!");
                    }
                }
                if (isset($_FILES["image1"])) {

                    $img = $_FILES["image1"];
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
                        }

                        $name = uniqid() . $newExtention;
                        $direct = "ProductPic/slides/slide_" . $img["name"] . "_" . $name;
                        $file_name2 = "../ProductPic/slides/slide_" . $img["name"] . "_" . $name;
                        move_uploaded_file($img["tmp_name"], $file_name2);
                        if (isset($oldImgs["img2"]) && !empty($oldImgs["img2"])) {
                            unlink("../".$oldImgs["img2"]);
                        }
                        $img2 = $direct;
                    } else {
                        echo ("File format not supported!");
                    }
                }
                if (isset($_FILES["image2"])) {

                    $img = $_FILES["image2"];
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
                        }

                        $name = uniqid() . $newExtention;
                        $direct = "ProductPic/slides/slide_" . $img["name"] . "_" . $name;
                        $file_name3 = "../ProductPic/slides/slide_" . $img["name"] . "_" . $name;
                        move_uploaded_file($img["tmp_name"], $file_name3);
                        if (isset($oldImgs["img3"]) && !empty($oldImgs["img3"])) {
                            unlink("../".$oldImgs["img3"]);
                        }
                        $img3 = $direct;
                    } else {
                        echo ("File format not supported!");
                    }
                }

                Database::iud("UPDATE `home_content_manage` SET `img1`='$img1',`img2`='$img2',`img3`='$img3' WHERE `category_id`='" . $oldImgs["category_id"] . "'");
                echo ("success");
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
