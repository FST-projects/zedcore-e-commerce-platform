<?php
require "connection.php";
$pw1 = $_POST["p1"];
$pw2 = $_POST["p2"];
$email = $_POST["e"];


if(empty($pw1)){
    echo("Enter New Password!");
}else if(strlen($pw1) < 5 || strlen($pw1) > 20){
    echo("Password must contain 5 to 20 Characters.");
}else{


    if($pw1 == $pw2){
        //correct
        echo("success");
        Database::iud("UPDATE `user` SET `password` = '$pw2' WHERE `email` = '$email'");
    }else{
        echo("Password does not match!");
    }
}

?>