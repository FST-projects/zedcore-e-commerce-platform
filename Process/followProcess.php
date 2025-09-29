<?php
session_start();
include "connection.php";

if(isset($_SESSION["u"])){
$email = $_SESSION["u"]["email"];

$sid = $_POST["sid"];

$user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '".$email."'");
$shop_rs = Database::search("SELECT * FROM `shop` WHERE `shop_id` = '".$sid."'");

if($user_rs->num_rows == $shop_rs->num_rows){
    $follow_rs = Database::search("SELECT * FROM `followed_shop` WHERE `user_id` = '".$email."' AND `shop_id` = '".$sid."'");

    if($follow_rs->num_rows == 0){
        Database::iud("INSERT INTO `followed_shop` (`user_id`,`shop_id`) VALUES ('".$email."','".$sid."')");
        echo("followed");
    }else if($follow_rs->num_rows == 1){
        Database::iud("DELETE FROM `followed_shop` WHERE `user_id` = '".$email."' AND `shop_id` = '".$sid."'");
        echo("nFollowed");
    }else{
        echo("Something");
    }
}

}else{
    echo("fail");
}

?>