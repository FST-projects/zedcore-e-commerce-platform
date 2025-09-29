<?php

include("connection.php");

$content_rs = Database::search("SELECT * FROM `home_content_manage` INNER JOIN `category` ON `category`.`cat_id`=`home_content_manage`.`category_id` WHERE `status`='1'");

for ($i = 0; $i < $content_rs->num_rows; $i++) {
    $content = $content_rs->fetch_assoc();
?>

    <div id="carouselExampleFade<?php echo $i; ?>" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="4500">
        <div class="carousel-inner">
            <?php
            if (isset($content["img1"]) && !empty($content["img1"])) {
            ?>
                <div class="carousel-item active">
                    <img src="<?php echo $content["img1"] ?>" class="d-block carouselpic" alt="...">
                </div>
            <?php
            }
            if (isset($content["img2"]) && !empty($content["img2"])) {
            ?>
                <div class="carousel-item">
                    <img src="<?php echo $content["img2"] ?>" class="d-block carouselpic" alt="...">
                </div>
            <?php
            }
            if (isset($content["img3"]) && !empty($content["img3"])) {
            ?>
                <div class="carousel-item">
                    <img src="<?php echo $content["img3"] ?>" class="d-block carouselpic" alt="...">
                </div>
            <?php
            }
            ?>

        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleFade<?php echo $i; ?>" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleFade<?php echo $i; ?>" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <br><br>

    <div class="hotdeals ">
        <div class="minhead">
            <h3 class="text fred"><?php echo $content["cat_name"]; ?></h3>
            <div class="seemore" onclick="window.location='searchresult.php?sterm=&min=&max=&cat2=&cat=<?php echo $content['cat_id'] ?>&brand=&model=&clr=&condi=0&sort=0'">
                <a>See all</a>
                <i class="fa-solid fa-arrow-right"></i>
            </div>

        </div>
        <br>
        <div class="cardPrev" onclick="speakersDivScrolLeft(<?php echo $i ?>);">
            <i class="ri-arrow-left-line" style="font-size: 35px;"></i>
        </div>
        <div class="cardNext" onclick="speakersDivScrolRight(<?php echo $i ?>);">
            <i class="ri-arrow-right-line" style="font-size: 35px;"></i>
        </div>
        <div class="scrolldiv" id="slideId<?php echo $i ?>">
            <div class="row  g-2" style="width: max-content;">




                <?php
                $smartPhone_rs = Database::search("SELECT * FROM `product` INNER JOIN category ON product.category_cat_id = category.cat_id WHERE `category_cat_id` = '" . $content["cat_id"] . "' LIMIT 8");
                for ($x = 0; $x < $smartPhone_rs->num_rows; $x++) {
                    $smartPhone_data = $smartPhone_rs->fetch_assoc();

                    $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $smartPhone_data["id"] . "'");
                    $product_img_data = $product_img_rs->fetch_assoc();


                    if ($smartPhone_data["status_status_id"] == 1 && $smartPhone_data["admin_status"] == 1) {

                        $total_reviews = Database::search("SELECT * FROM `review` INNER JOIN `user` ON `user`.email = `review`.rev_user_id WHERE `product_id` = '" . $smartPhone_data['id'] . "' ORDER BY `review_id` DESC");
                        $onebyoneStar = Database::search("SELECT COUNT(*) AS scount,`stars` FROM review WHERE `product_id` = '" . $smartPhone_data['id'] . "' GROUP BY `stars` ORDER BY `stars` DESC");
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

                        if ($smartPhone_data["qty"] > 0) {
                ?>
                            <!--Available product-->
                            <div class="col">
                                <div class="card" id="card<?php echo $smartPhone_data['id'] ?>" style="width: 16rem; cursor: pointer;">
                                    <div class="cardpicbox" onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                        <img src="<?php echo $product_img_data["img_path"] ?>" class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <div class="twoLineBlock" onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                            <h5 class="card-title fred" style="font-weight: 500;"><?php echo $smartPhone_data["title"] ?></h5>
                                        </div>
                                        <h6 onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);" class="card-title fred" style="font-size: 16px;">LKR <?php echo $smartPhone_data["price"] ?>.00</h6>

                                        <div class="buycart">
                                            <!-- <a href="#" class="btn btncolor" style="height: 40px; display: flex; align-items: center;">Buy now</a> -->
                                            <div onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                                <div class="ui star rating" data-rating="<?php echo $overallRating ?>" data-max-rating="5"></div>
                                                <span>(<?php echo $total_reviews->num_rows ?>)</span>
                                            </div>
                                            <div style="display: flex;">
                                                <?php
                                                if (isset($_SESSION["u"])) {
                                                    $user_wish_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $user_full_details["email"] . "' AND `wish_p_id` = '" . $smartPhone_data["id"] . "'");

                                                    if ($user_wish_rs->num_rows == 0) {
                                                ?>
                                                        <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-regular fa-heart"></i>
                                                        </div>
                                                        <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </div>
                                                    <?php
                                                    } else if ($user_wish_rs->num_rows == 1) {

                                                    ?>
                                                        <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-regular fa-heart"></i>
                                                        </div>
                                                        <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </div>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </div>
                                                    <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                        <i class="fa-solid fa-heart"></i>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <div id="cartbtn<?php echo $smartPhone_data['id'] ?>" class="charticon2" onclick="addToCart(<?php echo $smartPhone_data['id'] ?>);">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--Available product-->

                        <?php
                        } else {
                        ?>
                            <!--Not Available product-->
                            <div class="col">
                                <div class="card" id="card<?php echo $smartPhone_data['id'] ?>" style="width: 16rem; cursor: pointer;">
                                    <div class="cardpicbox" onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                        <img src="<?php echo $product_img_data["img_path"] ?>" class="card-img-top" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <div class="twoLineBlock" onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                            <h5 class="card-title fred" style="font-weight: 500;"><?php echo $smartPhone_data["title"] ?></h5>
                                        </div>
                                        <h6 onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);" class="card-title fred" style="font-size: 16px;">LKR <?php echo $smartPhone_data["price"] ?>.00</h6>

                                        <div class="buycart">
                                            <div onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                                <div class="ui star rating" data-rating="<?php echo $overallRating ?>" data-max-rating="5"></div>
                                                <span>(<?php echo $total_reviews->num_rows ?>)</span>
                                            </div>
                                            <div style="display: flex;">
                                                <?php
                                                if (isset($_SESSION["u"])) {
                                                    $user_wish_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $user_full_details["email"] . "' AND `wish_p_id` = '" . $smartPhone_data["id"] . "'");

                                                    if ($user_wish_rs->num_rows == 0) {
                                                ?>
                                                        <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-regular fa-heart"></i>
                                                        </div>
                                                        <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </div>
                                                    <?php
                                                    } else if ($user_wish_rs->num_rows == 1) {

                                                    ?>
                                                        <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-regular fa-heart"></i>
                                                        </div>
                                                        <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                            <i class="fa-solid fa-heart"></i>
                                                        </div>
                                                    <?php
                                                    }
                                                } else {
                                                    ?>
                                                    <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                        <i class="fa-regular fa-heart"></i>
                                                    </div>
                                                    <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish(<?php echo $smartPhone_data['id'] ?>);">
                                                        <i class="fa-solid fa-heart"></i>
                                                    </div>
                                                <?php
                                                }
                                                ?>

                                                <div class="disableicon">
                                                    <i class="fa-solid fa-cart-plus"></i>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <!--Not Available product-->
                <?php
                        }
                    }
                }
                ?>



            </div>
        </div>


    </div>

    <br><br>

<?php
}
?>