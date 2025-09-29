<?php

include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

session_start();


if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '8'");
    if ($permissionValidation->num_rows  == 1) {
        if (isset($_POST["cid"])) {
            if (!empty($_POST["cid"])) {
                $cid = $_POST["cid"];

                $status_rs = Database::search("SELECT * FROM `invoice` WHERE `invoice_id` = '" . $cid . "'");
                $status = $status_rs->fetch_assoc();
                $user_email = $status["in_user_email"];
                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $status["p_invoice_id"] . "'");
                $product_img = $product_img_rs->fetch_assoc();



                $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $status["p_invoice_id"] . "'");
                $product_data = $product_rs->fetch_assoc();

                $p_total = $product_data["price"] * $status["in_qty"] + $status["delivery_price"];

                if ($status["status"] == 0) {
                    Database::iud("UPDATE `invoice` SET `status` = '1' WHERE `invoice_id` = '" . $cid . "'");
                    Database::iud("INSERT `alerts` (`msg_header`,`d-status`,`alert_msg`,`user_id`,`read_status`,`pid`,`p_img`) VALUES ('Delivery','0','Your package has been packed.','" . $status["in_user_email"] . "','0','" . $status["p_invoice_id"] . "','" . $product_img["img_path"] . "')");
                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'dsbamarasinghe1234@gmail.com';
                    $mail->Password = 'mqwamembfugzhknt';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('dsbamarasinghe1234@gmail.com', 'Zedcore e-shopping | Order Status');
                    $mail->addReplyTo('dsbamarasinghe1234@gmail.com', 'Zedcore e-shopping | Order Status');
                    $mail->addAddress($user_email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Zedcore | Order Updates';
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
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Order Updates</h1>
                            <p style="margin-bottom: 10px;">Your package has been packed.</p>
                            <h3 style="margin-bottom: 24px;">Invoice ID ' . $cid . '</h3>
                           <table   style="border: 1px solid black; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid; border-collapse: collapse;">Product</th>
                                        <th style="border: 1px solid; border-collapse: collapse;">Quantity</th>
                                        <th style="border: 1px solid; border-collapse: collapse;">Price (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                           <tr>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                               ' . $product_data["title"] . '
                                            </td>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                              ' . $status["in_qty"] . '
                                            </td>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                                ' . $p_total . '
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
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
                    }
                    echo ("1");
                } else if ($status["status"] == 1) {
                    Database::iud("UPDATE `invoice` SET `status` = '2' WHERE `invoice_id` = '" . $cid . "'");
                    Database::iud("INSERT `alerts` (`msg_header`,`d-status`,`alert_msg`,`user_id`,`read_status`,`pid`,`p_img`) VALUES ('Delivery','0','Your package has been dispatched.','" . $status["in_user_email"] . "','0','" . $status["p_invoice_id"] . "','" . $product_img["img_path"] . "')");

                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'dsbamarasinghe1234@gmail.com';
                    $mail->Password = 'mqwamembfugzhknt';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('dsbamarasinghe1234@gmail.com', 'Zedcore e-shopping | Order Status');
                    $mail->addReplyTo('dsbamarasinghe1234@gmail.com', 'Zedcore e-shopping | Order Status');
                    $mail->addAddress($user_email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Zedcore | Order Updates';
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
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Order Updates</h1>
                            <p style="margin-bottom: 10px;">Your package has been dispatched.</p>
                            <h3 style="margin-bottom: 24px;">Invoice ID ' . $cid . '</h3>
                           <table   style="border: 1px solid black; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid; border-collapse: collapse;">Product</th>
                                        <th style="border: 1px solid; border-collapse: collapse;">Quantity</th>
                                        <th style="border: 1px solid; border-collapse: collapse;">Price (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                           <tr>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                               ' . $product_data["title"] . '
                                            </td>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                              ' . $status["in_qty"] . '
                                            </td>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                                ' . $p_total . '
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
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
                    }

                    echo ("2");
                } else if ($status["status"] == 2) {
                    Database::iud("UPDATE `invoice` SET `status` = '3' WHERE `invoice_id` = '" . $cid . "'");
                    Database::iud("INSERT `alerts` (`msg_header`,`d-status`,`alert_msg`,`user_id`,`read_status`,`pid`,`p_img`) VALUES ('Delivery','1','Your package has been delivered.','" . $status["in_user_email"] . "','0','" . $status["p_invoice_id"] . "','" . $product_img["img_path"] . "')");

                    $mail = new PHPMailer;
                    $mail->IsSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'dsbamarasinghe1234@gmail.com';
                    $mail->Password = 'mqwamembfugzhknt';
                    $mail->SMTPSecure = 'ssl';
                    $mail->Port = 465;
                    $mail->setFrom('dsbamarasinghe1234@gmail.com', 'Zedcore e-shopping | Order Status');
                    $mail->addReplyTo('dsbamarasinghe1234@gmail.com', 'Zedcore e-shopping | Order Status');
                    $mail->addAddress($user_email);
                    $mail->isHTML(true);
                    $mail->Subject = 'Zedcore | Order Updates';
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
                            <h1 style="font-size: 25px; font-weight: bold; line-height: 45px;">Order Updates</h1>
                            <p style="margin-bottom: 10px;">Your package has been deliverded.</p>
                            <h3 style="margin-bottom: 24px;">Invoice ID ' . $cid . '</h3>
                           <table   style="border: 1px solid black; border-collapse: collapse;">
                                <thead>
                                    <tr>
                                        <th style="border: 1px solid; border-collapse: collapse;">Product</th>
                                        <th style="border: 1px solid; border-collapse: collapse;">Quantity</th>
                                        <th style="border: 1px solid; border-collapse: collapse;">Price (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                           <tr>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                               ' . $product_data["title"] . '
                                            </td>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                              ' . $status["in_qty"] . '
                                            </td>
                                            <td style="border: 1px solid; border-collapse: collapse;">
                                                ' . $p_total . '
                                            </td>
                                        </tr>

                                </tbody>
                            </table>
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
                    }

                    echo ("3");
                } else if ($status["status"] == 3) {
                    echo ("3");
                }
            }
        } else {
            echo ("fail");
        }
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}
