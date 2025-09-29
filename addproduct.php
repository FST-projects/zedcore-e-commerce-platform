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

            $shop_rs = Database::search("SELECT * FROM `shop` WHERE `seller_id` = '" . $user_full_data["email"] . "'");
            $shop = $shop_rs->fetch_assoc();

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
                <title>Add Product | Zedcore</title>

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
                <?php
                if ($shop["shop_status"] != 2) {
                ?>

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
                                <div class="tophedCon">About us</div>
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

                                        <div class="divider o3"></div>

                                        <div class="item o1">
                                            <i class="question circle outline icon"></i>
                                            Help & Support
                                        </div>
                                        <div class="item o1">
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


                    $modelAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '1'");
                    $catAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '2'");
                    $clrAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '4'");
                    $brandAccess = Database::search("SELECT * FROM `seller_product_add_permission` WHERE `id` = '3'");
                    $modelAccess = $modelAccess->fetch_assoc();
                    $catAccess = $catAccess->fetch_assoc();
                    $clrAccess = $clrAccess->fetch_assoc();
                    $brandAccess = $brandAccess->fetch_assoc();

                    ?>


                    <br>



                    <div class="ui container segment" style=" border-radius: 15px; box-shadow: rgba(17, 17, 26, 0.1) 0px 4px 16px, rgba(17, 17, 26, 0.1) 0px 8px 24px, rgba(17, 17, 26, 0.1) 0px 16px 56px;">

                        <center>
                            <h2 class="fred" style="font-weight: 400;">Add New Product</h2>
                            <br>
                            <img src="resourses/addproduct.svg" class="add_img" alt="">
                        </center>
                        <br>
                        <div class="ui form">
                            <h4 class="ui dividing header" style="font-size: large;">Basic Details</h4>
                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Model</label>
                                <div class="two fields">
                                    <div class="field">

                                        <select class="ui fluid search dropdown" id="modelDrop">
                                            <option value="">Select Model</option>
                                            <?php
                                            for ($x = 0; $x < $model_rs->num_rows; $x++) {
                                                $model_data = $model_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $model_data["model_id"] ?>"><?php echo $model_data["model_name"] ?></option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>
                                    <?php
                                    if ($modelAccess["status"] == 1) {
                                    ?>
                                        <div class="field">
                                            <input id="modeladd" type="text" placeholder="Add New Model (Optional)">
                                        </div>
                                        <button onclick="modeladd(<?php echo $model_max['maxmod']; ?>);" id="a1" class="ui secondary button">
                                            Add
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="field">
                                            <input type="text" class="ui disabled input" style="pointer-events: none;" placeholder="Add New Model (Optional)">
                                        </div>
                                        <button class="ui secondary disabled button">
                                            Add
                                        </button>
                                    <?php
                                    }
                                    ?>

                                </div>
                            </div>
                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Brand</label>
                                <div class="two fields">
                                    <div class="field">

                                        <select class="ui fluid search dropdown" id="brandDrop">
                                            <option value="">Select Brand</option>
                                            <?php
                                            for ($x = 0; $x < $brand_rs->num_rows; $x++) {
                                                $brand_data = $brand_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $brand_data["brand_id"] ?>"><?php echo $brand_data["brand_name"] ?></option>
                                            <?php
                                            }
                                            ?>


                                        </select>
                                    </div>
                                    <?php
                                    if ($brandAccess["status"] == 1) {
                                    ?>
                                        <div class="field">
                                            <input id="brandadd" type="text" placeholder="Add New Brand (Optional)">
                                        </div>
                                        <button onclick="brandadd(<?php echo $brand_max['maxbd']; ?>);" class="ui secondary button">
                                            Add
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="field">
                                            <input type="text" class="ui disabled input" style="pointer-events: none;" placeholder="Add New Brand (Optional)">
                                        </div>
                                        <button class="ui secondary disabled button">
                                            Add
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Category</label>
                                <div class="two fields">
                                    <div class="field">

                                        <select class="ui fluid search dropdown" id="CatDrop">
                                            <option value="">Select Category</option>
                                            <?php
                                            for ($x = 0; $x < $category_rs->num_rows; $x++) {
                                                $category_data = $category_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $category_data["cat_id"] ?>"><?php echo $category_data["cat_name"] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <?php
                                    if ($catAccess["status"] == 1) {
                                    ?>
                                        <div class="field">
                                            <input id="category" type="text" placeholder="Add New Category (Optional)">
                                        </div>
                                        <button onclick="catadd(<?php echo $cat_max['maxcat']; ?>);" class="ui secondary button">
                                            Add
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="field">
                                            <input type="text" class="ui disabled input" style="pointer-events: none;" placeholder="Add New Category (Optional)">
                                        </div>
                                        <button class="ui secondary disabled button">
                                            Add
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Color</label>
                                <div class="two fields">
                                    <div class="field">

                                        <select class="ui fluid search dropdown" id="colorDrop">
                                            <option value="">Select Color</option>
                                            <?php
                                            for ($x = 0; $x < $color_rs->num_rows; $x++) {
                                                $color_data = $color_rs->fetch_assoc();

                                            ?>
                                                <option value="<?php echo $color_data["clr_id"] ?>"><?php echo $color_data["clr_name"] ?></option>
                                            <?php
                                            }
                                            ?>

                                        </select>
                                    </div>
                                    <?php
                                    if ($clrAccess["status"] == 1) {
                                    ?>
                                        <div class="field">
                                            <input id="coloradd" type="text" placeholder="Add New Color (Optional)">
                                        </div>
                                        <button onclick="clradd(<?php echo $clr_max['maxclr']; ?>);" class="ui secondary button">
                                            Add
                                        </button>
                                    <?php
                                    } else {
                                    ?>
                                        <div class="field">
                                            <input type="text" class="ui disabled input" style="pointer-events: none;" placeholder="Add New Color (Optional)">
                                        </div>
                                        <button class="ui secondary disabled button">
                                            Add
                                        </button>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </div>

                            <div class="fields">
                                <div class="eight wide field" style="padding-bottom: 10px;">
                                    <label style="font-size: larger; font-weight: 600;">Product quantity</label>
                                    <!-- <input type="number" min="0" placeholder="Price"> -->
                                    <div class="ui right labeled input">
                                        <label id="sub" type="button" for="amount" class="ui label button"><i class="ri-subtract-fill"></i></label>
                                        <input type="number" min="0" value="0" id="amount">
                                        <div id="add" type="button" class="ui label button"><i class="ri-add-fill"></i></div>
                                    </div>
                                </div>
                                <div class="eight wide field">
                                    <label style="font-size: larger; font-weight: 600;">Product Condition</label>
                                    <div class="inline fields" style="padding-top: 10px;">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input type="radio" name="frequency" id="b" checked="checked">
                                                <label for="b">Brand New</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input id="u" type="radio" name="frequency">
                                                <label for="u">Used</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Product title</label>
                                <input id="title" type="text" placeholder="Enter Product Title   (This will show up in the front of product card)">
                            </div>
                            <div class="ui form">
                                <div class="field">
                                    <label style="font-size: larger; font-weight: 600;">Product description</label>
                                    <textarea id="desc" placeholder="Enter product description"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="ui form">
                                <div class="field">
                                    <label style="font-size: larger; font-weight: 600;">Product Specification</label>
                                    <textarea id="spec" placeholder="Enter product specifications"></textarea>
                                </div>
                            </div>
                            <br>
                            <div class="field">
                                <label style="font-size: larger; font-weight: 600;">Product pictures</label>
                                <div style="overflow: hidden; display: flex; align-items: center; align-content: center;" onclick="changeproductImage();">
                                    <input id="imageUp" type="file" accept=".jpg,.jpeg,.png,.xml,.webp" multiple style="position: absolute;transform: translateX(0px);transform: scale(1); opacity: 0; cursor: pointer; width: 230px; z-index: 3;">
                                    <img src="resourses/addfile.svg" width="50px" alt="">
                                    <div class="ui labeled icon teal button" style=" cursor: pointer;">
                                        <i class="upload icon"></i>
                                        Upload pictures
                                    </div>
                                </div>

                                <div class="">
                                    <div class="ui small images">
                                        <img src="resourses/image (2).png" id="i0">
                                        <img src="resourses/image (2).png" id="i1">
                                        <img src="resourses/image (2).png" id="i2">
                                        <img src="resourses/image (2).png" id="i3">
                                        <img src="resourses/image (2).png" id="i4">

                                    </div>
                                </div>
                                <h5 style="color: rgb(94, 94, 94); font-size: 14px; font-weight: 400;" class="fred">
                                    Last selected image will be used as the product card image.
                                </h5>
                            </div>
                            <br>
                            <form action="#">
                                <h4 class="ui dividing header" style="font-size: large;">Product Pricing</h4>
                                <div class="fields">
                                    <div class="eight wide field" style="padding-bottom: 10px;">
                                        <label style="font-size: larger; font-weight: 600;">Product price</label>
                                        <input id="price" min="0" placeholder="Price">
                                    </div>
                                </div>
                                <h5 style="color: rgb(201, 22, 22); font-size: 14px; font-weight: 400;" class="fred">A delivery fee will be added to this
                                    amount according to the user location.</h5>

                                <br><br>
                                <div class="ui dividing header"></div>
                                <h5 style="color: rgb(201, 22, 22); font-size: 14px; margin-top: 5px;" class="fred">
                                    WE CHARGE 5% OF THE PRODUCT PRICE FROM ALL PRODUCTS FOR OUR SERVICE.
                                </h5>
                                <br>

                                <div onclick="addProduct();" class="ui teal button" tabindex="0">Add Product</div>
                                <br><br>
                                <center>
                                    <img src="resourses/add.svg" class="add_img2" alt="">

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
                <?php
                } else {
                ?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        Swal.fire({
                            title: "Your Shop has been blocked!",
                            text: "Zedcore has blocked your shop from this application. If you think this is a mistake, feel free to contact Zedcore support team. fstwhatsapp@gmail.com",
                            icon: "error",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.location = "index.php";
                            }
                        });
                    </script>

            </body>

            </html>

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