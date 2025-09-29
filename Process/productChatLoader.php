<?php


session_start();

include "connection.php";

if (isset($_SESSION["u"])) {
    $email = $_SESSION["u"]["email"];

    if ($_SESSION["u"]["sell_approve"] == 1) {




        if (!empty($_GET["cid"])) {
            $cid = $_GET["cid"];

            $loadquest_rs = Database::search("UPDATE `question` SET `msg_status`='1' WHERE `pid` = '" . $cid . "'");
            $loadquest_rs = Database::search("SELECT * FROM `question` WHERE `pid` = '" . $cid . "'");

            $product_detail_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $cid . "'");
            $product_detail = $product_detail_rs->fetch_assoc();

            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $cid . "'");
            $product_img = $product_img_rs->fetch_assoc();

            if ($loadquest_rs->num_rows > 0) {
?>
                <div class="chathead">
                    <div class="arrow" onclick="closeChatAdmin();">
                        <i class='bx bx-left-arrow-alt'></i>
                    </div>
                    <div style="position: absolute; display: flex; align-items: center; right: 0;">
                        <div class="ChatName">
                            <?php echo $product_detail["title"] ?>
                        </div>
                        <div class="chatImg">
                            <img src="<?php echo $product_img["img_path"] ?>" alt="">
                        </div>
                    </div>
                </div>

                <div class="scrollBox" id="scrollBoxchat">
                    <!-- msg loads here -->

                    <?php
                    for ($x = 0; $loadquest_rs->num_rows > $x; $x++) {
                        $loadQuest = $loadquest_rs->fetch_assoc();
                        if (!empty($loadQuest["answer"])) {
                    ?>
                            <div class="duoBox">
                                <div class="recMsgBox">
                                    <div class="recMsg">
                                        <?php echo $loadQuest["question"] ?>
                                    </div>
                                </div>
                                <div class="sendMsgBox">
                                    <div class="sendMsg">
                                        <?php echo $loadQuest["answer"] ?>
                                    </div>
                                </div>
                            </div>

                        <?php
                        } else {
                        ?>
                            <div class="duoBox">
                                <div class="recMsgBox">
                                    <div class="recMsg">
                                        <?php echo $loadQuest["question"] ?>
                                    </div>
                                </div>
                                <div class="sendMsgBox" id="sendMsgBox">
                                    <div class="inputMsg">
                                        <form action="#" class="inputMsg" style="padding: 0;">
                                            <input type="text" placeholder="Answer" id="typedTxt<?php echo $loadQuest['id'] ?>" onclick="stopLoop();">
                                            <button class="portsend" type="submit" onclick="UpAnswer(<?php echo $loadQuest['id'] ?>);">
                                                <i class='bx bxs-send'></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>

<?php
            }
        }
    }
}
