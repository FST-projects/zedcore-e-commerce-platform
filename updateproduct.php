<?php
session_start();
include "Process/connection.php";
if (isset($_SESSION["u"])) {

    $user = $_SESSION["u"];
    $email = $_SESSION["u"]["email"];
    $user_full_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $email . "'");


    if ($user_full_rs->num_rows > 0) {
        $user_full_data = $user_full_rs->fetch_assoc();



        if ($user_full_data["sell_approve"] == 1) {

            if (isset($_SESSION["p"])) {

                $product_details = $_SESSION["p"];

                if (empty($user_full_data["img"])) {
                    if ($user_full_data["gender_gender_id"] == 1) {
                        $img = "profilepic/default/male.png";
                    } else {
                        $img = "profilepic/default/female.png";
                    }
                } else {
                    $img = $user_full_data["img"];
                }


?>

                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Update Product | Zedcore</title>
                    <link rel="stylesheet" href="Styles/bootstrap.css">
                    <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="Styles/addproduct.css">
                    <link rel="stylesheet" href="Styles/loading.css">
                    <link rel="icon" href="resourses/logotop.svg" />

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
                    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>



                </head>

                <body>

                    <?php include "loading.php" ?>

                    <div class="headertop">
                        <div class="leftcon">


                            <div class="directoryBox">
                                <div class="tophedCon addBtn" onclick="window.location='addproduct.php'">
                                    <i class="ri-add-circle-line" style="margin-right: 6px; font-size: 22px;"></i>
                                    Add Products
                                </div>

                                <div class="ui dropdown" id="director">
                                    <div class="directoryDrop">
                                        <i class="ri-arrow-down-s-fill"></i>
                                    </div>
                                    <div class="menu">
                                        <div class="item" onclick="window.location='index.php'"><i class="home icon"></i> Home</div>
                                        <div class="item" onclick="window.location='myproduct.php'"><i class="shopping basket icon"></i> My Products</div>
                                    </div>
                                </div>
                            </div>

                            <div class="topother">
                                <div class="tophedCon">Help & Support</div>
                                <div class="tophedCon" onclick="window.location='aboutUs.php'">About us</div>
                            </div>


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











                        </div>
                        <div class="rightcon">





                            <div class="profilebox" id="profilebox" onclick="showMenu();">

                                <div class="profilenm">
                                    <b>Hi,</b>&nbsp;
                                    <?php echo $user_full_data["fname"] ?>
                                </div>
                                <div class="profile">
                                    <img src="<?php echo $img ?>" alt="" id="profileImg">
                                </div>

                            </div>








                        </div>
                    </div>
                    <br>
                    <br><br>

                    <div class="popback eventsoff" id="popback">
                        <div class="menupop menuclose" id="menupop">
                            <div class="menuprofile">
                                <div class="menuimg">
                                    <img src="<?php echo $user_full_data["img"] ?>" alt="">
                                </div>
                                <div class="menuNm">
                                    <span class="name">
                                        <?php echo $user_full_data["fname"] ?> <?php echo $user_full_data["lname"] ?>
                                    </span>
                                    <span class="email">
                                        <?php echo $user_full_data["email"] ?>
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
                    <!--
    <div class="ui breadcrumb" style="margin-left: 10px;">
        <a class="section">Home</a>
        <i class="right chevron icon divider"></i>
        <a class="section">Registration</a>
        <i class="right chevron icon divider"></i>
        <div class="active section">Personal Information</div>-->
                    </div>

                    <?php
                    $model_rs = Database::search("SELECT * FROM `model`");
                    $model_max_id = Database::search("SELECT MAX(`model_id`) as maxmod FROM `model`");
                    $model_max = $model_max_id->fetch_assoc();

                    $category_rs = Database::search("SELECT * FROM `category`");
                    $cat_max_id = Database::search("SELECT MAX(`cat_id`) as maxcat FROM `category`");
                    $cat_max = $cat_max_id->fetch_assoc();

                    $brand_rs = Database::search("SELECT * FROM `brand`");
                    $brand_max_id = Database::search("SELECT MAX(`brand_id`) as maxbd FROM `brand`");
                    $brand_max = $brand_max_id->fetch_assoc();

                    $color_rs = Database::search("SELECT * FROM `color`");
                    $clr_max_id = Database::search("SELECT MAX(`clr_id`) as maxclr FROM `color`");
                    $clr_max = $clr_max_id->fetch_assoc();



                    $user_model_rs = Database::search("SELECT * FROM `model_has_brand` WHERE `id` = '" . $product_details["model_has_brand_id"] . "'");
                    $user_model_data = $user_model_rs->fetch_assoc();

                    $user_color_rs = Database::search("SELECT * FROM `product_has_color` WHERE `product_id` = '" . $product_details["id"] . "'");
                    $user_color_data = $user_color_rs->fetch_assoc();

                    ?>


                    <br>



                    <div class="ui container segment" style=" border-radius: 15px; box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px;">

                        <center>
                            <h2 class="fred" style="font-weight: 400;">Update Product</h2>
                            <br>
                            <img src="resourses/updateprod.svg" class="add_img" alt="">
                        </center>
                        <br>
                        <div class="ui form">
                            <h4 class="ui dividing header" style="font-size: large;">Basic Details</h4>

                            <div class="fields">
                                <div class="eight wide field" style="padding-bottom: 10px;">
                                    <label style="font-size: larger; font-weight: 600;">Model</label>
                                    <div class="field">

                                        <select class="ui fluid search dropdown disabled" id="modelDrop">
                                            <option value="">Select Model</option>
                                            <?php
                                            for ($x = 0; $x < $model_rs->num_rows; $x++) {
                                                $model_data = $model_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $model_data["model_id"] ?>" <?php
                                                                                                        if ($user_model_data["model_model_id"] == $model_data["model_id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo $model_data["model_name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="eight wide field">
                                    <label style="font-size: larger; font-weight: 600;">Brand</label>
                                    <div class="field">

                                        <select class="ui fluid search dropdown disabled" id="brandDrop">
                                            <option value="">Select Brand</option>
                                            <?php
                                            for ($x = 0; $x < $brand_rs->num_rows; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $brand_data["brand_id"] ?>" <?php
                                                                                                        if ($user_model_data["brand_brand_id"] == $brand_data["brand_id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo $brand_data["brand_name"] ?></option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="eight wide field" style="padding-bottom: 10px;">
                                    <label style="font-size: larger; font-weight: 600;">Category</label>
                                    <div class="field">

                                        <select class="ui fluid search dropdown disabled" id="CatDrop">
                                            <option value="">Select Category</option>
                                            <?php
                                            for ($x = 0; $x < $category_rs->num_rows; $x++) {
                                                $category_data = $category_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $category_data["cat_id"] ?>" <?php
                                                                                                        if ($product_details["category_cat_id"] == $category_data["cat_id"]) {
                                                                                                        ?> selected <?php
                                                                                                                }
                                                                                                                    ?>><?php echo $category_data["cat_name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="eight wide field">
                                    <label style="font-size: larger; font-weight: 600;">Color</label>
                                    <div class="field">

                                        <select class="ui fluid search dropdown disabled" id="colorDrop">
                                            <option value="">Select Color</option>
                                            <?php
                                            for ($x = 0; $x < $color_rs->num_rows; $x++) {
                                                $color_data = $color_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $color_data["clr_id"] ?>" <?php
                                                                                                    if ($user_color_data["color_clr_id"] == $color_data["clr_id"]) {
                                                                                                    ?> selected <?php
                                                                                                            }
                                                                                                                ?>><?php echo $color_data["clr_name"] ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>





                            <div class="fields">
                                <div class="eight wide field" style="padding-bottom: 10px;">
                                    <label style="font-size: larger; font-weight: 600;">Product quantity</label>
                                    <!-- <input type="number" min="0" placeholder="Price"> -->
                                    <div class="ui right labeled input">
                                        <label id="sub" type="button" for="amount" class="ui label button"><i class="ri-subtract-fill"></i></label>
                                        <input type="number" min="0" value="<?php echo $product_details["qty"] ?>" id="amount">
                                        <div id="add" type="button" class="ui label button"><i class="ri-add-fill"></i></div>
                                    </div>
                                </div>
                                <div class="eight wide field">
                                    <label style="font-size: larger; font-weight: 600;">Product Condition</label>
                                    <div class="inline fields" style="padding-top: 10px;">
                                        <?php
                                        if ($product_details["condition_condition_id"] == 1) {
                                        ?>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input type="radio" name="frequency" id="b" checked="checked" disabled>
                                                    <label for="b">Brand New</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input id="u" type="radio" name="frequency" disabled>
                                                    <label for="u">Used</label>
                                                </div>
                                            </div>
                                        <?php
                                        } else if ($product_details["condition_condition_id"] == 2) {
                                        ?>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input type="radio" name="frequency" id="b" disabled>
                                                    <label for="b">Brand New</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input id="u" type="radio" name="frequency" checked="checked" disabled>
                                                    <label for="u">Used</label>
                                                </div>
                                            </div>
                                        <?php
                                        }

                                        ?>

                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Product title</label>
                                <input id="title" type="text" placeholder="Enter Product Title   (This will show up in the front of product card)" value="<?php echo $product_details["title"]; ?>">
                            </div>
                            <div class="ui form">
                                <div class="field">
                                    <label style="font-size: larger; font-weight: 600;">Product description</label>
                                    <textarea id="desc" placeholder="Enter product description"><?php echo $product_details["description"]; ?></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="ui form">
                                <div class="field">
                                    <label style="font-size: larger; font-weight: 600;">Product specification</label>
                                    <textarea id="spec" placeholder="Enter product specification"><?php echo $product_details["spec"]; ?></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Product pictures</label>
                                <div style="overflow: hidden; display: flex; align-items: center; align-content: center;" onclick="changeproductImage();">
                                    <input id="imageUp" type="file" accept=".jpg,.jpeg,.png,.xml" multiple style="position: absolute;transform: translateX(0px);transform: scale(1); opacity: 0; cursor: pointer; width: 230px; z-index: 3;">
                                    <img src="resourses/addfile.svg" width="50px" alt="">
                                    <div class="ui labeled icon teal button" style=" cursor: pointer;">
                                        <i class="upload icon"></i>
                                        Upload pictures
                                    </div>
                                </div>
                                <?php
                                $user_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $product_details["id"] . "'");
                                $img = array();

                                $img[0] = "resourses/image (2).png";
                                $img[1] = "resourses/image (2).png";
                                $img[2] = "resourses/image (2).png";
                                $img[3] = "resourses/image (2).png";
                                $img[4] = "resourses/image (2).png";

                                for ($x = 0; $x < $user_img_rs->num_rows; $x++) {
                                    $user_img_data = $user_img_rs->fetch_assoc();

                                    $img[$x] = $user_img_data["img_path"];
                                }
                                ?>
                                <div class="">
                                    <div class="ui small images">
                                        <img src="<?php echo $img[0]; ?>" id="i0">
                                        <img src="<?php echo $img[1]; ?>" id="i1">
                                        <img src="<?php echo $img[2]; ?>" id="i2">
                                        <img src="<?php echo $img[3]; ?>" id="i3">
                                        <img src="<?php echo $img[4]; ?>" id="i4">

                                    </div>
                                </div>

                                <h5 style="color: rgb(94, 94, 94); font-size: 14px; font-weight: 400;" class="fred">
                                    Last selected image will be used as the product card image.
                                </h5>
                            </div>
                            <br>
                            <form action="#">
                                <h4 class="ui dividing header" style="font-size: large; font-weight: 600;">Product Pricing</h4>
                                <div class="fields">
                                    <div class="eight wide field" style="padding-bottom: 10px;">
                                        <label style="font-size: larger;">Product price</label>
                                        <input id="price" type="number" min="0" placeholder="Price" value="<?php echo $product_details["price"]; ?>" disabled>
                                    </div>
                                </div>
                                <br>
                                <div class="ui dividing header"></div>

                                <h5 style="color: rgb(201, 22, 22); font-size: 14px; margin-top: 5px;" class="fred">
                                    WE CHARGE 5% OF THE PRODUCT PRICE FROM ALL PRODUCTS FOR OUR SERVICE.
                                </h5>
                                <br>

                                <div onclick="upProduct();" class="ui teal button" tabindex="0">Update Product</div>
                                <br>
                                <center>
                                    <img src="resourses/update.svg" class="add_img2" alt="">

                                </center>
                                <br><br><br>
                            </form>
                        </div>
                    </div>


                    <!-- Site footer -->
                    <br><br>
                    <!-- fotter -->
                    <?php include "fotter.php"; ?>
                    <!-- fotter -->



                    <script src="Process/addProduct.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        $('#modelDrop')
                            .dropdown();

                        $('#brandDrop')
                            .dropdown();

                        $('#CatDrop')
                            .dropdown();
                        $('#colorDrop')
                            .dropdown();
                        $('#director')
                            .dropdown();
                        $('#more')
                            .dropdown();
                    </script>

                </body>

                </html>

            <?php





            } else {
            ?>
                <script>
                    alert("Select a product from My Product page to update!");
                    window.location = "myproduct.php";
                </script>
        <?php

            }
        }
    } else {
        ?>
        <script>
            alert("Your login details not match! please try relogin.");
        </script>
<?php
    }
} else {

    header("Location: signin.php");
}

?>