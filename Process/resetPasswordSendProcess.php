<?php
session_start();
include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

$adminId = $_POST["id"];

if (empty($adminId)) {
    echo ("Something Went wrong");
} else {

    $rs = Database::search("SELECT * FROM `admin` WHERE `admin_id` = '" . $adminId . "' AND `req_password` = '1'");
    $num = $rs->num_rows;

    if ($num > 0) {

        $row = $rs->fetch_assoc();
        $email = $row["admin_email"];
        $vcode = uniqid();


        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'your@email.com';
            $mail->Password = 'secret code';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;

            $mail->setFrom('your@email.com', 'Forgot password');
            $mail->addAddress($email);

            $mail->isHTML(true);
            $mail->Subject = 'Reset your account password';
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
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Reset Your Password</h1>
                            <p style="margin-bottom: 24p;">You can reset your password by clicking the button below</p>
                            <div style="display:flex; align-items:center; justify-content:center;">
                                <a href="https://localhost/project/adminPasswordReset.php?v=' . $vcode . '&e=' . $row["admin_email"] . '" style="display: inline-block; background-color: #00b5ad; color: white; border-radius: 8px; padding: 15px; text-decoration: none; font-weight: bold;">
                                    <span>Reset Password</span>
                                </a>
                            </div>
                            <p style="margin-top: 24px; color:red;">If this wasn\'t you, please inform zedcore support team</p>
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
            Database::iud("UPDATE `admin` SET `password` = '$vcode', `req_password` = '0' WHERE `admin_id` = '$adminId'");
            echo 'success';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo ("Seems to like not requested a password reset");
    }
}
