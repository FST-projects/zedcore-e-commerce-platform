<?php

include "connection.php";

if (!isset($_POST["e"]) || empty($_POST["e"])) {
    echo "something went Wrong";
} else if (!isset($_POST["p1"]) || empty($_POST["p1"])) {
    echo ("Enter New Password!");
} else if (!preg_match('/[^a-zA-Z0-9]/', $_POST['p1'])) {
    echo ('At least one special character should include');
} else if (strlen($_POST["p1"]) < 5 || strlen($_POST["p1"]) > 20) {
    echo ("password should be more than 5 characters");
} else if (!isset($_POST["p2"]) || empty($_POST["p2"])) {
    echo ("Confrim Password!");
} else if ($_POST["p1"] != $_POST["p2"]) {
    echo ("Password does not match!");
} else {
    $valid_user_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email` = '" . $_POST["e"] . "' ");
    if ($valid_user_rs->num_rows == 1) {
        Database::iud("UPDATE `admin` SET `password` = '" . $_POST["p2"] . "' WHERE `admin_email` = '" . $_POST["e"] . "'");
        echo ("success");
    }
}

