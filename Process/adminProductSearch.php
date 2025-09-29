<?php

session_start();
include("connection.php");

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '2'");
    if ($permissionValidation->num_rows  == 1) {



        if (isset($_GET["term"])) {
            $term = $_GET["term"];
            $page = $_GET["page"];

            $product_rs = Database::search("SELECT * FROM `product` INNER JOIN `shop` ON shop.seller_id = product.user_email WHERE `title` LIKE '%" . $term . "%' OR `id` LIKE '%" . $term . "%' OR `shop_name` LIKE '%" . $term . "%'");
            $product_num = $product_rs->num_rows;

            $results_per_page = 9;
            $number_of_pages = ceil($product_num / $results_per_page);

            $page_results = ($page - 1) * $results_per_page;

            $result = Database::search("SELECT * FROM `product` INNER JOIN `shop` ON shop.seller_id = product.user_email WHERE `title` LIKE '%" . $term . "%' OR `id` LIKE '%" . $term . "%' OR `shop_name` LIKE '%" . $term . "%' ORDER BY `id` DESC LIMIT " . $results_per_page . " OFFSET " . $page_results . "");
            $result_num = $result->num_rows;

            if ($result_num != 0) {

?>


                <table>
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Product</th>
                            <th>shop</th>
                            <th>price (LKR)</th>
                            <th>Add date</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($x = 0; $x < $result_num; $x++) {
                            $total_product_data = $result->fetch_assoc();
                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $total_product_data["id"] . "'");
                            $product_img_data = $product_img_rs->fetch_assoc();
                            $product_add_date = explode(" ", $total_product_data["datetime_added"]);
                        ?>



                            <tr>
                                <td style="min-width: 80px;">
                                    <center><?php echo $total_product_data['id'] ?></center>
                                </td>

                                <td style="min-width: 300px; cursor: pointer;" onclick="openModal(<?php echo $total_product_data['id'] ?>);">
                                    <div style="display: flex; align-items: center; align-content: center;">
                                        <img src="<?php echo $product_img_data["img_path"] ?>" style="border-radius: 0px; object-fit: contain;">
                                        <p style="margin-left: 10px;"><?php echo $total_product_data['title'] ?></p>
                                    </div>
                                </td>

                                <td style="min-width: 290px;">
                                    <div style="display: flex; align-items: center; align-content: center;">
                                        <img src="resourses/shop.svg">
                                        <p style="margin-left: 10px;"><?php echo $total_product_data['shop_name'] ?></p>
                                    </div>

                                </td>

                                <td style="min-width: 100px;">LKR <?php echo $total_product_data['price'] ?>.00</td>
                                <td style="min-width: 100px;"><?php echo $product_add_date['0'] ?></td>
                                <td>
                                    <?php
                                    if ($total_product_data["admin_status"] == 2) {
                                        ?>
                                        <button id="productstatus<?php echo $total_product_data['id'] ?>" class="ui red button" style="width: 120px;" onclick="changeProductStatus(<?php echo $total_product_data['id'] ?>);">Blocked</button>
                                        <?php
                                    }else if ($total_product_data["status_status_id"] == 1) {
                                    ?>
                                        <button id="productstatus<?php echo $total_product_data['id'] ?>" class="ui blue button" style="width: 120px;" onclick="changeProductStatus(<?php echo $total_product_data['id'] ?>);">Activated</button>
                                    <?php
                                    } else if ($total_product_data["status_status_id"] == 2) {
                                    ?>
                                        <button id="productstatus<?php echo $total_product_data['id'] ?>" class="ui orange button" style="width: 120px;" onclick="changeProductStatus(<?php echo $total_product_data['id'] ?>);">Deactivated</button>
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
                                    <a class="item" onclick="searchProduct(<?php echo $x; ?>);">
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