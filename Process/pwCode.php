<?php
session_start();

$user_code = $_POST["c"];

$real_code = $_SESSION["code"];
if ($user_code == $real_code) {
    echo "success";
} else {
    echo("Your rest code is incorrect!");  // If code is incorrect
}
