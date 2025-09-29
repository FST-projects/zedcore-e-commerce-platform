<?php
session_start();
include "connection.php";

if(isset($_SESSION["u"])){
    $email = $_SESSION["u"]["email"];

    Database::iud("UPDATE `alerts` SET `read_status` = '1' WHERE `user_id` = '".$email."'");
    echo("success");
}


?>