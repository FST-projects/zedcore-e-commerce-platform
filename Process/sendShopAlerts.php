<?php

session_start();


include "connection.php";

if (isset($_SESSION["u"])) {

    if (!isset($_POST["title"]) && empty(($_POST["title"]))) {
        echo ("title");
    } else if (!isset($_POST["desc"]) && empty($_POST["desc"])) {
        echo ("desc");
    } else {
        $title = $_POST["title"];
        $desc = $_POST["desc"];

        $shop_name_rs = Database::search("SELECT * FROM `shop` WHERE `seller_id`='" . $_SESSION["u"]["email"] . "'");
        $shop_name = $shop_name_rs->fetch_assoc();

        $imgPath2 = "";
        if (isset($_FILES["image"]) && !empty($_FILES["image"])) {
            $uniq_id = uniqid();
            $imgPath = "../ProductPic/shopMsgImg/" . $uniq_id . "_" . $_FILES["image"]["name"];
            $imgPath2 = "ProductPic/shopMsgImg/" . $uniq_id. "_" . $_FILES["image"]["name"];
            move_uploaded_file($_FILES["image"]["tmp_name"], $imgPath);
        }
        $followed_user_rs = Database::search("SELECT * FROM `followed_shop` WHERE `shop_id` = '" . $shop_name["shop_id"] . "'");

        for ($i = 0; $i < $followed_user_rs->num_rows; $i++) {
            $followed_user = $followed_user_rs->fetch_assoc();
            Database::iud("INSERT `alerts` (`msg_header`,`d-status`,`alert_msg`,`user_id`,`read_status`,`shop_id`,`p_img`) VALUES ('" . $title . " | " . $shop_name["shop_name"] . "','0','$desc','" . $followed_user["user_id"] . "','0','" . $_SESSION["u"]["email"] . "','$imgPath2')");
        }
        echo ("success");
    }
} else {
    echo ("something went wrong!");
}
