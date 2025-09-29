<?php
session_start();
include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;


if (isset($_GET["e"])) {
    $email = $_GET['e'];  // get the email 
    $rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");
    $n = $rs->num_rows;
    if ($email == "") {
        echo ("Please Enter Your Email Address to recover your account!");
    } else if ($n == 1) {



        $digits = '0123456789';
        $code = '';
        $length = 8; 

        for ($i = 0; $i < $length; $i++) {
            $index = random_int(0, strlen($digits) - 1);
            $code .= $digits[$index];
        }



        $_SESSION["code"] = $code;
        Database::iud("UPDATE `user` SET `verification_code` = '$code' WHERE `email` = '$email'");

        $mail = new PHPMailer;
        $mail->IsSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'your@email.com';
        $mail->Password = 'secret code';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;
        $mail->setFrom('your@email.com', 'Zedcore e-shopping | Reset Password');
        $mail->addReplyTo('your@email.com', 'Zedcore e-shopping | Reset Password');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Zedcore | Verification Code';
        $bodyContent = '
        <table style="width: 100%; font-family: sans-serif;">
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
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Reset Your Password</h1>
                            <p style="margin-bottom: 24p;">Use the secret code below to reset your password</p>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <a style="display: inline-block; background-color: #00b5ad; color: white; font-size:18px; border-radius: 8px; padding: 15px; text-decoration: none; font-weight: bold;">
                                    <span>' . $code . '</span>
                                </a>
                            </div>
                            <p style="margin-top: 24px; color:red;">If you did not request a code, you can ignore this message.</p>
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
</table>
';
        $mail->Body    = $bodyContent;

        if (!$mail->send()) {
            echo ("Verification code sending failed");
        } else {
            echo ('Success');
        }
    } else {
        echo ("Invalid Email Address.");
    }
} else {
    echo ("Please enter your Email Address in Email Field.");
}
