<?php

session_start();


include "connection.php";
include "SMTP.php";
include "PHPMailer.php";
include "Exception.php";

use PHPMailer\PHPMailer\PHPMailer;

if (isset($_SESSION["u"])) {

    $order_id = $_POST["o"];
    $uid = $_POST["id"];

    $user_full_rs = Database::search("SELECT * FROM `user` WHERE `id` = '$uid'");
    $user_full_data = $user_full_rs->fetch_assoc();
    $email = $user_full_data["email"];
    $order_details_rs = Database::search("SELECT * FROM `purchase_history` WHERE `u_id` = '$uid' AND `or_id` = '$order_id' AND `status` = '0'");

    if ($order_details_rs->num_rows > 0) {
        Database::iud("UPDATE `purchase_history` SET `status` = '1' WHERE `u_id` = '$uid' AND `or_id` = '$order_id'");
        for ($i = 0; $i < $order_details_rs->num_rows; $i++) {
            $order_details = $order_details_rs->fetch_assoc();


            $product_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $order_details["p_id"] . "'");
            $product_data = $product_rs->fetch_assoc();
            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $order_details["p_id"] . "'");
            $product_img = $product_img_rs->fetch_assoc();

            $new_qty = (int)$product_data["qty"] - $order_details["qty"];

            Database::iud("UPDATE `product` SET `qty` = '" . $new_qty . "' WHERE `id` = '" . $order_details["p_id"] . "'");


            $address_rs = Database::search("SELECT * FROM `invoice_address` WHERE `o_id` = '" . $order_id . "' AND `user_id` = '$uid'");
            $address = $address_rs->fetch_assoc();
            $city_rs = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $address["city_city_id"] . "'");
            $cityfetch_rs = $city_rs->fetch_assoc();
            $delivery_fee = 700;
            $delivery_fee_cal = Database::search("SELECT * FROM `delivery_fees` WHERE `district_id_del` = '" . $cityfetch_rs["district_district_id"] . "'");
            if ($delivery_fee_cal->num_rows == 1) {
                $delivery = $delivery_fee_cal->fetch_assoc();
                $delivery_fee = $delivery["fee"];
            }



            $p_total = $product_data["price"] * $order_details["qty"] + $delivery_fee;
            $d = new DateTime();
            $tz = new DateTimeZone("Asia/Colombo");
            $d->setTimezone($tz);
            $date = $d->format('Y-m-d H:i:s');

            Database::iud("INSERT INTO `invoice` (`order_id`,`date`,`total`,`in_qty`,`status`,`p_invoice_id`,`in_user_email`,`delivery_price`) VALUES 
        ('" . $order_id . "','" . $date . "','" . $product_data["price"] . "','" . $order_details["qty"] . "','0','" . $order_details["p_id"] . "','" . $user_full_data["email"] . "','$delivery_fee')");

            $id_result = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $order_id . "'");
            $id_rs_set = $id_result->fetch_assoc();
            $id = $id_rs_set["invoice_id"];

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
            $mail->addAddress($email);
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
                            <p style="margin-bottom: 10px;">Your order has been placed.</p>
                            <h3 style="margin-bottom: 24px;">Invoice ID ' . $id . '</h3>
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
                                              ' . $id_rs_set["in_qty"] . '
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

            Database::iud("INSERT `alerts` (`msg_header`,`d-status`,`alert_msg`,`user_id`,`read_status`,`pid`,`p_img`) VALUES ('Delivery','0','Your order has been placed.','" . $user_full_data["email"] . "','0','" . $order_details["p_id"] . "','" . $product_img["img_path"] . "')");

            echo ("success");
        }
    }
} else {
    echo ("something went wrong!");
}
