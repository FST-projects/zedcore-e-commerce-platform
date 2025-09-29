<?php


session_start();

include "connection.php";

if (isset($_SESSION["u"])) {
    $sender = $_SESSION["u"]["email"];

    if (!empty($sender)) {
        $admin_rs = Database::search("SELECT * FROM `admin` LIMIT 1");
        $admin = $admin_rs->fetch_assoc();
        $msg_rs = Database::search("SELECT * FROM `msgadmin` WHERE `sender` = '" . $sender . "' AND `receiver` = '" . $admin["admin_email"] . "' OR `sender` = '" . $admin["admin_email"] . "' AND `receiver` = '" . $sender . "' ORDER BY `date` ASC");

        if ($msg_rs->num_rows > 0) {
            for ($x = 0; $msg_rs->num_rows > $x; $x++) {
                $msg = $msg_rs->fetch_assoc();
                if ($msg["sender"] == $sender) {
?>
                    <div class="sendMsgBox">
                        <div class="sendMsg">
                            <?php echo $msg["content"] ?>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div class="recMsgBox">
                        <div class="recMsg">
                            <?php echo $msg["content"] ?>

                        </div>
                    </div>
            <?php
                }
            }
        }
    }
} else if (isset($_SESSION["admin"])) {
    $admin = $_SESSION["admin"];


    if (!empty($admin)) {
        if (isset($_GET["cid"])) {
            $cid = $_GET["cid"];

            $user_details_rs = Database::search("SELECT * FROM `user` WHERE `id` = '" . $cid . "'");
            $user = $user_details_rs->fetch_assoc();
        }
        $msg_rs = Database::search("SELECT * FROM `msgadmin` WHERE `sender` = '" . $user["email"] . "' AND `receiver` = '" . $admin["admin_email"] . "' OR `sender` = '" . $admin["admin_email"] . "' AND `receiver` = '" . $user["email"] . "' ORDER BY `date` ASC");

        
        if ($msg_rs->num_rows > 0) {
            
                for ($x = 0; $msg_rs->num_rows > $x; $x++) {
                    $msg = $msg_rs->fetch_assoc();
                    if ($msg["sender"] == $admin["admin_email"]) {
                ?>
                        <div class="sendMsgBox">
                            <div class="sendMsg">
                                <?php echo $msg["content"] ?>
                            </div>
                        </div>

                    <?php
                    } else {
                    ?>
                        <div class="recMsgBox">
                            <div class="recMsg">
                                <?php echo $msg["content"] ?>

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
