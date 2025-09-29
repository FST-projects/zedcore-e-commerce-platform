<?php

include "connection.php";
session_start();

if (isset($_SESSION["admin"])) {
    $chat_rs = Database::search("SELECT sender FROM msgadmin GROUP BY sender HAVING `sender` NOT IN ('fstwhatsapp@gmail.com');");

    if ($chat_rs->num_rows > 0) {
        for ($x = 0; $x < $chat_rs->num_rows; $x++) {
            $chat = $chat_rs->fetch_assoc();
            $chat_details_Rs = Database::search("SELECT * FROM `msgadmin` WHERE `sender` = '" . $chat["sender"] . "' ORDER BY `date` DESC");
            $chat_details = $chat_details_Rs->fetch_assoc();
            $user_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $chat["sender"] . "'");
            $user = $user_rs->fetch_assoc();

            if (empty($user["img"])) {
                if ($user["gender_gender_id"] == 1) {
                    $img = "profilepic/default/male.png";
                } else {
                    $img = "profilepic/default/female.png";
                }
            } else {
                $img = $user["img"];
            }

?>
            <div class="cusCard" onclick="openChatAdmin(<?php echo $user['id'] ?>);">
                <div class="cusImage">
                    <img src="<?php echo $img ?>" alt="">
                </div>
                <div class="cusDetails">
                    <span style="font-size: 16px; font-weight: 500;"><?php echo $user["fname"] ?> <?php echo $user["lname"] ?></span>
                    <span><?php echo $chat_details["content"] ?></span>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="noquest">
            No Chats
        </div>
<?php
    }
}


?>