<?php
include "connection.php";

$fname = $_POST["f"];
$lname = $_POST["l"];
$email = $_POST["e"];
$password = $_POST["p"];
$mobile = $_POST["m"];
$gender = $_POST["g"];

//validating INPUTS
if(empty($fname)){
    echo("Please Enter Your First Name."); //validating fname
}else if(strlen($fname) > 50){
    echo("First Name Must Contain LOWER THAN 50 Characters.");
}else if(empty($lname)){
    echo("Please Enter Your Last Name."); //validating lname
}else if(strlen($lname) > 50){
    echo("Last Name Must Contain LOWER THAN 50 Characters.");
}else if(empty($email)){
    echo("Please Enter Your Email."); // validating email
}else if(strlen($email) > 100){
    echo("First Name Must Contain LOWER THAN 50 Characters.");
}else if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
    echo("Invalid Email Address.");
}else if(empty($password)){
    echo("Please Enter Your Password."); //validating password
}else if(strlen($password) < 5 || strlen($password) > 20){
    echo("Password must contain 5 to 20 Characters.");
}else if(empty($mobile)){
    echo("Please Enter Your Mobile Number."); //validating mobile
}else if(strlen($mobile) != 10 ){
    echo("Mobile Number Must Contain 10 Characters.");
}else if(!preg_match("/07[0,1,2,4,5,6,7,8][0-9]/",$mobile)){
    echo("Invalid Number!");
}else{
    $rs = Database::search("SELECT * FROM `user` WHERE `email` ='".$email."' or `mobile` = '".$mobile."'");
    $n = $rs->num_rows;

    if($n > 0){

        echo("User with the same Email Address or same Mobile Number already exists");
    }else{


        $d = new DateTime();
        $tz = new DateTimeZone("Asia/Colombo");
        $d->setTimezone($tz);
        $date = $d->format("Y-m-d H:i:s");

        Database::iud("INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`mobile`,`joined_date`,`status_status_id`,`gender_gender_id`)
        VALUES ('$fname','$lname','$email','$password','$mobile','$date','1','$gender')");

        echo("success");
    }
}



?>