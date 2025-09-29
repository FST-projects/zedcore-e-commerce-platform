<?php


session_start();

include "connection.php";

if (isset($_SESSION["u"])) {
    $sender = $_SESSION["u"]["email"];
} else if (isset($_SESSION["admin"])) {
    $admin = $_SESSION["admin"];
}

if (!empty($_POST["t"])) {
    $txt = $_POST["t"];

    $d = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $d->setTimezone($tz);
    $date = $d->format('Y-m-d H:i:s');

    if (!empty($sender)) {
        $admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email` = 'admin.email@gmail.com'");
        $admin = $admin_rs->fetch_assoc();
        Database::iud("INSERT INTO `msgadmin` (`sender`,`receiver`,`date`,`read_status`,`content`) VALUES ('".$sender."','".$admin["admin_email"]."','".$date."','0','".$txt."')");
    }else if (!empty($admin)) {
        if(!empty($_POST["sid"])){
            $user_id = $_POST["sid"];
        }
        $user_rs = Database::search("SELECT * FROM `user` WHERE `id` = '".$user_id."'");
        $user = $user_rs->fetch_assoc();
        Database::iud("INSERT INTO `msgadmin` (`sender`,`receiver`,`date`,`read_status`,`content`) VALUES ('".$admin["admin_email"]."','".$user["email"]."','".$date."','0','".$txt."')");
    }
}
