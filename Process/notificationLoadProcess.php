<?php

session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    $notificatons_rs = Database::search("SELECT * FROM `alerts` WHERE `user_id` = '" . $email . "' ORDER BY `id` DESC");
    $notifications_num = $notificatons_rs->num_rows;

    if ($notifications_num > 0) {
        for ($x = 0; $notifications_num > $x; $x++) {
            $notifications = $notificatons_rs->fetch_assoc();

            if ($notifications["msg_header"] == "Delivery") {
                if (!empty($notifications["p_img"]) && !empty($notifications["pid"])) {
                    if ($notifications["d-status"] == 1) {
                        //Delivery Alerts
?>
                        <!-- Msg box -->
                        <div class="notifyMsgBox">
                            <div class="notifyHeader">
                                <?php echo $notifications["msg_header"]; ?>
                            </div>
                            <hr>
                            <div class="notifyMsg">
                                <div class="notifyImg">
                                    <img src="<?php echo $notifications["p_img"]; ?>" alt="">
                                </div>
                                <div class="notifyMsg-msg">
                                    <?php echo $notifications["alert_msg"]; ?>
                                </div>
                            </div>
                            <div class="notifyReview">
                                <button onclick="reviewOpen(<?php echo $notifications['id'] ?>);">Review Product</button>
                            </div>
                        </div>
                        <!-- Msg box -->
                    <?php
                    } else {
                        //Delivery Alerts
                    ?>
                        <!-- Msg box -->
                        <div class="notifyMsgBox" onclick="window.location='order-history.php'">
                            <div class="notifyHeader">
                                <?php echo $notifications["msg_header"]; ?>
                            </div>
                            <hr>
                            <div class="notifyMsg">
                                <div class="notifyImg">
                                    <img src="<?php echo $notifications["p_img"]; ?>" alt="">
                                </div>
                                <div class="notifyMsg-msg">
                                    <?php echo $notifications["alert_msg"]; ?>

                                </div>
                            </div>
                        </div>
                        <!-- Msg box -->
                    <?php
                    }
                }
            } else if ($notifications["msg_header"] == "Product is back!") {
                if (!empty($notifications["p_img"]) && !empty($notifications["pid"])) {
                    //Quantity Updated Products Alerts
                    ?>
                    <!-- Msg box -->
                    <div class="notifyMsgBox" style="cursor: pointer;">
                        <div class="notifyHeader" style="cursor: pointer;">
                            <?php echo $notifications["msg_header"]; ?>
                        </div>
                        <hr>
                        <div class="notifyMsg">
                            <div class="notifyImg">
                                <img src="<?php echo $notifications["p_img"]; ?>" alt="">
                            </div>
                            <div class="notifyMsg-msg">
                                <?php echo $notifications["alert_msg"]; ?>

                            </div>
                        </div>
                    </div>
                    <!-- Msg box -->
                    <?php
                }
            } else {
                if (!empty($notifications["shop_id"])) {
                    
                    $shop_name_rs = Database::search("SELECT * FROM `shop` WHERE `seller_id` = '" . $notifications["shop_id"] . "'");

                    if ($shop_name_rs->num_rows > 0) {
                        $shop_name = $shop_name_rs->fetch_assoc();


                        //Shop messages
                        if (!empty($notifications["p_img"])) {
                    ?>
                            <!-- Msg box -->
                            <div class="notifyMsgBox">
                                <div class="notifyHeader">
                                    <?php echo $notifications["msg_header"]; ?>
                                </div>
                                <hr>
                                <div class="notifyMsg">
                                    <div class="notifyImg">
                                        <img src="<?php echo $notifications["p_img"]; ?>" alt="">
                                    </div>
                                    <div class="notifyMsg-msg">
                                        <?php echo $notifications["alert_msg"]; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Msg box -->
                        <?php
                        } else {
                            //
                        ?>
                            <!-- Msg box -->
                            <div class="notifyMsgBox">
                                <div class="notifyHeader">
                                    <?php echo $notifications["msg_header"]; ?>
                                </div>
                                <hr>
                                <div class="notifyMsg">
                                    <div class="notifyMsg-msg">
                                        <?php echo $notifications["alert_msg"]; ?>

                                    </div>
                                </div>
                            </div>
                            <!-- Msg box -->
        <?php
                        }
                    }
                }
            }
        }
    } else {
        ?>
        <div class="ui message" style="padding: 10px; display: flex; align-items: center; align-content: center; justify-content: center;">No Notifications Yet</div>

<?php
    }
}
