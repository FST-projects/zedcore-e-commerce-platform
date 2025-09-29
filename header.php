<?php

session_start();


include "Process/connection.php";

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Styles/bootstrap.css">

    <link rel="stylesheet" href="Styles/home.css">
    <link rel="stylesheet" href="Styles/loading.css">
    <link href="Styles/semantic.min.css" rel="stylesheet">
    <link rel="icon" href="resourses/logotop.svg" />


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
    <title>Home | Zedcore</title>
</head>

<body onload="loadHomeCat();" style="background-color: rgb(245, 245, 245);">


    <div class="shade" id="shade">
        <div id="load" class="lds-ellipsis">
            <div></div>
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>





    <div class="headertop">
        <div class="leftcon">
            <?php

            if (isset($_SESSION["u"])) {
                $user = $_SESSION["u"];

                $user_full_details_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user["email"] . "'");
                $user_full_details = $user_full_details_rs->fetch_assoc();

                if ($user_full_details["sell_approve"] == 1) {
            ?>
                    <div class="tophedCon myprodBtn" onclick="window.location = 'myproduct.php'">My Products</div>

                    <div class="ui compact ss">
                        <div class="ui dropdown" style="font-weight: 400;" id="more">
                            More
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <div class="link-des o3" onclick="window.location='index.php'">
                                    <i class="ri-home-2-line" style="margin-right: 10px;"></i>
                                    Home
                                </div>
                                <div class="link-des o3" onclick="window.location = 'myproduct.php'">
                                    <i class="ri-shopping-basket-2-line" style="margin-right: 10px;"></i>
                                    My Products
                                </div>

                                <div class="divider o3"></div>
                                <div class="link-des o2" onclick="notification();">
                                    <i class="fa-regular fa-bell" style="margin-right: 10px;"></i>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span>Notifications</span>
                                        <div class="miniNotification d-none" id="notifyBack">
                                            <span id="notifyNum">1</span>
                                        </div>
                                    </div>

                                </div>
                                <div class="link-des o2" onclick="window.location='wishlist.php'">
                                    <i class="fa-regular fa-heart" style="margin-right: 10px;"></i>
                                    Wishlist
                                </div>
                                <div class="link-des o4" onclick="window.location='cart.php'">
                                    <i class="ri-shopping-cart-line" style="margin-right: 10px;"></i>
                                    Add to Cart
                                </div>
                                <div class="divider o2"></div>
                                <div class="item o1" onclick="window.location='contact.php'">
                                    <i class="ri-question-line" style="margin-right: 10px;"></i>
                                    Help & Support
                                </div>
                                <div class="item o1" onclick="window.location='aboutUs.php'">
                                    <i class="fa-solid fa-circle-info" style="margin-right: 10px;"></i>
                                    About Us
                                </div>
                            </div>
                        </div>
                    </div>

                <?php
                } else {
                ?>
                    <div class="tophedCon selBtn" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Sell</div>


                    <div class="ui compact ss">
                        <div class="ui dropdown" style="font-weight: 400; font-size: 16px;" id="more">
                            More
                            <i class="dropdown icon"></i>
                            <div class="menu">
                                <div class="link-des o3" onclick="window.location='index.php'">
                                    <i class="ri-home-2-line" style="margin-right: 10px;"></i>
                                    Home
                                </div>
                                <div class="link-des o3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                                    <i class="ri-shopping-basket-2-line"></i>
                                    Sell
                                </div>

                                <div class="divider o3"></div>
                                <div class="link-des o2" onclick="notification();">
                                    <i class="fa-regular fa-bell" style="margin-right: 10px;"></i>
                                    <div style="display: flex; justify-content: space-between;">
                                        <span>Notifications</span>
                                        <div class="miniNotification d-none" id="notifyBack">
                                            <span id="notifyNum">1</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="link-des o2" onclick="window.location='wishlist.php'">
                                    <i class="fa-regular fa-heart" style="margin-right: 10px;"></i>
                                    Wishlist
                                </div>
                                <div class="link-des o4" onclick="window.location='cart.php'">
                                    <i class="ri-shopping-cart-line" style="margin-right: 10px;"></i>
                                    Add to Cart
                                </div>
                                <div class="divider o2"></div>
                                <div class="item o1" onclick="window.location='contact.php'">
                                    <i class="ri-question-line" style="margin-right: 10px;"></i>
                                    Help & Support
                                </div>
                                <div class="item o1" onclick="window.location='aboutUs.php'">
                                    <i class="fa-solid fa-circle-info" style="margin-right: 10px;"></i>
                                    About Us
                                </div>
                            </div>

                        </div>
                    </div>
                <?php
                }
            } else {
                ?>
                <div class="tophedCon selBtn" onclick="window.location = 'signin.php'">Sell</div>

                <div class="ui compact ss">
                    <div class="ui dropdown" style="font-weight: 400;" id="more">
                        More
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class="link-des o3" onclick="window.location='index.php'">
                                <i class="ri-home-2-line" style="margin-right: 10px;"></i>
                                Home
                            </div>
                            <div class="link-des o3" onclick="window.location='signin.php'">
                                <i class="shopping basket icon"></i>
                                Sell
                            </div>

                            <div class="divider o3"></div>
                            <div class="link-des o2" onclick="notifiNone();">
                                <i class="fa-regular fa-bell" style="margin-right: 10px;"></i>
                                <div style="display: flex; justify-content: space-between;">
                                    <span>Notifications</span>
                                    <div class="miniNotification d-none" id="notifyBack">
                                        <span id="notifyNum">1</span>
                                    </div>
                                </div>
                            </div>
                            <div class="link-des o2" onclick="window.location='signin.php'">
                                <i class="fa-regular fa-heart" style="margin-right: 10px;"></i>
                                Wishlist
                            </div>
                            <div class="link-des o4" onclick="window.location='signin.php'">
                                <i class="ri-shopping-cart-line" style="margin-right: 10px;"></i>
                                Add to Cart
                            </div>
                            <div class="divider o2"></div>
                            <div class="item o1" onclick="window.location='contact.php'">
                                <i class="ri-question-line" style="margin-right: 10px;"></i>
                                Help & Support
                            </div>
                            <div class="item o1" onclick="window.location='aboutUs.php'">
                                <i class="fa-solid fa-circle-info" style="margin-right: 10px;"></i>
                                About Us
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
            <?php
            if (isset($_SESSION["u"])) {
            ?>
                <div class="icon2" style="position: relative;" onclick="notification();" id="notibtn">
                    <i class="fa-solid fa-bell"></i>
                    <div id="notifyBack" class="notificationNum d-none">
                        <span id="notifyNum">1</span>
                    </div>
                </div>

                <div class="icon2" onclick="window.location='wishlist.php'"><i class="fa-regular fa-heart"></i></div>
                <div class="tophedCon icon1" style="margin-left: 5px;" onclick="window.location='cart.php'"><i class="fa-solid fa-cart-shopping"></i></div>
            <?php
            } else {
            ?>
                <div class="icon2" style="position: relative;" onclick="notifiNone();">
                    <i class="fa-solid fa-bell"></i>
                    <div class="notificationNum d-none">
                        <span>1</span>
                    </div>
                </div>

                <div class="icon2" onclick="window.location='signin.php'"><i class="fa-regular fa-heart"></i></div>
                <div class="tophedCon icon1" style="margin-left: 5px;" onclick="window.location='signin.php'"><i class="fa-solid fa-cart-shopping"></i></div>

            <?php
            }

            ?>





            <?php
            if (isset($_SESSION["u"])) {



                if (empty($user_full_details["img"])) {
                    if ($user["gender_gender_id"] == 1) {
                        $img = "profilepic/default/male.png";
                    } else {
                        $img = "profilepic/default/female.png";
                    }
                } else {
                    $img = $user_full_details["img"];
                }
            ?>


                <div class="profilebox" id="profilebox" onclick="showMenu();">

                    <div class="profilenm">
                        <b>Hi,</b>&nbsp;<?php echo $user_full_details["fname"];  ?>
                    </div>
                    <div class="profile">
                        <img src="<?php echo $img; ?>" alt="" id="profileImg">
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
    <br><br><br>
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
                        <span class="name"><?php echo $user_full_details["fname"] ?> <?php echo $user_full_details["lname"] ?></span>
                        <span class="email"><?php echo $user_full_details["email"] ?> </span>
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