<?php

session_start();

$email = $_SESSION["u"]["email"];

include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$day = $_POST["d"];
$month = $_POST["m"];
$year = $_POST["y"];
$mobile = $_POST["mob"];



if (empty($fname)) {
    echo ("Please Enter Your First Name."); //validating fname
} else if (strlen($fname) > 50) {
    echo ("First Name Must Contain LOWER THAN 50 Characters.");
} else if (empty($lname)) {
    echo ("Please Enter Your Last Name."); //validating lname
} else if (strlen($lname) > 50) {
    echo ("Last Name Must Contain LOWER THAN 50 Characters.");
} else if (empty($mobile)) {
    echo ("Please Enter Your Mobile Number."); //validating mobile
} else if (strlen($mobile) != 10) {
    echo ("Mobile Number Must Contain 10 Characters.");
} else if (!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/", $mobile)) {
    echo ("Invalid Number!");
} else {


    if (isset($_FILES["i"])) {
        if (!empty($year) || !empty($month) || !empty($day)) {
            if (!empty($year)) { //should be atleast 9 year old
                $present_year = date("Y");
                if ($year < $present_year - 9 && $year > $present_year - 150) {
                    if (!$month == 0) {
                        if ($day < 32 && $day > 0) {

                            if (isset($_FILES["i"])) {
                                $img = $_FILES["i"];
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

                                    $deletionImg_rs = Database::search("SELECT `img` FROM `user` WHERE `email` = '" . $email . "'");
                                    $deletionImg = $deletionImg_rs->fetch_assoc();
                                    if (!empty($deletionImg["img"])) {
                                        unlink("../" . $deletionImg["img"]);
                                    }

                                    $name = uniqid() . $newExtention;
                                    $direct = "profilepic//changed//" . $fname . "_" . $name;
                                    $file_name = "../profilepic//changed//" . $fname . "_" . $name;
                                    move_uploaded_file($img["tmp_name"], $file_name);

                                    Database::iud("UPDATE `user` SET `img` = '" . $direct . "' WHERE `email` = '" . $email . "'");
                                    Database::iud("UPDATE `user` SET `fname` ='" . $fname . "' , `lname` = '" . $lname . "' , `mobile` = '" . $mobile . "', `bday` = '" . $day . "', `bmonth` = '" . $month . "',`byear`= '" . $year . "' WHERE `email` = '" . $email . "'");
                                    echo ("success");
                                }
                            }
                        } else {
                            echo ("Invalid Day!");
                        }
                    } else {
                        echo ("Invalid Month!");
                    }
                } else {
                    echo ("Invalid Year!");
                }
            } else {
                echo ("Enter year!");
            }
        } else {

            if (isset($_FILES["i"])) {
                $img = $_FILES["i"];
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

                    $deletionImg_rs = Database::search("SELECT `img` FROM `user` WHERE `email` = '" . $email . "'");
                    $deletionImg = $deletionImg_rs->fetch_assoc();
                    if (!empty($deletionImg["img"])) {
                        unlink("../" . $deletionImg["img"]);
                    }

                    $name = uniqid() . $newExtention;
                    $direct = "profilepic//changed//" . $fname . "_" . $name;
                    $file_name = "../profilepic//changed//" . $fname . "_" . $name;
                    move_uploaded_file($img["tmp_name"], $file_name);

                    Database::iud("UPDATE `user` SET `img` = '" . $direct . "' WHERE `email` = '" . $email . "'");
                    Database::iud("UPDATE `user` SET `fname` ='" . $fname . "' , `lname` = '" . $lname . "' , `mobile` = '" . $mobile . "' WHERE `email` = '" . $email . "'");
                    echo ("success");
                } else {
                    echo ("File format not supported!");
                }
            }
        }
    } else if (!isset($_FILES["i"])) {

        if (!empty($year) || !empty($month) || !empty($day)) {
            if (!empty($year)) { //should be atleast 9 year old
                $present_year = date("Y");
                if ($year < $present_year - 9 && $year > $present_year - 150) {
                    if (!$month == 0) {
                        if ($day < 32 && $day > 0) {
                            Database::iud("UPDATE `user` SET `fname` ='" . $fname . "' , `lname` = '" . $lname . "' , `mobile` = '" . $mobile . "', `bday` = '" . $day . "', `bmonth` = '" . $month . "',`byear`= '" . $year . "' WHERE `email` = '" . $email . "'");
                            echo ("success");
                        } else {
                            echo ("Invalid Day!");
                        }
                    } else {
                        echo ("Invalid Month!");
                    }
                } else {
                    echo ("Invalid Year!");
                }
            } else {
                echo ("Enter year!");
            }
        } else {
            Database::iud("UPDATE `user` SET `fname` ='" . $fname . "' , `lname` = '" . $lname . "' , `mobile` = '" . $mobile . "' WHERE `email` = '" . $email . "'");
            echo ("success");
        }
    }
}
