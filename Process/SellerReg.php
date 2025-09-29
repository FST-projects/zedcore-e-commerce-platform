<?php


session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION['u']["email"];

    $pw = $_POST["pw"];
    $shopnm = $_POST["shop"];

    if (empty($shopnm)) {
        echo ("Please provide your shop name!");
    } else if (empty($pw)) {
        echo ("Enter your zedcore password!");
    } else {
        $valid_user = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "' AND `password` = '" . $pw . "'");
        if ($valid_user->num_rows == 1) {
            $seller_user = Database::search("SELECT * FROM `user` INNER JOIN `shop` ON `shop`.seller_id = `user`.email WHERE `seller_id` = '" . $email . "' AND `password` = '" . $pw . "' AND `sell_approve` = '0'");
            if ($seller_user->num_rows == 0) {
                $d = new DateTime();
                $tz = new DateTimeZone("Asia/Colombo");
                $d->setTimezone($tz);
                $date = $d->format("Y-m-d H:i:s");

                Database::iud("UPDATE `user` SET `sell_approve` = '1' WHERE `email` = '" . $email . "'");
                Database::iud("INSERT INTO `shop` (`seller_id`,`shop_name`,`shop_jonied_date`,`shop_status`) VALUES ('" . $email . "','" . $shopnm . "','".$date."','1')");
                echo ("success");
            } else {
                echo ("It seems to like you already have an Account!");
            }
        } else {
            echo ("Invalid User!");
        }
    }
} else {
    header("Location: ../signin.php");
}
