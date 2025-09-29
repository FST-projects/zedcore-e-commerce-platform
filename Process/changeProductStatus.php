<?php

include "connection.php";
if (isset($_POST["cid"])) {
    if (!empty($_POST["cid"])) {
        $cid = $_POST["cid"];

        $status_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cid . "'");
        $status = $status_rs->fetch_assoc();

        if ($status["admin_status"] == 1) {
            Database::iud("UPDATE `product` SET `admin_status` = '2' WHERE `id` = '" . $cid . "'");
            echo ("2");
        } else if ($status["admin_status"] == 2) {
            Database::iud("UPDATE `product` SET `admin_status` = '1' WHERE `id` = '" . $cid . "'");
            if ($status["status_status_id"] == 1) {
                echo ("3");
            } else if ($status["status_status_id"] == 2) {
                echo ("4");
            }
        }
    }
} else {
    echo ("fail");
}
