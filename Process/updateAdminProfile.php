<?php

session_start();
if (isset($_SESSION["admin"])) {
    include "connection.php";

    if (!isset($_POST["fname"]) || empty($_POST["fname"])) {
        echo "Enter First Name";
    } else if (!isset($_POST["fname"]) || empty($_POST["fname"])) {
        echo "Enter Last Name";
    } else {


        $fname = $_POST["fname"];
        $lname = $_POST["lname"];

        $adminDetails_rs = Database::search("SELECT * FROM `admin` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");
        if ($adminDetails_rs->num_rows == 1) {
            $admin = $adminDetails_rs->fetch_assoc();

            $direct = "";
            if (isset($_FILES["image"])) {
                $img = $_FILES["image"];
                $extention = $img["type"];
                $allowed_extentions = array("image/jpeg", "image/jpg", "image/png", "image/svg+xml");
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


                    if (!empty($admin["img"])) {
                        unlink("../" . $admin["img"]);
                    }

                    $name = uniqid() . $newExtention;
                    $direct = "profilepic//changed//" . $img["name"] . "_" . $name;
                    $file_name = "../profilepic//changed//" . $img["name"] . "_" . $name;
                    move_uploaded_file($img["tmp_name"], $file_name);
                }
            }



            Database::iud("UPDATE `admin` SET `fname` = '$fname', `lname`='$lname', `img`='$direct' WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");
            echo "success";
        } else {
            echo "Something went wrong";
        }
    }
} else {
    echo "Something went wrong";
}
