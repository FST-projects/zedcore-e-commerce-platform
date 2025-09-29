<?php

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    if ($_SESSION["u"]["sell_approve"] == 1) {
        if (!empty($_POST["t"]) & !empty($_POST["sid"])) {
            $txt = $_POST["t"];
            $sid = $_POST["sid"];
            Database::iud("UPDATE `question` SET `answer` = '".$txt."' WHERE `id` = '" . $sid . "'");
        }
    }
}
