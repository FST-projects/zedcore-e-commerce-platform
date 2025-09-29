<?php

include "connection.php";
if (isset($_POST["cid"])) {
    if (!empty($_POST["cid"])) {
        $cid = $_POST["cid"];

        $status_rs = Database::search("SELECT * FROM `admin` WHERE `admin_id` = '" . $cid . "'");
        $status = $status_rs->fetch_assoc();

        if ($status["status"] == 1) {
            Database::iud("UPDATE `admin` SET `status` = '2' WHERE `admin_id` = '" . $cid . "'");
            echo ("2");
        } else if ($status["status"] == 2) {
            Database::iud("UPDATE `admin` SET `status` = '1' WHERE `admin_id` = '" . $cid . "'");
            echo ("1");
        }
    }
} else {
    echo ("fail");
}
