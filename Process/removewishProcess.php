<?php

include "connection.php";

session_start();
if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];
    $pid = $_POST["pid"];

    $user_qty_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $email . "' AND `wish_p_id` = '" . $pid . "'");
    $user_qty = $user_qty_rs->fetch_assoc();

    if ($user_qty_rs->num_rows == 1) {

        Database::iud("DELETE FROM `wishlist` WHERE `userwish_id` = '" . $email . "' AND `wish_p_id` = '" . $user_qty["wish_p_id"] . "'");
        echo ("success");

    }
} else {
    echo("fail");
}
