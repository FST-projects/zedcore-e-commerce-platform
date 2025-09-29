<?php

include "connection.php";
session_start();

if (isset($_SESSION["u"])) {
    if ($_SESSION["u"]["sell_approve"] == 1) {


        $product_rs = Database::search("SELECT title,product.id FROM `question` INNER JOIN `product` ON product.id = question.pid WHERE `user_email` = '" . $_SESSION["u"]["email"] . "' GROUP BY `pid`;");

        if ($product_rs->num_rows > 0) {
            for ($x = 0; $x < $product_rs->num_rows; $x++) {
                $product_pid = $product_rs->fetch_assoc();

                $last_qes_rs = Database::search("SELECT `question` FROM `question` WHERE `pid` = '" . $product_pid["id"] . "' ORDER BY `time` DESC");
                $last_qes = $last_qes_rs->fetch_assoc();
                $unreadQuest_rs = Database::search("SELECT `question` FROM `question` WHERE `msg_status` = '0' AND `pid` = '" . $product_pid["id"] . "'");
                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $product_pid["id"] . "'");
                $product_img = $product_img_rs->fetch_assoc();
?>
                <div class="cusCard" onclick="openChatAdmin(<?php echo $product_pid['id'] ?>);">
                    <div class="cusImage">
                        <img src="<?php echo $product_img["img_path"] ?>" alt="">
                    </div>
                    <div class="cusDetails">
                        <span style="font-size: 16px; font-weight: 500;"><?php echo $product_pid["title"] ?></span>
                        <span><?php echo $last_qes["question"] ?></span>
                    </div>
                    <?php
                    if ($unreadQuest_rs->num_rows > 0) {
                    ?>
                        <div class="questNum">
                            <span><?php echo $unreadQuest_rs->num_rows; ?></span>
                        </div>
                    <?php
                    }
                    ?>

                </div>
            <?php
            }
        } else {
            ?>

            <div class="noquest">
                No Questions yet
            </div>

<?php
        }
    } else {
        echo ("not a seller");
    }
} else {
    echo ("fail");
}


?>