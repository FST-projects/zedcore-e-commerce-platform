<?php

session_start();
include "connection.php";
if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '6'");
    if ($permissionValidation->num_rows  == 1) {



        if (isset($_GET["term"])) {
            $term = $_GET["term"];
            $page = $_GET["page"];

            $invoice_rs = Database::search("SELECT * FROM shop INNER JOIN user ON user.email = shop.seller_id WHERE `shop_name` LIKE '%" . $term . "%' OR `shop_id` LIKE '%" . $term . "%' OR `email` LIKE '%" . $term . "%' OR `fname` LIKE '%" . $term . "%' OR `lname` LIKE '%" . $term . "%'");
            $invoice_num = $invoice_rs->num_rows;

            $results_per_page = 9;
            $number_of_pages = ceil($invoice_num / $results_per_page);

            $page_results = ($page - 1) * $results_per_page;

            $result = Database::search("SELECT * FROM shop INNER JOIN user ON user.email = shop.seller_id WHERE `shop_name` LIKE '%" . $term . "%' OR `shop_id` LIKE '%" . $term . "%' OR `email` LIKE '%" . $term . "%' OR `fname` LIKE '%" . $term . "%' OR `lname` LIKE '%" . $term . "%' ORDER BY `shop_id` DESC LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
            $result_num = $result->num_rows;

            if ($result_num != 0) {

?>


                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Shop</th>
                            <th>Seller</th>
                            <th>Created Date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($x = 0; $x < $result_num; $x++) {
                            $total_product_data = $result->fetch_assoc();
                            $product_add_date = explode(" ", $total_product_data["shop_jonied_date"]);

                        ?>


                            <tr>
                                <td style="min-width: 80px; pointer-events: none;">
                                    <center><?php echo $total_product_data['shop_id'] ?></center>
                                </td>
                                <td style="min-width: 250px;">
                                    <?php
                                    if (!empty($total_product_data['shop_pic'])) {
                                        $imgshop = $total_product_data['shop_pic'];
                                    } else {

                                        $imgshop = "resourses/shop.svg";
                                    }
                                    ?>
                                    <div style="display: flex; align-items: center; align-content: center; pointer-events: none;">
                                        <img src="<?php echo $imgshop; ?>">
                                        <p style="margin-left: 10px;"><?php echo $total_product_data["shop_name"]; ?></p>
                                    </div>
                                </td>
                                <td style="min-width: 290px;">
                                    <?php
                                    if (!empty($total_product_data['img'])) {
                                        $img = $total_product_data['img'];
                                    } else {
                                        if ($total_product_data["gender_gender_id"] == 1) {
                                            $img = "profilepic/default/male.png";
                                        } else {
                                            $img = "profilepic/default/female.png";
                                        }
                                    }
                                    ?>
                                    <div style="display: flex; align-items: center; align-content: center;  pointer-events: none;">
                                        <img src="<?php echo $img; ?>">
                                        <p style="margin-left: 10px;"><?php echo $total_product_data['fname'] ?> <?php echo $total_product_data['lname'] ?></p>
                                    </div>
                                </td>

                                <td style="min-width: 100px; pointer-events: none;"><?php echo $product_add_date['0'] ?></td>
                                <td>
                                    <?php
                                    if ($total_product_data["shop_status"] == 1) {
                                    ?>
                                        <button id="shopstatus<?php echo $total_product_data['shop_id'] ?>" class="ui teal button" style="width: 120px;" onclick="changeShoptStatus(<?php echo $total_product_data['shop_id'] ?>);">Activated</button>
                                    <?php
                                    } else if ($total_product_data["shop_status"] == 2) {
                                    ?>
                                        <button id="shopstatus<?php echo $total_product_data['shop_id'] ?>" class="ui red button" style="width: 120px;" onclick="changeShoptStatus(<?php echo $total_product_data['shop_id'] ?>);">Blocked</button>
                                    <?php
                                    }
                                    ?>
                                </td>
                            </tr>

                        <?php
                        }
                        ?>


                    </tbody>
                </table>
                <center>
                    <div style=" display: flex; justify-content: center; margin-top: 20px; align-items: center; align-content: center;  width: 100%;">
                        <div class="ui pagination menu">

                            <?php

                            for ($x = 1; $x <= $number_of_pages; $x++) {
                                if ($x == $page) {
                            ?>
                                    <a class="active item">
                                        <?php echo $x ?>
                                    </a>
                                <?php
                                } else {
                                ?>
                                    <a class="item" onclick="searchShop(<?php echo $x; ?>);">
                                        <?php echo $x ?>
                                    </a>
                            <?php
                                }
                            }

                            ?>


                        </div>
                    </div>
                </center>


<?php
            }
        } else {
            header("location = 'admin.php'");
        }
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}
?>