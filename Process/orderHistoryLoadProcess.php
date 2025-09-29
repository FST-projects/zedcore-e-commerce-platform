<?php
include "connection.php";
session_start();
$user_ses = $_SESSION["u"];
$email = $_SESSION["u"]["email"];

$page = 1;
if (isset($_POST["page"]) && !empty($_POST["page"])) {
    $page = $_POST["page"];
}
$order_details_rs = Database::search("SELECT * FROM `purchase_history` WHERE `u_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `h_id` DESC");

$order_details = $order_details_rs->num_rows;

$results_per_page = 5;
$resultPage = 5 * $page;
$number_of_pages = ceil($order_details / $results_per_page);

$order_details_rs = Database::search("SELECT * FROM `purchase_history` WHERE `u_id` = '" . $_SESSION["u"]["id"] . "' ORDER BY `h_id` DESC LIMIT " . $resultPage . "");

if ($order_details_rs->num_rows > 0) {
?>
    <table class="ui unstackable table">
        <thead>
            <tr>
                <th>Product</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Payment</th>
            </tr>
        </thead>
        <tbody>

            <?php




            for ($i = 0; $i < $order_details_rs->num_rows; $i++) {
                $list = $order_details_rs->fetch_assoc();

                $product_details_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id` WHERE `product`.`id` = '" . $list['p_id'] . "'");
                $product_details = $product_details_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $list['p_id'] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();


            ?>
                <tr onclick="window.location='pending-purchase.php?i=<?php echo $list['or_id'] ?>'" style="cursor: pointer;">
                    <td>
                        <h4 class="ui image header">
                            <img src="<?php echo $product_img_data["img_path"] ?>" class="ui rounded image">
                            <div class="content">
                                <?php echo $product_details["title"] ?>
                                <div class="sub header"><?php echo $product_details["brand_name"] ?>
                                </div>
                            </div>
                        </h4>
                    </td>
                    <td>
                        <?php echo $list["qty"]; ?>
                    </td>
                    <td>
                        <?php
                        $order_status_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $list['or_id'] . "'");

                        if ($order_status_rs->num_rows > 0) {
                            $order_status = $order_status_rs->fetch_assoc();
                            if ($order_status["status"] == "0") {
                        ?>
                                <button class="ui orange basic button" style="width: 110px;">Placed</button>
                            <?php
                            } else if ($order_status["status"] == "1") {
                            ?>
                                <button class="ui yellow basic button" style="width: 110px;">Packed</button>
                            <?php
                            } else if ($order_status["status"] == "2") {
                            ?>
                                <button class="ui olive basic button" style="width: 110px;">Depatched</button>
                            <?php
                            } else if ($order_status["status"] == "3") {
                            ?>
                                <button class="ui green basic button" style="width: 110px;">Delivered</button>
                        <?php

                            }
                        } else {
                        }
                        ?>
                    </td>
                    <td>
                        <?php
                        if ($list["status"] == 1) {
                        ?>

                            <button class="ui green basic button" style="width: 90px;">Paid</button>


                        <?php
                        } else {
                        ?>
                            <button class="ui red basic button" style="width: 90px;">Pending</button>
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
    <?php

    if ($number_of_pages > $page) {
    ?>
        <div style="margin-top: 40px; width: 100%; display: flex; align-items: center; justify-content: center; height: 45px;">
            <button class="ui blue button" id="loadMoreBtn" onclick="btnHistoryLoad(<?php echo ($page + 1) ?>);">LOAD MORE</button>
        </div>
    <?php
    }
    ?>

<?php
} else {
?>
    <center>
        <div style="padding-top: 30px; padding-bottom: 40px;">
            <div>
                <img src="resourses/not found.svg" class="statimg" alt="">
            </div>
            <br>
            <span class="statfontz">No Orders Yet</span>
        </div>
    </center>
<?php
}
?>