<div class="doubling four column row">
    <?php

    session_start();
    include "connection.php";

    if (isset($_SESSION["u"])) {
        $user = $_SESSION['u'];

        if (isset($_POST["page"])) {
            $pageno = $_POST["page"];
        }

        if ($pageno == 0) {
            $pageno = 1;
        }



        $query = "SELECT * FROM `product` WHERE `user_email` = '" . $user["email"] . "'";


        if (!empty($_POST["pid"])) {

            $pid = $_POST["pid"];

            $query .= " AND `id` = '" . $pid . "'";
        } else {


            if (isset($_POST["s"])) {
                $searched_Txt = $_POST["s"];
            }
            if (isset($_POST["max"]) && !empty($_POST["max"])) {
                if (is_numeric($_POST["max"])) {
                    $maxPrice = $_POST["max"];
                } else {
                    echo ("Enter valid price range");
                    exit;
                }
            }
            if (isset($_POST["min"]) && !empty($_POST["min"])) {
                if (is_numeric($_POST["min"])) {
                    $minPrice = $_POST["min"];
                } else {
                    echo ("Enter valid price range");
                    exit;
                }
            }


            if (isset($_POST["c"])) {
                $category = $_POST["c"];
            }
            if (isset($_POST["c2"])) {
                $category2 = $_POST["c2"];
            }


            if (isset($_POST["condi"])) {
                $condition = $_POST["condi"];
            }







            if (!empty($searched_Txt)) {

                $query .= " AND `title` LIKE '%" . $searched_Txt . "%'";
            }

            if (!empty($minPrice) && !empty($maxPrice)) {
                $query .= " AND `price` BETWEEN '" . $minPrice . "' AND '" . $maxPrice . "'";
            } else if (!empty($minPrice)) {
                $query .= " AND `price` >= '" . $minPrice . "'";
            } else if (!empty($maxPrice)) {
                $query .= " AND `price` <= '" . $maxPrice . "'";
            }

            if (!empty($category) && $category != 0) {
                $query .= " AND `category_cat_id` = '" . $category . "'";
            }
            if (!empty($category2 && $category2 != 0)) {
                $query .= " AND `category_cat_id` = '" . $category2 . "'";
            }

            if ($condition != 0) {
                if ($condition == 1) {
                    $query .= " AND `condition_condition_id` = '" . $condition . "'";
                } else if ($condition == 2) {
                    $query .= " AND `condition_condition_id` = '" . $condition . "'";
                }
            }
        }

        if (isset($_POST["sort"])) {
            $sort = $_POST["sort"];
        }


        if (!empty($sort)) {
            if ($sort == 0) {
            } else if ($sort == 1) {
            } else if ($sort == 2) {
                $query .= " ORDER BY `price` ASC";
            } else if ($sort == 3) {
                $query .= " ORDER BY `price` DESC";
            } else if ($sort == 4) {
                $query .= " ORDER BY `datetime_added` DESC";
            } else if ($sort == 5) {
                $query .= " ORDER BY `datetime_added` ASC";
            }
        }








        $user_result = Database::search($query);
        $user_all_result = $user_result->num_rows;

        $results_per_page = 8;
        $number_of_pages = ceil($user_all_result / $results_per_page);

        $page_results = ($pageno - 1) * $results_per_page;
        $query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

        $result = Database::search($query);
        $result_num = $result->num_rows;



        if ($result_num != 0) {


            for ($x = 0; $x < $result->num_rows; $x++) {
                $result_data = $result->fetch_assoc();

                $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $result_data["id"] . "'");
                $product_img_data = $product_img_rs->fetch_assoc();

                if ($result_data["status_status_id"] == 1) {
    ?>
                    <!--Active card-->
                    <div class="column" style="padding-bottom: 20px; padding-left:20px;">
                        <div class="ui card">
                            <div class="image" style="background-color: white;">
                                <img class="img-box" src="<?php echo $product_img_data["img_path"] ?>" style="height: 200px; object-fit: contain;">
                            </div>
                            <div class="content">
                                <span class=" fontSize1"><?php echo $result_data["title"]; ?></span>
                                <div class="meta">
                                    <?php
                                    $date_rs = Database::search("SELECT DATE(datetime_added) AS dateonly FROM `product` WHERE `id` = '" . $result_data["id"] . "';");
                                    $date = $date_rs->fetch_assoc();
                                    ?>
                                    <span class="date fontSize2">Added on <?php echo $date["dateonly"] ?></span>
                                </div>
                                <div class="fontSize3">
                                    Rs <?php echo $result_data["price"]; ?>.00
                                </div>

                            </div>
                            <div class="extra content" style="padding: 0px; height:80px;">
                                <button onclick="changeStatus(<?php echo $result_data['id']; ?>);" class="ui green button updateBtn" style="border-radius: 0px;">Activated</button>
                                <button onclick="updatebtn(<?php echo $result_data['id']; ?>);" class="updateBtn">Update</button>

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
                                <span class=" fontSize1" style="color: rgb(151, 151, 151);"><?php echo $result_data["title"]; ?></span>
                                <div class="meta">
                                    <?php
                                    $date_rs = Database::search("SELECT DATE(datetime_added) AS dateonly FROM `product` WHERE `id` = '" . $result_data["id"] . "';");
                                    $date = $date_rs->fetch_assoc();
                                    ?>
                                    <span class="date fontSize2">Added on <?php echo $date["dateonly"] ?></span>
                                </div>
                                <div class="fontSize3" style="color: rgb(124, 124, 124);">
                                    Rs <?php echo $result_data["price"]; ?>.00
                                </div>
                            </div>

                        </div>
                        <div class="extra content" style="padding: 0px; height:80px;">
                            <button onclick="changeStatus(<?php echo $result_data['id']; ?>);" class="ui red button updateBtn" style="border-radius: 0px;">Deactivated</button>
                            <button onclick="updatebtn(<?php echo $result_data['id']; ?>);" class="updateBtn">Update</button>

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
    <div style="display: grid; padding-top: 160px; padding-bottom: 160px;">
        <div>
            <img src="resourses/no-results.png" style="width: 120px;" alt="">
        </div>

        <div style="font-size: 24px;">
            No result Found!
        </div>

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
                    <a class="item" onclick="filter(<?php echo $x; ?>);">
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