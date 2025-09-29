<div class="doubling four column row">


    <?php



    session_start();
    include "connection.php";

    if (isset($_SESSION["u"])) {
        $user_ses = $_SESSION["u"];

        if (isset($_GET["page"])) {
            $pageno = $_GET["page"];
        }

        if ($pageno == 0) {
            $pageno = 1;
        }


        $user_all_pro_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user_ses["email"] . "'");
        $user_all_pro_num = $user_all_pro_rs->num_rows;

        $results_per_page = 8;
        $number_of_pages = ceil($user_all_pro_num / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $user_product_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user_ses["email"] . "' LIMIT " . $results_per_page . " OFFSET " . $page_results . "");


        if ($user_product_rs->num_rows > 0) {
            for ($x = 0; $x < $user_product_rs->num_rows; $x++) {
                $user_product_data = $user_product_rs->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $user_product_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

                if ($user_product_data["admin_status"] == 1) {
                    if ($user_product_data["status_status_id"] == 1) {
    ?>
                        <!--Active card-->
                        <div class="column" style="padding-bottom: 20px; padding-left:20px;">
                            <div class="ui card">
                                <div class="image" style="background-color: white;">
                                    <img class="img-box" src="<?php echo $product_img_data["img_path"] ?>" style="height: 200px; object-fit: contain;">
                                </div>
                                <div class="content">
                                    <span class=" fontSize1"><?php echo $user_product_data["title"]; ?></span>
                                    <div class="meta">
                                        <?php
                                        $date_rs = Database::search("SELECT DATE(datetime_added) AS dateonly FROM `product` WHERE `id` = '" . $user_product_data["id"] . "';");
                                        $date = $date_rs->fetch_assoc();
                                        ?>
                                        <span class="date fontSize2">Added on <?php echo $date["dateonly"] ?></span>
                                    </div>
                                    <div class="fontSize3">
                                        Rs <?php echo $user_product_data["price"]; ?>.00
                                    </div>

                                </div>
                                <div class="extra content" style="padding: 0px; height:80px;">
                                    <button onclick="changeStatus(<?php echo $user_product_data['id']; ?>);" class="ui green button updateBtn" style="border-radius: 0px;">Activated</button>
                                    <button onclick="updatebtn(<?php echo $user_product_data['id']; ?>);" class="updateBtn">Update</button>

                                </div>
                            </div>
                        </div>
                        <!--Active card-->

                    <?php
                    } else {
                    ?>
                        <!--Deactive card-->
                        <div class="column" style="padding-bottom: 20px; padding-left:20px;">
                            <div class="ui card">
                                <div class="image" style="background-color: white;">
                                    <img src="<?php echo $product_img_data["img_path"] ?>" style="opacity: 0.6; height: 200px; object-fit: contain;">
                                </div>
                                <div class="content">
                                    <span class=" fontSize1" style="color: rgb(151, 151, 151);"><?php echo $user_product_data["title"]; ?></span>
                                    <div class="meta">
                                        <?php
                                        $date_rs = Database::search("SELECT DATE(datetime_added) AS dateonly FROM `product` WHERE `id` = '" . $user_product_data["id"] . "';");
                                        $date = $date_rs->fetch_assoc();
                                        ?>
                                        <span class="date fontSize2">Added on <?php echo $date["dateonly"] ?></span>
                                    </div>
                                    <div class="fontSize3" style="color: rgb(124, 124, 124);">
                                        Rs <?php echo $user_product_data["price"]; ?>.00
                                    </div>

                                </div>
                                <div class="extra content" style="padding: 0px; height:80px;">
                                    <button onclick="changeStatus(<?php echo $user_product_data['id']; ?>);" class="ui red button updateBtn" style="border-radius: 0px;">Deactivated</button>
                                    <button onclick="updatebtn(<?php echo $user_product_data['id']; ?>);" class="updateBtn">Update</button>

                                </div>
                            </div>
                        </div>
                        <!--Deactive card-->

                    <?php

                    }
                } else {
                    ?>
                    <!--Deactive card-->
                    <div class="column" style="padding-bottom: 20px; padding-left:20px;">
                        <div class="ui card">
                            <div class="image" style="background-color: white;">
                                <img src="<?php echo $product_img_data["img_path"] ?>" style="opacity: 0.6; height: 200px; object-fit: contain;">
                            </div>
                            <div class="content">
                                <span class=" fontSize1" style="color: rgb(151, 151, 151);"><?php echo $user_product_data["title"]; ?></span>
                                <div class="meta">
                                    <?php
                                    $date_rs = Database::search("SELECT DATE(datetime_added) AS dateonly FROM `product` WHERE `id` = '" . $user_product_data["id"] . "';");
                                    $date = $date_rs->fetch_assoc();
                                    ?>
                                    <span class="date fontSize2">Added on <?php echo $date["dateonly"] ?></span>
                                </div>
                                <div class="fontSize3" style="color: rgb(124, 124, 124);">
                                    Rs <?php echo $user_product_data["price"]; ?>.00
                                </div>

                            </div>
                            <div class="extra content" style="padding: 0px; height:80px;">
                                <button onclick="adminBlockPd();" class="ui red button updateBtn" style="border-radius: 0px;">Deactivated</button>
                                <button onclick="adminBlockPd();" class="updateBtn">Update</button>

                            </div>
                        </div>
                    </div>
                    <!--Deactive card-->

            <?php
                }
            }
        } else {
            ?>
            <center style="width: 100%;">
                <div style="padding-top: 40px; padding-bottom: 40px;">
                    <div>
                        <img src="resourses/empty (2).svg" class="statimg" alt="">
                    </div>
                    <br>
                    <span class="statfontz">No Products Yet!</span>
                </div>
            </center>

    <?php
        }
    }
    ?>

</div>
<br><br>
<?php
if ($number_of_pages != 0) {
?>
    <div style=" display: flex; justify-content: center; padding-bottom: 30px; width: 100%;">
        <div class="ui pagination menu">

            <?php
            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $pageno) {
            ?>
                    <a class="active item">
                        <?php echo $x ?>
                    </a>
                <?php
                } else {
                ?>
                    <a class="item" onclick="clearFil(<?php echo $x; ?>);">
                        <?php echo $x ?>
                    </a>
            <?php
                }
            }

            ?>


        </div>
    </div>
<?php
}
?>