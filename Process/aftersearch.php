<?php

session_start();
include "connection.php";

$sTerm = $_POST["s"];

if (isset($_POST["max"]) && !empty($_POST["max"])) {
    if (is_numeric($_POST["max"])) {
        $maxValue = $_POST["max"];
    } else {
        echo ("Enter valid price range");
        exit;
    }
}
if (isset($_POST["min"]) && !empty($_POST["min"])) {
    if (is_numeric($_POST["min"])) {
        $maxValue = $_POST["min"];
    } else {
        echo ("Enter valid price range");
        exit;
    }
}

$category2 = $_POST["c2"];
$category = $_POST["c"];
$brand = $_POST["b"];
$model = $_POST["m"];
$clr = $_POST["clr"];
$condition = $_POST["condi"];
$sort = $_POST["sort"];
$page = $_POST["page"];



$query = "SELECT `product`.id,`product`.price,
`product`.title,`shop`.shop_name AS shop,`shop`.`shop_id`,`status_status_id` FROM `product` 
INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `shop` ON `shop`.`seller_id` = `product`.user_email INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id` 
INNER JOIN `model` ON `model`.`model_id` = `model_has_brand`.`model_model_id` INNER JOIN `product_has_color` ON `product_has_color`.`product_id` = `product`.id";





if (!empty($sTerm)) {

    $query .= " WHERE `title` LIKE '%" . $sTerm . "%'";
}

if (!empty($minValue) && !empty($maxValue)) {
    $query .= " AND `price` BETWEEN '" . $minValue . "' AND '" . $maxValue . "'";
} else if (!empty($minValue)) {
    $query .= " AND `price` >= '" . $minValue . "'";
} else if (!empty($maxValue)) {
    $query .= " AND `price` <= '" . $maxValue . "'";
}

if (!empty($category && $category != 0)) {
    $query .= " AND `category_cat_id` = '" . $category . "'";
} else if (!empty($category2 && $category2 != 0)) {
    $query .= " AND `category_cat_id` = '" . $category2 . "'";
}

if (!empty($brand && $brand != 0)) {
    $query .= " AND `brand`.brand_id = '" . $brand . "'";
}
if (!empty($model && $model != 0)) {
    $query .= " AND `model`.model_id = '" . $model . "'";
}
if (!empty($clr && $clr != 0)) {
    $query .= " AND `color_clr_id` = '" . $clr . "'";
}

if ($condition != 0) {
    if ($condition == 1) {
        $query .= " AND `condition_condition_id` = '" . $condition . "'";
    } else if ($condition == 2) {
        $query .= " AND `condition_condition_id` = '" . $condition . "'";
    }
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

$results_per_page = 15;
$number_of_pages = ceil($user_all_result / $results_per_page);

$page_results = ($page - 1) * $results_per_page;
$query .= " LIMIT " . $results_per_page . " OFFSET " . $page_results . "";

$result = Database::search($query);
$result_num = $result->num_rows;


if ($result_num != 0) {

?>

    <div class="resultGrid">
        <?php

        for ($x = 0; $x < $result->num_rows; $x++) {
            $result_data = $result->fetch_assoc();

            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $result_data["id"] . "'");
            $product_img_data = $product_img_rs->fetch_assoc();

            if ($result_data["status_status_id"] == 1) {

                $total_reviews = Database::search("SELECT * FROM `review` INNER JOIN `user` ON `user`.email = `review`.rev_user_id WHERE `product_id` = '" . $result_data['id'] . "' ORDER BY `review_id` DESC");
                $onebyoneStar = Database::search("SELECT COUNT(*) AS scount,`stars` FROM review WHERE `product_id` = '" . $result_data['id'] . "' GROUP BY `stars` ORDER BY `stars` DESC");
                $totalScore = 0;
                $totalreviewCount = 0;
                $overallRating = 0;
                if ($onebyoneStar->num_rows > 0) {
                    for ($w = 0; $onebyoneStar->num_rows > $w; $w++) {
                        $starOne = $onebyoneStar->fetch_assoc();
                        $totalScore = $totalScore + $starOne["stars"] * $starOne["scount"];

                        $totalreviewCount = $totalreviewCount + $starOne["scount"];
                    }
                    $overallRating = $totalScore / $totalreviewCount;
                    $overallRating = round($overallRating);
                }
        ?>

                <!--Available product-->
                <div class="col">
                    <div class="card cardwidth" id="card<?php echo $result_data['id'] ?>" style="cursor: pointer;">
                        <div class="cardpicbox" onclick="singleProductView(<?php echo $result_data['id'] ?>);">
                            <img src="<?php echo $product_img_data["img_path"] ?>" class="card-img-top" alt="...">
                        </div>
                        <div class="card-body">
                            <div class="twoLineBlock" onclick="singleProductView(<?php echo $result_data['id'] ?>);">
                                <h5 class="card-title fred" style="font-weight: 500;"><?php echo $result_data["title"] ?></h5>
                            </div>
                            <h6 onclick="singleProductView(<?php echo $result_data['id'] ?>);" class="card-title fred" style="font-size: 16px;">LKR <?php echo $result_data["price"] ?>.00</h6>

                            <div class="buycart">
                                <!-- <a href="#" class="btn btncolor" style="height: 40px; display: flex; align-items: center;">Buy now</a> -->
                                <div onclick="singleProductView(<?php echo $result_data['id'] ?>);">
                                    <div class="ui star rating" data-rating="<?php echo $overallRating ?>" data-max-rating="5"></div>
                                    <span>(<?php echo $total_reviews->num_rows ?>)</span>
                                </div>
                                <div style="display: flex; justify-content: end;">
                                    <?php
                                    if (isset($_SESSION["u"])) {
                                        $user_wish_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $_SESSION["u"]["email"] . "' AND `wish_p_id` = '" . $result_data["id"] . "'");

                                        if ($user_wish_rs->num_rows == 0) {
                                    ?>
                                            <div id="offheart<?php echo $result_data['id'] ?>" class="charticon1 d-flex" onclick="addToWish(<?php echo $result_data['id'] ?>);">
                                                <i class="fa-regular fa-heart"></i>
                                            </div>
                                            <div id="onheart<?php echo $result_data['id'] ?>" class="charticon14 d-none" onclick="addToWish(<?php echo $result_data['id'] ?>);">
                                                <i class="fa-solid fa-heart"></i>
                                            </div>
                                        <?php
                                        } else if ($user_wish_rs->num_rows == 1) {

                                        ?>
                                            <div id="offheart<?php echo $result_data['id'] ?>" class="charticon1 d-none" onclick="addToWish(<?php echo $result_data['id'] ?>);">
                                                <i class="fa-regular fa-heart"></i>
                                            </div>
                                            <div id="onheart<?php echo $result_data['id'] ?>" class="charticon14 d-flex" onclick="addToWish(<?php echo $result_data['id'] ?>);">
                                                <i class="fa-solid fa-heart"></i>
                                            </div>
                                        <?php
                                        }
                                    } else {
                                        ?>
                                        <div id="offheart<?php echo $result_data['id'] ?>" class="charticon1 d-flex" onclick="addToWish(<?php echo $result_data['id'] ?>);">
                                            <i class="fa-regular fa-heart"></i>
                                        </div>
                                        <div id="onheart<?php echo $result_data['id'] ?>" class="charticon14 d-none" onclick="addToWish(<?php echo $result_data['id'] ?>);">
                                            <i class="fa-solid fa-heart"></i>
                                        </div>
                                    <?php
                                    }
                                    ?>

                                    <div id="cartbtn<?php echo $result_data['id'] ?>" class="charticon2" onclick="addToCart(<?php echo $result_data['id'] ?>);">
                                        <i class="fa-solid fa-cart-plus"></i>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!--Available product-->

        <?php

            }
        }
        ?>
    </div>

<?php
} else {
?>
    <center>
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




?>

</div>

</div>
<br><br>

<?php

if ($number_of_pages > 0) {
?>
    <div style=" display: flex; justify-content: center; margin-top: 20px; align-items: center; align-content: center;  width: 100%;">
        <div class="ui pagination menu">

            <?php

            for ($x = 1; $x <= $number_of_pages; $x++) {
                if ($x == $page) {
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