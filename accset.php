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
    <!-- <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet"> -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
    <title>Profile Settings | ZedCore</title>
</head>

<body style="background-color: rgb(245, 245, 245);">


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
                <div class="tophedCon selBtn" onclick="window.location = 'index.php'">Sell</div>

                <div class="ui compact ss">
                    <div class="ui dropdown" style="font-weight: 400;" id="more">
                        More
                        <i class="dropdown icon"></i>
                        <div class="menu">
                            <div class="link-des o3" onclick="window.location='index.php'">
                                <i class="ri-home-2-line" style="margin-right: 10px;"></i>
                                Home
                            </div>
                            <div class="link-des o3" onclick="window.location='index.php'">
                                <i class="shopping basket icon"></i>
                                Sell
                            </div>

                            <div class="divider o3"></div>
                            <div class="link-des o2" onclick="window.location='index.php'">
                                <i class="fa-regular fa-heart" style="margin-right: 10px;"></i>
                                Wishlist
                            </div>
                            <div class="link-des o4" onclick="window.location='index.php'">
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

            <div class="icon2" onclick="window.location='wishlist.php'"><i class="fa-regular fa-heart"></i></div>
            <div class="tophedCon icon1" style="margin-left: 5px;" onclick="window.location='cart.php'"><i class="fa-solid fa-cart-shopping"></i></div>



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
                    <div class="tophedCon" id="login" onclick="window.location = 'index.php'">Login</div>
                    <div class="tophedCon signupBtn" id="signup" onclick="window.location = 'index.php'">Signup</div>
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

    <?php
    if (isset($_SESSION["u"])) {
        $user = $_SESSION["u"];
        $email = $_SESSION["u"]["email"]
    ?>

        <link rel="stylesheet" href="Styles/accset.css">

        <div style="padding-left: 20px;">
            <div class="ui breadcrumb">
                <a class="section" onclick="window.location='index.php';">Home</a>
                <span class="divider">/</span>
                <div class="active section">Account Settings</div>
            </div>
        </div>
        <br><br>
        <div class="container">
            <div class="holder">
                <!--Menu Side-->
                <div class="acc-menu" id="acc_menu">
                    <div class="img-box" id="img_box">
                        <div class="img-circle" id="img_circle">
                            <?php
                            $Uprofile =  Database::search("SELECT `img` FROM `user` WHERE `email` = '" . $email . "'");
                            $Uprofile_data = $Uprofile->fetch_assoc();
                            if (empty($Uprofile_data["img"])) {
                                if ($user["gender_gender_id"] == 1) {
                                    $img = "profilepic/default/male.png";
                                } else {
                                    $img = "profilepic/default/female.png";
                                }
                            } else {
                                $img = $Uprofile_data["img"];
                            }
                            ?>
                            <img class="img" id="img" src="<?php echo $img ?>" alt="">

                        </div>
                    </div>
                    <div class="name-box" id="name_box">
                        <div class="name-holder" id="name_holder">
                            <span style="font-size:21px; font-weight: 500;"><?php echo $user_full_details["fname"] ?> <?php echo $user_full_details["lname"] ?></span>
                            <span style="font-size: 14px;"><?php echo $user_full_details["joined_date"] ?> Joined</span>
                        </div>
                    </div>
                    <hr>
                    <div class="selection" id="d1">
                        <i class="ri-edit-box-line icons" id="icons"></i>
                        <span class="text" id="text">Edit Profile</span>
                    </div>
                    <div class="selection" id="d2">
                        <i class="ri-key-line icons" id="icons2"></i>
                        <span class="text" id="text2">Security</span>

                    </div>
                    <div class="selection" id="d3">
                        <i class="ri-map-pin-line icons" id="icons3"></i>
                        <span class="text" id="text3">Address</span>

                    </div>
                    <div class="reshow d-none" id="reshow">
                        <i class="ri-arrow-drop-right-line icon" id="icons5"></i>
                    </div>

                </div>
                <!--Menu Side-->


                <!--Details parts-->
                <div class="acc-details" id="acc_details">


                    <!--Edit profile-->
                    <div class="editProfile" id="editProfile">
                        <div class="topics1">Profile</div>
                        <div id="msg_box" class="msg-box d-none"></div>

                        <div class="profileUp" id="profileUp">
                            <div class="imgBox2">

                                <img class="img2" src="<?php echo $img ?>" alt="" id="inImg">
                            </div>
                            <div class="changeProf">Change Profile
                                <input type="file" id="newProfile" onclick="changeProf();">
                            </div>
                        </div>
                        <?php
                        $user_details =  Database::search("SELECT * FROM `user` INNER JOIN `gender` ON user.gender_gender_id = gender.gender_id WHERE `email` = '" . $email . "'");
                        $user_details_data = $user_details->fetch_assoc();
                        ?>
                        <div class="scroll-details1">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="fname" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="fname" value="<?php echo $user_full_details["fname"] ?>">
                                </div>
                                <div class="col-md-6">
                                    <label for="lname" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lname" value="<?php echo $user_full_details["lname"] ?>">
                                </div>

                                <div class="col-md-12">
                                    <label for="inputPassword4" class="form-label">Birth Day</label>
                                    <div class="input-group">
                                        <?php
                                        if (!empty($user_details_data["bday"])) {
                                        ?>
                                            <input type="number" min="1" max="31" value="<?php echo $user_details_data["bday"] ?>" class="form-control" placeholder="Day" id="day">
                                        <?php
                                        } else {
                                        ?>
                                            <input type="number" min="1" max="31" class="form-control" placeholder="Day" id="day">

                                        <?php
                                        }
                                        ?>
                                        <select id="month" class="form-select">
                                            <option value="0">Month</option>
                                            <?php
                                            $month_rs =  Database::search("SELECT * FROM `month`");

                                            for ($x = 0; $x < $month_rs->num_rows; $x++) {
                                                $month_data = $month_rs->fetch_assoc();
                                            ?>
                                                <option value="<?php echo $month_data["month_id"] ?>" <?php
                                                                                                        if (!empty($user_details_data["bmonth"])) {
                                                                                                            if ($month_data["month_id"] == $user_details_data["bmonth"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                            }

                                                                                                                    ?>><?php echo $month_data["month_name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                        <?php
                                        if (!empty($user_details_data["bday"])) {
                                        ?>
                                            <input id="year" type="number" min="1" value="<?php echo $user_details_data["byear"] ?>" class="form-control" placeholder="Year">

                                        <?php
                                        } else {
                                        ?>
                                            <input id="year" type="number" min="1" class="form-control" placeholder="Year">


                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <label for="mobile" class="form-label">Mobile</label>
                                    <input type="text" class="form-control" id="mobile" value="<?php echo $user_full_details["mobile"] ?>">
                                </div>

                                <?php

                                ?>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Gender</label>
                                    <input type="text" class="form-control" id="mobile" readonly value="<?php echo $user_details_data["gender_name"]; ?>">
                                </div>

                                <div class="col-12">
                                    <button class="btn-color" onclick="profileSave();">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Edit profile-->



                    <!--Security-->
                    <div class="Security d-none" id="Security">
                        <div class="topics">Security</div>
                        <div id="msg_box2" class="msg-box d-none"></div>
                        <div class="scroll-details">
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="inputEmail4" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email2" value="<?php echo $user["email"] ?>" readonly>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputPassword4" class="form-label">Password</label>
                                    <input type="password" class="form-control" readonly value="<?php echo $user["password"] ?>">

                                </div>


                                <div class="col-12">
                                    <button type="submit" class="btn-color" onclick="fgPw();">Change Password</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Security-->

                    <?php

                    $city_rs = Database::search("SELECT * FROM `city`");
                    $province_rs = Database::search("SELECT * FROM `province`");
                    $district_rs = Database::search("SELECT * FROM `district`");
                    $user_address_rs = Database::search("SELECT * FROM `user_has_address` INNER JOIN `city` ON user_has_address.city_city_id = city.city_id INNER JOIN  `district` ON city.district_district_id = district.district_id INNER JOIN `province` ON district.province_province_id = province.province_id WHERE `user_email` = '" . $email . "'");

                    $city_num = $city_rs->num_rows;
                    $province_num = $province_rs->num_rows;
                    $district_num = $district_rs->num_rows;
                    $user_address_num = $user_address_rs->num_rows;
                    $user_address_data = $user_address_rs->fetch_assoc();

                    ?>






                    <!--Address-->
                    <div class="Address d-none" id="Address">
                        <div class="topics">Address</div>
                        <div id="msg_box3" class="msg-box d-none"></div>
                        <div class="scroll-details">
                            <div class="row g-3">
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">Address</label>

                                    <?php
                                    if (!empty($user_address_data["line1"])) {
                                    ?>
                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $user_address_data["line1"] ?>">

                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">

                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="col-md-6">
                                    <label for="city" class="form-label">City</label>
                                    <select id="city" class="form-select">
                                        <option value="0">Choose...</option>
                                        <?php
                                        for ($x = 0; $x < $city_num; $x++) {
                                            $city_data = $city_rs->fetch_assoc();
                                        ?>

                                            <option value="<?php echo $city_data["city_id"] ?>" <?php

                                                                                                if ($user_address_num == 1) {

                                                                                                    if ($user_address_data["city_city_id"] == $city_data["city_id"]) {
                                                                                                ?> selected <?php
                                                                                                        }
                                                                                                    }

                                                                                                            ?>>


                                                <?php echo $city_data["city_name"] ?></option>

                                        <?php

                                        }

                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="district" class="form-label">District</label>
                                    <select id="district" class="form-select">
                                        <option value="0">Choose...</option>
                                        <?php
                                        for ($x = 0; $x < $district_num; $x++) {
                                            $district_data = $district_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $district_data["district_id"] ?>" <?php

                                                                                                        if ($user_address_num == 1) {

                                                                                                            if ($user_address_data["district_id"] == $district_data["district_id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                            }

                                                                                                                    ?>>


                                                <?php echo $district_data["district_name"] ?></option>

                                        <?php
                                        }
                                        ?>

                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="province" class="form-label">Province</label>
                                    <select id="province" class="form-select">
                                        <option value="0">Choose...</option>
                                        <?php
                                        for ($x = 0; $x < $province_num; $x++) {
                                            $province_data = $province_rs->fetch_assoc();
                                        ?>
                                            <option value="<?php echo $province_data["province_id"] ?>" <?php

                                                                                                        if ($user_address_num == 1) {

                                                                                                            if ($user_address_data["province_id"] == $province_data["province_id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                            }

                                                                                                                    ?>>


                                                <?php echo $province_data["province_name"] ?></option>

                                        <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputZip" class="form-label">Zip</label>
                                    <?php
                                    if (!empty($user_address_data["postal_code"])) {
                                    ?>
                                        <input type="text" class="form-control" id="inputZip" value="<?php echo $user_address_data["postal_code"] ?>">

                                    <?php
                                    } else {
                                    ?>
                                        <input type="text" class="form-control" id="inputZip">

                                    <?php
                                    }
                                    ?>

                                </div>

                                <div class="col-12">
                                    <button class="btn-color" onclick="saveaddress();">Save</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!--Address-->


                    <!--Notification-->
                    <!-- <div class="Notification d-none" id="Notification">
                        <div class="topics">Notifications</div>
                        <div class="scroll-details">
                            <form class="row g-3">



                                <div>
                                    <div class="form-check form-switch switch">
                                        <input class="form-check-input" type="checkbox" role="switch" checked id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                            Hot deals Notification
                                        </label>
                                    </div>
                                    <div class="form-check form-switch switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                            Followed Stores Notifications
                                        </label>
                                    </div>
                                    <div class="form-check form-switch switch">
                                        <input class="form-check-input" type="checkbox" role="switch" checked id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                            Wishlist Notificaions
                                        </label>
                                    </div>
                                    <div class="form-check form-switch switch">
                                        <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                                        <label class="form-check-label" for="flexSwitchCheckDefault">
                                            ZedCore New events Notifications
                                        </label>
                                    </div>
                                </div>



                                <div class="col-12">
                                    <button class="btn btn-color">Save</button>
                                </div>

                            </form>
                        </div>
                    </div> -->
                    <!--Notification-->


                </div>
                <!--Details parts-->
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="fpmodal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fnstyle" id="exampleModalLabel">Zedcore Account Reset Code</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="closemodl1();"></button>
                    </div>
                    <div class="modal-body">
                        <div class="" id="error-boxpop"></div>
                        <div class="input-group mb-3">
                            <input id="code" type="text" class="form-control" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <span class="input-group-text">Code</span>



                            <div class="quest">
                                <i class="ri-question-line"></i>
                                <div class="popup">Enter the code sent to your email for verification.</div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="modal-btn" onclick="ckCode();">PROCESSED</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="fpmoda2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5 fnstyle" id="exampleModalLabel">Reset Password</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="error-txt" id="error-boxpop2"></div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <i id="pwicon" class="ri-eye-fill wht pw"></i>
                            <span class="input-group-text">New Password

                            </span>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password" aria-label="Recipient's username" aria-describedby="basic-addon2">
                            <i id="pwicon2" class="ri-eye-fill wht pw2"></i>
                            <span class="input-group-text">Re-enter Password</span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="modal-btn" onclick="upDt();">RESET</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="emsent2" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" onclick="verifymdl();"></button>
                    </div>
                    <div class="modal-body">
                        <p class="fnstyle" style="font-size: medium;">Verification code has sent successfully. PLease check your email</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-bs-dismiss="modal" aria-label="Close" class="modal-btn" onclick="verifymdl();">OK</button>
                    </div>
                </div>
            </div>
        </div>



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



        <br><br><br>
        <?php

        include "fotter.php";

        ?>

    <?php
    } else {
    ?>
        <script>
            window.location = "signin.php";
        </script>
    <?php
    }
    ?>



    <script>
        $('#more')
            .dropdown();
    </script>

    <script src="Animations/bootstrap.js"></script>
    <script src="Animations/bootstrap.bundle.js"></script>
    <script src="Animations/popAnimate.js"></script>
    <script src="homeProcess/home.js"></script>
    <script src="Animations/accset.js"></script>
    <script src="Process/accountSetProcess.js"></script>
    <script src="Animations/pass-show-hide.js"></script>

</body>

</html>