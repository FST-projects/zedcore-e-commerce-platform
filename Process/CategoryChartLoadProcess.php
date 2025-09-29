<?php
session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '9'");
    if ($permissionValidation->num_rows  == 1) {

        $result = Database::search("SELECT COUNT(category.cat_id) AS cat_num, category.cat_name FROM invoice INNER JOIN product ON product.id = invoice.p_invoice_id INNER JOIN category ON category.cat_id = product.category_cat_id GROUP BY category.cat_name");

        if ($result->num_rows > 0) {
            $cat_names = [];
            $amount = [];
            for ($i = 0; $i < $result->num_rows; $i++) {
                $row = $result->fetch_assoc();
                $cat_names[] = $row["cat_name"];
                $amount[] = $row["cat_num"];
            }

            $json = [];
            $json["names"] = $cat_names;
            $json["num"] = $amount;
            
            echo json_encode($json);
        } else {
            echo ("noresult");
        }
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}
