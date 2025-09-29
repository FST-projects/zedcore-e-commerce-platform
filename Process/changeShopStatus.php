<?php

include "connection.php";
if (isset($_POST["cid"])) {
    if (!empty($_POST["cid"])) {
        $cid = $_POST["cid"];

        $status_rs = Database::search("SELECT * FROM `shop` WHERE `shop_id` = '" . $cid . "'");
        $status = $status_rs->fetch_assoc();

        if ($status["shop_status"] == 1) {
            Database::iud("UPDATE `shop` SET `shop_status` = '2' WHERE `shop_id` = '" . $cid . "'");
            echo ("2");
        } else if ($status["shop_status"] == 2) {
            Database::iud("UPDATE `shop` SET `shop_status` = '1' WHERE `shop_id` = '" . $cid . "'");
            echo ("1");
        }
    }
} else {
    echo ("fail");
}
