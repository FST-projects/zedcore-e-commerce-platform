<?php
session_start();
include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '7'");
    if ($permissionValidation->num_rows  == 1) {


        $permissionNumber = 0;
        if ($_POST["dash"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["product"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["order"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["hist"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["user"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["shop"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["admin"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }
        if ($_POST["home"] == 'true') {
            $permissionNumber = $permissionNumber + 1;
        }

        if (!isset($_POST["fname"]) || empty($_POST["fname"])) {
            echo "Enter First Name";
        } else if (!isset($_POST["lname"]) || empty($_POST["lname"])) {
            echo "Enter Last Name";
        } else if (!isset($_POST["email"]) || empty($_POST["email"])) {
            echo "Enter Email address";
        } else if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
            echo "Enter valid email address";
        } else if (!isset($_POST["role"]) || empty($_POST["role"])) {
            echo "Enter Admin Role";
        } else if (!isset($_POST["gender"]) || empty($_POST["gender"])) {
            echo "Select the gender";
        } else if ($permissionNumber == 0) {
            echo "Atleast one permission should be given";
        } else {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $role = $_POST["role"];
            $gender = $_POST["gender"];

            $admin_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email` = '$email'");
            if ($admin_rs->num_rows > 0) {
                echo ("Email Already exsits!");
            } else {
                $password = uniqid();

                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");



                $mail = new PHPMailer(true);

                try {
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'youremail@gmail.com';
                    $mail->Password = 'secretkey';
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
                    $mail->Port = 465;

                    $mail->setFrom('youremail@gmail.com', 'Forgot password');
                    $mail->addAddress($email);

                    $mail->isHTML(true);
                    $mail->Subject = 'Zedcore Admin Password';
                    $mail->Body = '<table style="width: 100%; font-family: sans-serif;">
    <tbody>
        <tr>
            <td align="center">

                <table style="max-width: 600px;">
                    <tr>
                        <td align="center">
                            <a href="#" style="font-size: 35px; color: black; font-weight: bold; text-decoration: none;">Zedcore</a>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Account Created Successfully</h1>
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Create New Password</h1>
                            <p style="margin-bottom: 24p;">You can create your password by clicking the button below</p>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <a href="https://localhost/project/adminPasswordReset.php?v=' . $password . '&e=' . $email . '" style="display: inline-block; background-color: #00b5ad; color: white; border-radius: 8px; padding: 15px; text-decoration: none;">
                                    <span>Setup Password</span>
                                </a>
                            </div>
                            <hr>
                        </td>
                    </tr>

                    <tr>
                        <td align="center">
                            <p>&copy; 2024 Zedcore.lk</p>
                        </td>
                    </tr>
                </table>

            </td>
        </tr>
    </tbody>
</table>';

                    $mail->send();
                    Database::iud("INSERT INTO `admin` (`admin_email`,`fname`,`lname`,`role`,`password`,`added_date`,`gender_gender_id`,`status`,`req_password`) VALUES ('$email','$fname','$lname','$role','$password','$date','$gender','1','0')");

                    if ($_POST["dash"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','1')");
                    }
                    if ($_POST["product"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','2')");
                    }
                    if ($_POST["order"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','8')");
                    }
                    if ($_POST["hist"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','3')");
                    }
                    if ($_POST["user"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','5')");
                    }
                    if ($_POST["shop"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','6')");
                    }
                    if ($_POST["admin"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','7')");
                    }
                    if ($_POST["home"] == 'true') {
                        Database::iud("INSERT INTO `admin_cat` (`admin_email`,`cat_id`) VALUE ('$email','9')");
                    }
                    echo "success";
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
            }
        }
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}
