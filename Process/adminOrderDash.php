<?php

session_start();
include "connection.php";
if (isset($_SESSION["admin"])) {




    $result = Database::search("SELECT * FROM `invoice` INNER JOIN `product` ON `invoice`.`p_invoice_id` = `product`.`id` ORDER BY `invoice_id` DESC LIMIT 5");
    $result_num = $result->num_rows;

    if ($result_num != 0) {

?>


        <table>
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Customer</th>
                    <th>Product</th>
                    <th>price (LKR)</th>
                    <th>Date Order</th>
                    <th>Order Code</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                for ($x = 0; $x < $result_num; $x++) {
                    $total_product_data = $result->fetch_assoc();
                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $total_product_data["id"] . "'");
                    $product_img_data = $product_img_rs->fetch_assoc();
                    $user_img_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $total_product_data["in_user_email"] . "'");
                    $user_img = $user_img_rs->fetch_assoc();
                    $product_add_date = explode(" ", $total_product_data["date"]);
                ?>



                    <tr>
                        <td style="min-width: 80px;">
                            <center><?php echo $total_product_data['invoice_id'] ?></center>
                        </td>
                        <td style="min-width: 290px;">
                            <?php
                            if (!empty($user_img['img'])) {
                                $img = $user_img['img'];
                            } else {
                                if ($user_img["gender_gender_id"] == 1) {
                                    $img = "profilepic/default/male.png";
                                } else {
                                    $img = "profilepic/default/female.png";
                                }
                            }
                            ?>
                            <div style="display: flex; align-items: center; align-content: center; cursor: pointer;">
                                <img src="<?php echo $img; ?>">
                                <p style="margin-left: 10px;"><?php echo $user_img['fname'] ?> <?php echo $user_img['lname'] ?></p>
                            </div>

                        </td>
                        <td style="min-width: 300px;">
                            <div style="display: flex; align-items: center; align-content: center;">
                                <img src="<?php echo $product_img_data["img_path"] ?>" style="border-radius: 0px; object-fit: contain;">
                                <p style="margin-left: 10px;"><?php echo $total_product_data['title'] ?></p>
                            </div>
                        </td>
                        <td style="min-width: 100px;">LKR <?php echo $total_product_data['total'] ?>.00</td>
                        <td style="min-width: 100px;"><?php echo $product_add_date['0'] ?></td>
                        <td style="min-width: 120px; pointer-events: none;">
                            <?php echo $total_product_data['order_id'] ?>
                        </td>
                        <td>
                            <?php
                            if ($total_product_data["status"] == 0) {
                            ?>
                                <button id="orderstatus<?php echo $total_product_data['invoice_id'] ?>" class="ui yellow button" style="width: 120px;" onclick="changeOrderStatus(<?php echo $total_product_data['invoice_id'] ?>);">Placed</button>
                            <?php
                            } else if ($total_product_data["status"] == 1) {
                            ?>
                                <button id="orderstatus<?php echo $total_product_data['invoice_id'] ?>" class="ui orange button" style="width: 120px;" onclick="changeOrderStatus(<?php echo $total_product_data['invoice_id'] ?>);">Packed</button>
                            <?php

                            } else if ($total_product_data["status"] == 2) {
                            ?>
                                <button id="orderstatus<?php echo $total_product_data['invoice_id'] ?>" class="ui olive button" style="width: 120px;" onclick="changeOrderStatus(<?php echo $total_product_data['invoice_id'] ?>);">Dispatched</button>
                            <?php
                            } else if ($total_product_data["status"] == 3) {
                            ?>
                                <button id="orderstatus<?php echo $total_product_data['invoice_id'] ?>" class="ui green button" style="width: 120px;" onclick="changeOrderStatus(<?php echo $total_product_data['invoice_id'] ?>);">delivered</button>
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
    } else {
        echo "No Orders Yet";
    }
} else {
    echo ("Relogin to access");
}

?>