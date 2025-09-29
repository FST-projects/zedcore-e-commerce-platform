<?php
session_start();
if (isset($_GET["pid"])) {

    $pid = $_GET["pid"];
    include "Process/connection.php";
    $loginact;
    if (isset($_SESSION["u"])) {
        $loginact = 1;
    } else {
        $loginact = 0;
    }

    if (isset($_SESSION["u"])) {
        $user_ses = $_SESSION["u"];
        $email = $_SESSION["u"]["email"];

        $user_full_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user_ses["email"] . "'");
        if ($user_full_rs->num_rows == 1) {
            $user_full_data = $user_full_rs->fetch_assoc();

            if (empty($user_full_data["img"])) {
                if ($user_ses["gender_gender_id"] == 1) {
                    $img = "profilepic/default/male.png";
                } else {
                    $img = "profilepic/default/female.png";
                }
            } else {
                $img = $user_full_data["img"];
            }
        }
    }

    $product_data_rs = Database::search("SELECT `product`.id,`product`.spec,`product`.price,`product`.qty,`product`.`description`,
    `product`.title,`view`,`product`.user_email,`model`.model_name AS mname,brand.brand_name AS bname,brand.brand_id AS bid,`category_cat_id` AS cid,`model_id` AS mid,`shop`.shop_name AS shop,`shop`.`shop_id` FROM `product` 
    INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `shop` ON `shop`.`seller_id` = `product`.user_email INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id` 
    INNER JOIN `model` ON `model`.`model_id` = `model_has_brand`.`model_model_id` WHERE `product`.`id` = '" . $pid . "';");


    if ($product_data_rs->num_rows == 1) {

        $product_data = $product_data_rs->fetch_assoc();



?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Zedcore | <?php echo $product_data["title"] ?></title>
            <link rel="stylesheet" href="Styles/bootstrap.css">
            <link href="Styles/semantic.min.css" rel="stylesheet">
            <link rel="stylesheet" href="Styles/productView.css">
            <link rel="stylesheet" href="Styles/loading.css">
            <link rel="icon" href="resourses/logotop.svg" />

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
            <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">

        </head>

        <body style="background-color: rgb(245, 245, 245);">

            <div class="headertop">
                <div class="leftcon">

                    <?php
                    if (isset($_SESSION["u"])) {
                        if ($user_full_data["sell_approve"] == 1) {
                    ?>
                            <div class="directoryBox">
                                <div class="tophedCon sellBtnNew" onclick="window.location='myproduct.php'">
                                    My Products
                                </div>

                                <div class="ui dropdown" id="director">
                                    <div class="directoryDropSell">
                                        <i class="ri-arrow-down-s-fill"></i>
                                    </div>
                                    <div class="menu">
                                        <div class="item" onclick="window.location='index.php'"><i class="home icon"></i> Home</div>
                                        <div class="item" onclick="window.location='addproduct.php'"><i class="plus icon"></i> Add Products</div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else if ($user_full_data["sell_approve"] != 1) {
                        ?>
                            <div class="directoryBox">
                                <div class="tophedCon sellBtnNew" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    Sell
                                </div>

                                <div class="ui dropdown" id="director">
                                    <div class="directoryDropSell">
                                        <i class="ri-arrow-down-s-fill"></i>
                                    </div>
                                    <div class="menu">
                                        <div class="item" onclick="window.location='index.php'"><i class="home icon"></i> Home</div>
                                        <div class="item" onclick="window.location='addproduct.php'"><i class="plus icon"></i> Add
                                            Products</div>
                                    </div>
                                </div>
                            </div>
                        <?php
                        }
                        ?>












                        <div class="ui compact ss">
                            <div class="ui dropdown" style="font-weight: 400;" id="more">
                                More
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="link-des o3" onclick="window.location='index.php'">
                                        <i class="home icon"></i>
                                        Home
                                    </div>
                                    <div class="link-des o3" onclick="window.location='myproduct.php'">
                                        <i class="shopping basket icon"></i>
                                        My Products
                                    </div>
                                    <div class="link-des o3" onclick="window.location='addproduct.php'">
                                        <i class="plus icon"></i>
                                        Add Products
                                    </div>

                                    <div class="divider o3"></div>
                                    <div class="link-des o2" onclick="window.location='wishlist.php'">
                                        <i class="heart outline icon"></i>
                                        Wishlist
                                    </div>
                                    <div class="link-des o4" onclick="window.location='cart.php'">
                                        <i class="cart plus icon"></i>
                                        Add to cart
                                    </div>
                                    <div class="divider o2"></div>
                                    <div class="item o1" onclick="window.location='contact.php'">
                                        <i class="question circle outline icon"></i>
                                        Help & Support
                                    </div>
                                    <div class="item o1" onclick="window.location='aboutUs.php'">
                                        <i class="smile outline icon"></i>
                                        About us
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    } else {
                    ?>
                        <div class="tophedCon selBtn" onclick="window.location = 'signin.php'">Sell</div>

                        <div class="ui compact ss">
                            <div class="ui dropdown" style="font-weight: 400;" id="more">
                                More
                                <i class="dropdown icon"></i>
                                <div class="menu">
                                    <div class="link-des o3" onclick="window.location='index.php'">
                                        <i class="home icon"></i>
                                        Home
                                    </div>
                                    <div class="link-des o3" onclick="window.location = 'signin.php'">
                                        <i class="shopping basket icon"></i>
                                        Sell
                                    </div>

                                    <div class="divider o3"></div>
                                    <div class="link-des o2">
                                        <i class="heart outline icon" onclick="window.location='wishlist.php'"></i>
                                        Wishlist
                                    </div>
                                    <div class="link-des o4" onclick="window.location='cart.php'">
                                        <i class="cart plus icon"></i>
                                        Add to cart
                                    </div>
                                    <div class="divider o2"></div>
                                    <div class="item o1" onclick="window.location='contact.php'">
                                        <i class="question circle outline icon"></i>
                                        Help & Support
                                    </div>
                                    <div class="item o1" onclick="window.location='aboutUs.php'">
                                        <i class="smile outline icon"></i>
                                        About us
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>

                    <div class="topother">
                        <div class="tophedCon" onclick="window.location='contact.php'">Help & Support</div>
                        <div class="tophedCon" onclick="window.location='aboutUs.php'">About us</div>
                    </div>
                </div>
                <div class="rightcon">

                    <div class="icon2"><i class="fa-regular fa-heart" onclick="window.location='wishlist.php'"></i></div>
                    <div class="tophedCon icon1" style="margin-left: 5px;" onclick="window.location='cart.php'"><i class="fa-solid fa-cart-shopping"></i></div>


                    <?php
                    if (isset($_SESSION["u"])) {
                    ?>
                        <div class="profilebox" id="profilebox" onclick="showMenu();">

                            <div class="profilenm">
                                <b>Hi,</b>&nbsp;<?php echo $user_full_data["fname"] ?>

                            </div>
                            <div class="profile">
                                <img src="<?php echo $img ?>" alt="" id="profileImg">

                            </div>

                        </div>
                    <?php
                    } else {
                    ?>
                        <div style="display: flex;">
                            <div class="tophedCon" id="login" onclick="window.location = 'signin.php'">Login</div>
                            <div class="tophedCon signupBtn" id="signup" onclick="window.location = 'signin.php'">Signup</div>
                        </div>
                    <?php
                    }
                    ?>


                </div>
            </div>
            <br>
            <br><br>
            <?php
            if (isset($_SESSION["u"])) {
            ?>
                <div class="popback eventsoff" id="popback">
                    <div class="menupop menuclose" id="menupop">
                        <div class="menuprofile">
                            <div class="menuimg">
                                <img src="<?php echo $img ?>" alt="">
                            </div>
                            <div class="menuNm">
                                <span class="name">
                                    <?php echo $user_full_data["fname"] ?> <?php echo $user_full_data["lname"] ?>
                                </span>
                                <span class="email"><?php echo $user_full_data["email"] ?>
                                </span>
                            </div>
                        </div>
                        <div class="menuAccSet" id="accSet" onclick="window.location = 'accset.php'">
                            <i class="ri-user-settings-line"></i>
                            <span>Account settings</span>
                        </div>
                        <div class="menuHelp" onclick="window.location='order-history.php'">
                            <i class="ri-time-line"></i>
                            <span>Order History</span>
                        </div>
                        <div class="logout">
                            <div class="menuSignout" onclick="signout();">
                                <i class="ri-logout-box-r-line"></i>
                                <span>Logout</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>



            <div style="padding-left: 20px; margin-top: 10px;">
                <div class="ui breadcrumb">
                    <a class="section" onclick="window.location='index.php';">Home</a>
                    <span class="divider">/</span>
                    <div class="active section"><?php echo $product_data["title"] ?></div>
                </div>
            </div>



            <div class="ui  container segment">
                <div class="mainBox">
                    <div class="imgMainBox">
                        <div class="secondBoxlayer">
                            <div class="imgMini1">
                                <?php
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $pid . "'");

                                $img_num = $img_rs->num_rows;
                                $img = array();

                                if ($img_num != 0) {
                                    for ($x = 0; $x < $img_num; $x++) {
                                        $img_data = $img_rs->fetch_assoc();
                                        $img[$x] = $img_data["img_path"];

                                ?>
                                        <div class="minipic">
                                            <img id="productImg<?php echo $x; ?>" onclick="LoadImg(<?php echo $x; ?>);" src="<?php echo $img[$x] ?>" class="SimgSize" alt="">
                                        </div>
                                <?php
                                    }
                                } else {
                                }
                                ?>

                            </div>
                            <?php
                            $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $pid . "'");
                            $img_fetch = $img_rs->fetch_assoc();
                            ?>

                            <div class="bigpicBox">
                                <img src="<?php echo $img_fetch["img_path"] ?>" id="mainImg" class="bigpic" alt="">
                            </div>


                            <div class="imgMini2">

                                <?php
                                $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $pid . "'");

                                $img_num = $img_rs->num_rows;
                                $img = array();

                                if ($img_num != 0) {
                                    for ($x = 0; $x < $img_num; $x++) {
                                        $img_data = $img_rs->fetch_assoc();
                                        $img[$x] = $img_data["img_path"];

                                ?>
                                        <div class="minipic">
                                            <img id="productImg<?php echo $x; ?>" onclick="LoadImg(<?php echo $x; ?>);" src="<?php echo $img[$x] ?>" class="SimgSize" alt="">
                                        </div>
                                <?php
                                    }
                                } else {
                                }
                                ?>


                            </div>
                        </div>

                    </div>
                    <?php
                    $total_reviews = Database::search("SELECT * FROM `review` INNER JOIN `user` ON `user`.email = `review`.rev_user_id WHERE `product_id` = '" . $product_data['id'] . "' ORDER BY `review_id` DESC");
                    $onebyoneStar = Database::search("SELECT COUNT(*) AS scount,`stars` FROM review WHERE `product_id` = '" . $product_data['id'] . "' GROUP BY `stars` ORDER BY `stars` DESC");
                    $totalScore = 0;
                    $totalreviewCount = 0;
                    $overallRating = 0;
                    if ($onebyoneStar->num_rows > 0) {
                        for ($x = 0; $onebyoneStar->num_rows > $x; $x++) {
                            $starOne = $onebyoneStar->fetch_assoc();
                            $totalScore = $totalScore + $starOne["stars"] * $starOne["scount"];

                            $totalreviewCount = $totalreviewCount + $starOne["scount"];
                        }
                        $overallRating = $totalScore / $totalreviewCount;
                        $overallRating = round($overallRating);
                    }
                    ?>

                    <div class="MaindetailBox">
                        <div class="pTitle">
                            <?php echo $product_data["title"] ?>
                        </div>
                        <?php
                        $price = $product_data["price"];
                        $adding_price = ($price / 100) * 10;
                        $new_price = (int)$price + (int)$adding_price;
                        ?>
                        <div class="pPrice" style="margin-top: 20px;">
                            <span>LKR <?php echo $product_data["price"] ?>.00</span>
                            <span class="secPrice">LKR
                                <?php echo (int)$new_price ?>.00</span>
                        </div>
                        <div style="margin-top: 10px;">
                            <div class="ui star rating" data-rating="<?php echo $overallRating ?>" data-max-rating="5"></div>
                            <span style="margin-left: 5px;">(<?php echo $total_reviews->num_rows ?> Reviews)</span>
                        </div>
                        <div style="margin-top: 20px; font-size: larger;">
                            <span>Brand : &nbsp;</span>
                            <span><?php echo $product_data["bname"] ?></span>
                        </div>
                        <div style="font-size: larger; margin-top: 5px;">
                            <span>Model : &nbsp;</span>
                            <span><?php echo $product_data["mname"] ?></span>
                        </div>


                        <div class="ui form" style="margin-top: 20px;">
                            <label style="font-size: 15px; font-weight: 500;">Color Family : </label>
                            <div class="inline fields" style="margin-top: 5px;">
                                <?php
                                $color_rs = Database::search("SELECT * FROM `product_has_color` INNER JOIN `color` ON `color`.`clr_id` = `product_has_color`.`color_clr_id` WHERE `product_id` IN (SELECT `product`.`id` FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` WHERE `user_email` = '" . $product_data["user_email"] . "' AND `model_model_id` = '" . $product_data["mid"] . "' AND `price` = '" . $product_data["price"] . "' )");

                                for ($x = 0; $color_rs->num_rows > $x; $x++) {
                                    $color_data = $color_rs->fetch_assoc();

                                    $p_qty_rs = Database::search("SELECT `qty` FROM `product` WHERE `id` = '" . $color_data["product_id"] . "'");
                                    $p_qty = $p_qty_rs->fetch_assoc();

                                    if ($p_qty["qty"] > 0) {
                                ?>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" <?php if ($product_data["id"] == $color_data["product_id"]) {
                                                                        echo ("checked");
                                                                    } ?> id="clr<?php echo $color_data["product_id"] ?>" onclick="btnAnable();" value="<?php echo $color_data["product_id"] ?>" name="color">
                                                <label for="clr<?php echo $color_data["product_id"] ?>" style="cursor: pointer;"><?php echo $color_data["clr_name"] ?></label>
                                            </div>
                                        </div>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" <?php if ($product_data["id"] == $color_data["product_id"]) {
                                                                        echo ("checked");
                                                                    } ?> id="clr<?php echo $color_data["product_id"] ?>" onclick="btnDisable();" value="<?php echo $color_data["product_id"] ?>" name="color">
                                                <label for="clr<?php echo $color_data["product_id"] ?>" style="cursor: pointer;"><?php echo $color_data["clr_name"] ?></label>
                                            </div>
                                        </div>
                                <?php
                                    }
                                }
                                ?>


                            </div>
                        </div>
                        <span style="margin-top: 10px; font-size: 15px; font-weight: 500;">Product Quantity : </span>
                        <div style="margin-top: 5px;">
                            <div class="ui right labeled input" style="margin-bottom: 10px;">
                                <label id="sub<?php echo $product_data["id"]; ?>" onclick="qtydown(<?php echo $product_data['id']; ?>);" type="button" class="ui label button"><i class="ri-subtract-fill"></i></label>
                                <input type="text" min="0" value="1" id="amount<?php echo $product_data['id'] ?>" style="width: 60px; padding: 0; text-align: center; pointer-events: none;">
                                <div id="add<?php echo $product_data['id']; ?>" onclick="qtyup(<?php echo $product_data['id'] ?>,<?php echo $product_data['qty'] ?>);" type="button" class="ui label button"><i class="ri-add-fill"></i>
                                </div>
                            </div>
                        </div>

                        <div class="buttongroup">
                            <div style="display: flex; align-items: center;">
                                <?php
                                if ($product_data["qty"] > 0) {
                                ?>
                                    <button onclick="preBuy(<?php echo $product_data['id']; ?>)" id="buyBtn" class="fred btns orange">Buy
                                        Now</button>

                                    <button class="fred btns green" onclick="addToCart(<?php echo $product_data['id'] ?>);" id="addToCart" style="margin-left: 10px; ">Add
                                        to Cart</button>
                                <?php
                                } else {
                                ?>
                                    <button onclick="preBuy(<?php echo $product_data['id']; ?>)" id="buyBtn" class="fred btns disableBtn">Buy
                                        Now</button>

                                    <button class="fred btns disableBtn" onclick="addToCart(<?php echo $product_data['id'] ?>);" id="addToCart" style="margin-left: 10px; ">Add
                                        to Cart</button>
                                <?php
                                }
                                ?>

                            </div>
                            <?php
                            if (isset($_SESSION["u"])) {
                                $user_wish_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $email . "' AND `wish_p_id` = '" . $product_data['id'] . "'");

                                if ($user_wish_rs->num_rows == 0) {
                            ?>
                                    <div id="offheart<?php echo $product_data['id'] ?>" class="charticon4 d-flex" onclick="addToWish(<?php echo $product_data['id'] ?>);">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                    <div id="onheart<?php echo $product_data['id'] ?>" class="charticon14 d-none" onclick="addToWish(<?php echo $product_data['id'] ?>);">
                                        <i class="fa-solid fa-heart"></i>
                                    </div>
                                <?php
                                } else if ($user_wish_rs->num_rows == 1) {

                                ?>
                                    <div id="offheart<?php echo $product_data['id'] ?>" class="charticon4 d-none" onclick="addToWish(<?php echo $product_data['id'] ?>);">
                                        <i class="fa-regular fa-heart"></i>
                                    </div>
                                    <div id="onheart<?php echo $product_data['id'] ?>" class="charticon14 d-flex" onclick="addToWish(<?php echo $product_data['id'] ?>);">
                                        <i class="fa-solid fa-heart"></i>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div id="offheart<?php echo $product_data['id'] ?>" class="charticon4 d-flex" onclick="addToWish(<?php echo $product_data['id'] ?>);">
                                    <i class="fa-regular fa-heart"></i>
                                </div>
                                <div id="onheart<?php echo $product_data['id'] ?>" class="charticon14 d-none" onclick="addToWish(<?php echo $product_data['id'] ?>);">
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            <?php
                            }
                            ?>

                        </div>
                    </div>
                </div>

                <ul class="nav nav-tabs">
                    <li class="nav-item fontsize" id="descHead" style="cursor: pointer;">
                        <a class="nav-link active" id="descmin" aria-current="page">Description </a>
                    </li>
                    <li class="nav-item fontsize" id="specHead" style="cursor: pointer;;">
                        <a class="nav-link " id="specmin">Specification</a>
                    </li>
                    <li class="nav-item fontsize" id="revHead" style="cursor: pointer;">
                        <a class="nav-link " id="revmin">Reviews</a>
                    </li>
                </ul>

                <div id="desc" class="desc d-flex">
                    <?php echo nl2br($product_data['description']); ?>
                </div>

                <div id="spec" class="spec d-none">
                    <?php echo nl2br($product_data['spec']); ?>

                </div>


                <div id="reviewSec" class="d-none" style="padding: 20px;">
                    <div class="reviewSec">
                        <?php

                        $review_rs = Database::search("SELECT * FROM `review` INNER JOIN `user` ON `user`.email = `review`.rev_user_id WHERE `product_id` = '" . $product_data['id'] . "' ORDER BY `review_id` DESC");

                        if ($review_rs->num_rows > 0) {
                            for ($x = 0; $review_rs->num_rows > $x; $x++) {
                                $review_data = $review_rs->fetch_assoc();
                        ?>
                                <div class="reviewMainBox">
                                    <div class="reviewSubBox">
                                        <div>
                                            <div class="ui mini star rating" data-rating="<?php echo $review_data["stars"] ?>" data-max-rating="5"></div>
                                            <span style="margin-left: 5px; font-size: 14px;"><?php echo $review_data["fname"] ?> <?php echo $review_data["lname"] ?></span>
                                        </div>
                                        <div style="margin-top: 10px;">
                                            <?php echo $review_data["review"] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php
                            }
                        } else {
                            ?>
                            <center>
                                <div>
                                    <div>
                                        <img src="resourses/review.svg" class="emptysizing" alt="">
                                    </div>
                                    <div class="fred fontsiz" style="margin-top: 10px;">
                                        No reviews Yet
                                    </div>
                                </div>
                            </center>
                        <?php
                        }
                        ?>

                    </div>
                </div>
                <hr style="color:#a7a7a7;">
                <div class="storeHoldBox">
                    <div class="storeSecLayer">
                        <div>
                            <div style="font-size: 24px;">
                                <?php echo $product_data['shop'] ?>
                            </div>
                            <?php
                            if (isset($_SESSION["u"])) {
                                $follow_rs = Database::search("SELECT * FROM `followed_shop` WHERE `user_id` = '" . $email . "' AND `shop_id` = '" . $product_data['shop_id'] . "'");

                                if ($follow_rs->num_rows == 0) {
                            ?>
                                    <div style="margin-top: 10px;">
                                        <button id="follow" onclick="follow(<?php echo $product_data['shop_id'] ?>);" class="fred followbtn">Follow</button>
                                    </div>

                                <?php
                                } else if ($follow_rs->num_rows == 1) {
                                ?>
                                    <div style="margin-top: 10px;">
                                        <button id="follow" onclick="follow(<?php echo $product_data['shop_id'] ?>);" class="fred followbtn">Following</button>
                                    </div>
                                <?php
                                }
                            } else {
                                ?>
                                <div style="margin-top: 10px;">
                                    <button id="follow" onclick="follow(<?php echo $product_data['shop_id'] ?>);" class="fred followbtn">Follow</button>
                                </div>

                            <?php
                            }

                            ?>


                        </div>
                        <div style="margin-left: 20px;">
                            <div style="border-radius: 50%; width: 60px; height: 60px; display: flex; align-items: center; justify-content: center; align-content: center;">
                                <img src="resourses/shop.svg" style="width: 60px; height: 60px; object-fit: contain; border-radius: 50%;" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <hr style="color:#a7a7a7;">




                <div class="questionBox">
                    <div class="headqes">Ask Questions</div>
                    <div id="quesboxload" class="scrollquesBox">

                        <?php

                        $question_rs = Database::search("SELECT * FROM `question` INNER JOIN `user` ON `user`.email = `question`.ques_user_id WHERE `pid` = '" . $product_data['id'] . "' ORDER BY `time` DESC");

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
                                                <?php echo $product_data['shop'] ?>
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


                    </div>

                    <div class="quesInput">
                        <input id="quesdata" type="text" class="quesfeild fred " placeholder="Type your question here...">
                        <div id="sendbtn" class="sendBtn" onclick="send(<?php echo $product_data['id'] ?>,);">
                            <i class="telegram plane icon" style="transform: translateY(5px);"></i>
                        </div>
                    </div>


                </div>





                <div class="hotdeals ">
                    <div class="minhead">
                        <h3 class="text fred">Related Products</h3>
                    </div>
                    <div class="cardPrev" onclick="phonesDivScrolLeft();">
                        <i class="ri-arrow-left-line" style="font-size: 35px;"></i>
                    </div>
                    <div class="cardNext" onclick="phonesDivScrolRight();">
                        <i class="ri-arrow-right-line" style="font-size: 35px;"></i>
                    </div>
                    <br>
                    <div class="scrolldiv" id="phones">
                        <div class="row  g-2" style="width: max-content; flex-wrap: nowrap;">
                            <?php
                            $smartPhone_rs = Database::search("SELECT * FROM `product` INNER JOIN category_has_brand ON product.category_cat_id = category_has_brand.category_cat_id WHERE `product`.`category_cat_id` = '" . $product_data['cid'] . "' AND `brand_brand_id` = '" . $product_data['bid'] . "' AND `product`.id != '" . $product_data['id'] . "' LIMIT 6");
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
                                                        <div onclick="singleProductView(<?php echo $smartPhone_data['id'] ?>);">
                                                            <div class="ui star rating" data-rating="<?php echo $overallRating ?>" data-max-rating="5"></div>
                                                            <span>(<?php echo $total_reviews->num_rows ?>)</span>
                                                        </div>
                                                        <div style="display: flex;">
                                                            <?php
                                                            if (isset($_SESSION["u"])) {
                                                                $user_wish_rs = Database::search("SELECT * FROM `wishlist` WHERE `userwish_id` = '" . $user_full_data["email"] . "' AND `wish_p_id` = '" . $smartPhone_data["id"] . "'");

                                                                if ($user_wish_rs->num_rows == 0) {
                                                            ?>
                                                                    <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish2(<?php echo $smartPhone_data['id'] ?>);">
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    </div>
                                                                    <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish2(<?php echo $smartPhone_data['id'] ?>);">
                                                                        <i class="fa-solid fa-heart"></i>
                                                                    </div>
                                                                <?php
                                                                } else if ($user_wish_rs->num_rows == 1) {

                                                                ?>
                                                                    <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish2(<?php echo $smartPhone_data['id'] ?>);">
                                                                        <i class="fa-regular fa-heart"></i>
                                                                    </div>
                                                                    <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish2(<?php echo $smartPhone_data['id'] ?>);">
                                                                        <i class="fa-solid fa-heart"></i>
                                                                    </div>
                                                                <?php
                                                                }
                                                            } else {
                                                                ?>
                                                                <div id="offheart<?php echo $smartPhone_data['id'] ?>" class="charticon1 offheart<?php echo $smartPhone_data['id'] ?> d-flex" onclick="addToWish2(<?php echo $smartPhone_data['id'] ?>);">
                                                                    <i class="fa-regular fa-heart"></i>
                                                                </div>
                                                                <div id="onheart<?php echo $smartPhone_data['id'] ?>" class="charticon14 onheart<?php echo $smartPhone_data['id'] ?> d-none" onclick="addToWish2(<?php echo $smartPhone_data['id'] ?>);">
                                                                    <i class="fa-solid fa-heart"></i>
                                                                </div>
                                                            <?php
                                                            }
                                                            ?>

                                                            <div id="cartbtn<?php echo $smartPhone_data['id'] ?>" class="charticon2" onclick="addToCart2(<?php echo $smartPhone_data['id'] ?>);">
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
                            }
                            ?>


                        </div>
                    </div>


                </div>
            </div>






            <!-- Modal -->
            <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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

            <!-- Site footer -->
            <br><br>
            <!-- fotter -->
            <?php include "fotter.php"; ?>
            <!-- fotter -->












            <script src="Animations/bootstrap.min.js"></script>
            <script src="Animations/bootstrap.bundle.js"></script>
            <script src="Animations/cartanimate.js"></script>
            <script src="Process/singleproduct.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>

            <script>
                $('#select')
                    .dropdown();

                $('#select1')
                    .dropdown();

                $('#select2')
                    .dropdown();
                $('#director')
                    .dropdown();
                $('#navDrop')
                    .dropdown();

                $('#more').dropdown();




                $('.ui.rating')
                    .rating('disable');
            </script>

        </body>

        </html>

    <?php
    } else {
    ?>
        <script>
            alert("Something went wrong!");
            window.history.back();
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("Something went wrong! Please try again later.");
        window.location = "index.php";
    </script>
<?php
}
?>