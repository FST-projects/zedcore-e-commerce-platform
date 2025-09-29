<?php

include "connection.php";
if (isset($_POST["cid"])) {
    if (!empty($_POST["cid"])) {
        $cid = $_POST["cid"];

        $status_rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $cid . "'");
        $status = $status_rs->fetch_assoc();

        if ($status["status_status_id"] == 1) {
            Database::iud("UPDATE `user` SET `status_status_id` = '2' WHERE `id` = '" . $cid . "'");
            echo ("2");
        } else if ($status["status_status_id"] == 2) {
            Database::iud("UPDATE `user` SET `status_status_id` = '1' WHERE `id` = '" . $cid . "'");
            echo ("1");
        }
    }
} else {
    echo ("fail");
}
