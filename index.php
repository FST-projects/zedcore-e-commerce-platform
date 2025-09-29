<?php


include "header.php";


?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/fomantic-ui/2.9.3/semantic.min.js" integrity="sha512-gnoBksrDbaMnlE0rhhkcx3iwzvgBGz6mOEj4/Y5ZY09n55dYddx6+WYc72A55qEesV8VX2iMomteIwobeGK1BQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<div class="dBack" id="dback"></div>
<div class="blackdisplay" id="notifyblackbg"></div>

<div class="notificationSideBar" id="sideBarNotify">
    <div class="notificationSideHeader">
        <i class="fa-solid fa-bell" style="margin-right: 5px;"></i>
        Notifications
    </div>
    <hr>

    <div class="msgDesign" id="notifyBox">
        <!-- Notifications Loads here -->
    </div>

</div>
<div class="filterBox2" id="filterBox2">
    <div class="ui vertical menu" style="width: auto; height: 3000px;">
        <div class="item">
            <div style="display: flex; align-items: center; align-content: center; justify-content: space-between;">
                <h3 class="ui header">Filter Your Products</h3>

                <div class="ui vertical animated button" onclick="clearFil(0);" id="clear1" tabindex="0">
                    <div class="hidden content">clear</div>
                    <div class="visible content">
                        <i style="font-size: 16px;" class="ri-filter-off-line"></i>
                    </div>
                </div>
            </div>



            <br><br>
            <form class="ui form">
                <h4 class="ui dividing header">Filter by price</h4>
                <div class="fields">
                    <div class="eight wide field">
                        <label>Min</label>
                        <input id="minP" type="number" name="price" placeholder="Min price">
                    </div>
                    <div class="eight wide field">
                        <label>Max</label>
                        <input id="maxP" type="number" name="price" placeholder="Max price">
                    </div>
                </div>
                <br>
            </form>

            <br>
            <form class="ui form">
                <h4 class="ui dividing header">Filter by brand</h4>
                <div style=" display: flex; justify-content: center;">
                    <select name="gender" class="ui dropdown" id="select4">
                        <option value="">Select brand</option>
                        <option id="all2" value="0">All</option>


                        <?php
                        $product_brand_rs = Database::search("SELECT * FROM `brand`");
                        for ($x = 0; $x < $product_brand_rs->num_rows; $x++) {
                            $product_brand_data = $product_brand_rs->fetch_assoc();

                        ?>
                            <option value="<?php echo $product_brand_data["brand_id"]; ?>"><?php echo $product_brand_data["brand_name"]; ?></option>

                        <?php

                        }
                        ?>

                    </select>
                </div>
            </form>
            <br>
            <form class="ui form">
                <h4 class="ui dividing header">Filter by model</h4>
                <div style=" display: flex; justify-content: center;">
                    <select name="gender" class="ui dropdown" id="select5">
                        <option value="">Select model</option>
                        <option id="all2" value="0">All</option>


                        <?php
                        $product_model_rs = Database::search("SELECT * FROM `model`");
                        for ($x = 0; $x < $product_model_rs->num_rows; $x++) {
                            $product_model_data = $product_model_rs->fetch_assoc();

                        ?>
                            <option value="<?php echo $product_model_data["model_id"]; ?>"><?php echo $product_model_data["model_name"]; ?></option>

                        <?php

                        }
                        ?>

                    </select>
                </div>

            </form>
            <br>
            <form class="ui form">
                <h4 class="ui dividing header">Filter by color</h4>
                <div style=" display: flex; justify-content: center;">
                    <select name="gender" class="ui dropdown" id="select6">
                        <option value="">Select color</option>
                        <option id="all2" value="0">All</option>


                        <?php
                        $product_color_rs = Database::search("SELECT * FROM `color`");
                        for ($x = 0; $x < $product_color_rs->num_rows; $x++) {
                            $product_color_data = $product_color_rs->fetch_assoc();

                        ?>
                            <option value="<?php echo $product_color_data["clr_id"]; ?>"><?php echo $product_color_data["clr_name"]; ?></option>

                        <?php

                        }
                        ?>

                    </select>
                </div>

            </form>
        </div>
        <br>
        <div class="item">
            <h4 class="ui header">Filter by condition</h4>

            <div class="ui form">
                <div class="grouped fields">
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="cond" id="bn">
                            <label for="bn">Brandnew</label>
                        </div>
                    </div>
                    <div class="field">
                        <div class="ui radio checkbox">
                            <input type="radio" name="cond" id="ud">
                            <label for="ud">Used</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<div class="container">
    <div class="miniLogo">
        <img src="resourses/logo_hori.svg" alt="">
    </div>
    <br>
    <div class="searchconHOlder">
        <div class="maxlogo">
            <img src="resourses/logo_hori.svg" style="padding-right: 20px;" width="160px" alt="">
        </div>

        <form class="d-flex search" role="search">

            <div class="catgerybox" style="height: 40px;">
                <select name="gender" class="ui fluid dropdown" id="select">
                    <option value="">All Categories</option>

                    <?php
                    $product_rs = Database::search("SELECT * FROM `category`");
                    for ($x = 0; $x < $product_rs->num_rows; $x++) {
                        $product_data = $product_rs->fetch_assoc();

                    ?>
                        <option value="<?php echo $product_data["cat_id"]; ?>"><?php echo $product_data["cat_name"]; ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>

            <div style="width: 100%; height: 40px; position: relative;">
                <input id="mainsearchbar" class="me-2 searchsyl" type="search" placeholder="Search" aria-label="Search">
                <div id="homereslt" class="homereslt d-none">

                </div>
                <div class="catgerybox2">
                    <select name="gender" class="ui fluid dropdown" id="select2">
                        <option value="">All Categories</option>
                        <?php
                        $product_rs = Database::search("SELECT * FROM `category`");
                        for ($x = 0; $x < $product_rs->num_rows; $x++) {
                            $product_data = $product_rs->fetch_assoc();

                        ?>
                            <option value="<?php echo $product_data["cat_id"]; ?>"><?php echo $product_data["cat_name"]; ?></option>

                        <?php

                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="searchbox">
                <div>
                    <div class="btnsearch" onclick="filter(0);">Search</div>
                    <div class="btnsearch2" onclick="filter(0);">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                <div style="display: flex; align-items: center; align-content: center; justify-content: center;">
                    <div id="slideTrig" class="advancebox" onclick="slider();">
                        <i class="ri-equalizer-line"></i>
                    </div>
                </div>

            </div>
        </form>

    </div>



    <br><br>
    <div>
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4500">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner" style="border-radius: 10px;">
                <div class="carousel-item active">
                    <img src="ProductPic/slides/slide 7 (1).jpg" class="d-block w-100" alt="..." style="border-radius: 10px;">
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="ProductPic/slides/slide 9 (1).jpg" class="d-block w-100" alt="..." style="border-radius: 10px;">
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
                <div class="carousel-item">
                    <img src="ProductPic/slides/home slide3 (1).jpg" class="d-block w-100" alt="..." style="border-radius: 10px;">
                    <div class="carousel-caption d-none d-md-block">

                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>


        <?php
        if (isset($_SESSION["u"])) {


            Database::iud("DELETE FROM `recommend_product` WHERE `user_id` = '" . $user["id"] . "' AND `increment_id` NOT IN (SELECT `increment_id` FROM (SELECT `increment_id` FROM `recommend_product` WHERE user_id = '" . $user["id"] . "' ORDER BY `increment_id` DESC LIMIT 5) AS last_five)");

            $mostClickedCat = Database::search("SELECT COUNT(`category_cat_id`) AS `amount`, product.category_cat_id FROM `recommend_product` INNER JOIN `product` ON `product`.id = `recommend_product`.product_id WHERE `user_id` = '" . $user["id"] . "' GROUP BY `category_cat_id` ORDER BY `amount` DESC LIMIT 1;");

            if ($mostClickedCat->num_rows > 0) {
                $mostClickedCat = $mostClickedCat->fetch_assoc();
        ?>

                <br><br>
                <div class="hotdeals">
                    <div class="minhead">
                        <h3 class="text fred">For You</h3>
                    </div>
                    <br>
                    <div class="cardPrev" onclick="bestDivScrolLeft(1);">
                        <i class="ri-arrow-left-line" style="font-size: 35px;"></i>
                    </div>
                    <div class="cardNext" onclick="bestDivScrolRight(1);">
                        <i class="ri-arrow-right-line" style="font-size: 35px;"></i>
                    </div>
                    <main class="scrolldiv" id="best1">

                        <div class="row  g-2" style="width: max-content;">



                            <?php
                            $smartPhone_rs = Database::search("SELECT * FROM `product` INNER JOIN category ON product.category_cat_id = category.cat_id WHERE `category_cat_id` = '" . $mostClickedCat["category_cat_id"] . "' ORDER BY RAND() LIMIT 8");
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
                    </main>


                </div>
        <?php
            }
        }
        ?>
        <br><br>
        <div class="hotdeals">
            <div class="minhead">
                <h3 class="text fred">New Arrivals</h3>
            </div>
            <br>
            <div class="cardPrev" onclick="bestDivScrolLeft(2);">
                <i class="ri-arrow-left-line" style="font-size: 35px;"></i>
            </div>
            <div class="cardNext" onclick="bestDivScrolRight(2);">
                <i class="ri-arrow-right-line" style="font-size: 35px;"></i>
            </div>
            <main class="scrolldiv" id="best2">

                <div class="row  g-2" style="width: max-content;">



                    <?php
                    $smartPhone_rs = Database::search("SELECT * FROM `product` INNER JOIN category ON product.category_cat_id = category.cat_id ORDER BY `id` DESC LIMIT 8");
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
            </main>


        </div>



        <br><br>
        <div class="hotdeals ">
            <div class="minhead">
                <h3 class="text fred">Most Viewed</h3>

            </div>
            <br>
            <div class="cardPrev" onclick="mostViewDivScrolLeft();">
                <i class="ri-arrow-left-line" style="font-size: 35px;"></i>
            </div>
            <div class="cardNext" onclick="mostViewDivScrolRight();">
                <i class="ri-arrow-right-line" style="font-size: 35px;"></i>
            </div>
            <main class="scrolldiv" id="mostView">
                <div class="row  g-2" style="width: max-content;">

                    <?php
                    $smartPhone_rs = Database::search("SELECT * FROM `product` INNER JOIN category ON product.category_cat_id = category.cat_id ORDER BY `view` DESC LIMIT 8");
                    for ($x = 0; $x < $smartPhone_rs->num_rows; $x++) {
                        $smartPhone_data = $smartPhone_rs->fetch_assoc();

                        $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $smartPhone_data["id"] . "'");
                        $product_img_data = $product_img_rs->fetch_assoc();


                        if ($smartPhone_data["status_status_id"] == 1) {

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
            </main>


        </div>

        <br><br>

        <div id="categoryLoads">

        </div>

        <!--End container-->
    </div>


    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Change into Seller Account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Do you want to continue as a Seller in this application?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-toggle="modal" data-bs-target="#staticBackdrop13">Yes</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="staticBackdrop13" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Setting up shop account</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <center>
                    <div id="shopalrt" class="d-none fred shopalrt">

                    </div>
                </center>

                <form class="row g-3" style="padding: 10px;">
                    <div class="mb-3">
                        <label for="exampleFormControlInput1" class="form-label">Shop name</label>
                        <input type="text" class="form-control" id="shopnm" placeholder="Zedcore">
                    </div>
                    <div class="mb-3 row">
                        <label for="staticEmail" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" readonly class="form-control-plaintext" value="<?php echo $_SESSION["u"]["email"] ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control" id="pw">
                        </div>
                    </div>
                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-primary" onclick="sellReg();">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="emsent" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="fnstyle" style="font-size: medium;">Your account has been updated into a seller account! Enjoy Selling on zedcore!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" data-bs-dismiss="modal" aria-label="Close" class="modal-btn btn btn-primary" onclick="window.location.reload();">OK</button>
                </div>
            </div>
        </div>
    </div>







</div>

<br><br>
</div>


<!-- fotter -->
<?php include "fotter.php"; ?>
<!-- fotter -->







<!-- <div class="ui right vertical sidebar menu" id="" style="padding: 5px;">
    <div class="notificationHead outfit">
        Notifications
    </div>
    <div id="notifyBox"> -->
<!-- Notifications Loads here -->
<!-- </div>
</div> -->




<!-- Modal -->
<div class="modal fade" id="reviewmodel" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true" style="z-index: 99999999;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" id="reviewBox">

            <!-- loads here -->

        </div>
    </div>
</div>

<script>
    $('#more')
        .dropdown();

    $('#select')
        .dropdown();
    $('#select2')
        .dropdown();

    $('#select3')
        .dropdown();

    $('#select4')
        .dropdown();

    $('#select5')
        .dropdown();
    $('#select6')
        .dropdown();

    $('#clear1').click(function() {
        $('#select3')
            .dropdown("clear");
        $('#select4')
            .dropdown("clear");
        $('#select5')
            .dropdown("clear");
        $('#select6')
            .dropdown("clear");
    })

    $('.ui.rating')
        .rating('disable');
</script>
<script src="Animations/bootstrap.js"></script>
<script src="Animations/popAnimate.js"></script>
<script src="homeProcess/home.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


</body>

</html>