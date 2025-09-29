<?php
session_start();
include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if ($_POST["e"] != "") {
    $user_email = $_POST["e"];

    if ($_POST["c"] != "") {
        $user_code = $_POST["c"];



        $user_exsist_rs = Database::search("SELECT * FROM `admin` WHERE `admin_email` = '" . $user_email . "' AND `password` = '$user_code'");
        if ($user_exsist_rs->num_rows == 1) {
            $user_data =  $user_exsist_rs->fetch_assoc();

            if ($user_data["status"] == 2) {
                echo "blocked";
            } else {
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
                $mail->addAddress($user_email);
                $mail->isHTML(true);
                $mail->Subject = 'Zedcore | Admin Panel';
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
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Logged Successfully</h1>
                            <p style="margin-bottom: 24p;">You have Logged into Zedcore Admin Panel Successfully</p>
                            
                            <p style="margin-top: 24px; color:red;">If this was not you please inform Zedcore support team immediately.</p>
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
                    echo ("Something went wrong, Try again");
                } else {
                    $_SESSION["admin"] = $user_data;
                    echo ('Success');
                }
            }
        } else {
            echo ('Incorret email or Password');
        }
    } else {
        echo ("Enter Password");
    }
} else {
    echo ("Enter admin email");
}
