<?php

session_start();
include "connection.php";

if(isset($_SESSION["u"])){
    $email = $_SESSION["u"]["email"];

    $notify_num_rs = Database::search("SELECT * FROM `alerts` WHERE `user_id` = '".$email."' AND `read_status` ='0'");
    $notify_num = $notify_num_rs->num_rows;
    echo($notify_num);
}


?>