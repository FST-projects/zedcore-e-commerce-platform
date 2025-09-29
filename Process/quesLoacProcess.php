<?php
session_start();
include "connection.php";
$pid = $_POST["pid"];
$question_rs = Database::search("SELECT * FROM `question` INNER JOIN `user` ON `user`.email = `question`.ques_user_id INNER JOIN `product` ON `product`.id = `question`.pid 
INNER JOIN `shop` ON `shop`.seller_id = `product`.user_email WHERE `pid` = '" . $pid . "' ORDER BY `time` DESC");

if ($question_rs->num_rows > 0) {
    for ($z = 0; $question_rs->num_rows > $z; $z++) {
        $question_data = $question_rs->fetch_assoc();
        if (!empty($question_data["answer"])) {
?>
            <div style="margin-top: 10px;">
                <div class="customQues">
                    <div class="quesName" style="color: rgb(6, 98, 236);">
                        <?php echo $question_data["fname"] ?> <?php echo $question_data["lname"] ?>
                    </div>
                    <div class="Ques">
                        <?php echo $question_data["question"] ?>
                    </div>
                </div>
                <div class="sellerAns">
                    <div class="quesName" style="color: orange;">
                        <?php echo $question_data['shop_name'] ?>
                    </div>
                    <div class="Ques">
                        <?php echo $question_data["answer"] ?>
                    </div>
                </div>
            </div>
        <?php
        } else {
        ?>
            <div style="margin-top: 10px;">
                <div class="customQues" style="border-radius: 8px;">
                    <div class="quesName" style="color: rgb(6, 98, 236);">
                        <?php echo $question_data["fname"] ?> <?php echo $question_data["lname"] ?>
                    </div>
                    <div class="Ques">
                        <?php echo $question_data["question"] ?>
                    </div>
                </div>
            </div>
    <?php
        }
    }
} else {
    ?>
    <center>
        <div>
            <div>
                <img src="resourses/questions.svg" class="emptysizing" alt="">
            </div>
            <div class="fred fontsiz" style="margin-top: 10px;">
                No Questions Yet
            </div>
        </div>
    </center>
<?php
}
?>