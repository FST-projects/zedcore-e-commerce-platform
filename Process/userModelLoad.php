<?php

include "connection.php";

if (isset($_GET["pid"])) {
    $pid = $_GET["pid"];

    $user_rs = Database::search("SELECT * FROM `user` LEFT JOIN `user_has_address` ON `user_has_address`.`user_email` = `user`.`email` WHERE `id` = '" . $pid . "'");
    $user_data = $user_rs->fetch_assoc();

    $sold_rs = Database::search("SELECT * FROM `invoice` WHERE `in_user_email` = '" . $user_data["email"] . "'");
    $sold = $sold_rs->num_rows;

    $joined_date = explode(" ",$user_data["joined_date"]);

    if ($user_rs->num_rows == 1) {
?>
        <i class="close icon"></i>
        <div class="header">
            <?php echo $user_data["fname"]; ?> <?php echo $user_data["lname"]; ?>
        </div>
        <?php
        if (!empty($user_data['img'])) {
            $img = $user_data['img'];
        } else {
            if ($user_data["gender_gender_id"] == 1) {
                $img = "profilepic/default/male.png";
            } else {
                $img = "profilepic/default/female.png";
            }
        }

        if($user_data["gender_gender_id"] == 1){
            $gender = "Male";
        }else{
            $gender = "Female";
        }

        

        if($user_data["sell_approve"] == 0){
            $sell = "No";
        }else if($user_data["sell_approve"] == 1){
            $sell = "Yes";
        }
        ?>
        <div class="image content">
            <div class="ui medium image">
                <img src="<?php echo $img; ?>">
            </div>
            <div class="description">
                <div class="modeldescrip">
                    <span class="outfit" style="font-size: 20px; font-weight: 500;">Name : </span><span style="font-size: 18px;"><?php echo $user_data["fname"]; ?> <?php echo $user_data["lname"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span class="outfit" style="font-size: 20px; font-weight: 500;">Gender : </span><span style="font-size: 18px;"><?php echo $gender; ?></span>
                </div>
                <div class="modeldescrip">
                    <span class="outfit" style="font-size: 20px; font-weight: 500;">Email : </span><span style="font-size: 18px;"><?php echo $user_data["email"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Mobile : </span><span style="font-size: 18px;"><?php echo $user_data["mobile"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Joined Date : </span><span style="font-size: 18px;"><?php echo $joined_date["0"]; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Number of purchased items : </span><span style="font-size: 18px;"><?php echo $sold; ?></span>
                </div>
                <div class="modeldescrip">
                    <span style="font-size: 20px; font-weight: 500;">Sell Approval : </span><span style="font-size: 18px;"><?php echo $sell; ?></span>
                </div>
            </div>
        </div>
        <div class="actions">
            <div style="position: absolute; height: 35px; display: flex; align-items: center; align-content: center;">
                <div class="ui star rating" data-rating="4" data-max-rating="5"></div>
                <span></span>
            </div>
            <div class="ui black deny button">
                Close
            </div>
        </div>

<?php
    }
} else {
    echo ("Something went wrong! please reload and try again.");
}

?>