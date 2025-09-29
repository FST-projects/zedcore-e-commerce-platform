<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pid = $_POST["pid"];
    $ques = $_POST["ques"];

    $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $pid . "'");

    if ($product_rs->num_rows == 1) {
        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");
        if (!empty($ques)) {
            Database::iud("INSERT INTO `question` (`question`,`pid`,`msg_status`,`ques_user_id`,`time`) VALUES ('" . $ques . "','" . $pid . "','0','" . $email . "','" . $date . "')");
            echo ("success");
        }else{
            echo("success");
        }

    } else {
        echo ("Something");
    }
} else {
    echo ("fail");
}
