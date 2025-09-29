<?php

session_start();
include "Process/connection.php";


if (isset($_GET["sterm"]) || !empty($_GET["sterm"])) {
    $sTerm = $_GET["sterm"];
}
if (isset($_GET["max"]) || !empty($_GET["max"])) {
    $maxValue = $_GET["max"];
}
if (isset($_GET["min"]) || !empty($_GET["min"])) {
    $minValue = $_GET["min"];
}
if (isset($_GET["cat2"]) || !empty($_GET["cat2"])) {
    $category2 = $_GET["cat2"];
}
if (isset($_GET["cat"]) || !empty($_GET["cat"])) {
    $category = $_GET["cat"];
}
if (isset($_GET["brand"]) || !empty($_GET["brand"])) {
    $brand = $_GET["brand"];
}
if (isset($_GET["model"]) || !empty($_GET["model"])) {
    $model = $_GET["model"];
}
if (isset($_GET["condi"]) || !empty($_GET["condi"])) {
    $condition = $_GET["condi"];
}
if (isset($_GET["sort"]) || !empty($_GET["sort"])) {
    $sort = $_GET["sort"];
}
if (isset($_GET["clr"]) || !empty($_GET["clr"])) {
    $clr = $_GET["clr"];
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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search | Zedcore</title>
    <link rel="stylesheet" href="Styles/bootstrap.css">
    <link href="Styles/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Styles/searchresult.css">
    <link rel="stylesheet" href="Styles/loading.css">
    <link rel="icon" href="resourses/logotop.svg" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>








</head>

<body onload="onLoadsearch(1);" style="background-color: rgb(245, 245, 245);">

    <input type="hidden" value="<?php echo $sTerm ?>" id="sterm">
    <input type="hidden" value="<?php echo $maxValue ?>" id="max">
    <input type="hidden" value="<?php echo $minValue ?>" id="min">
    <input type="hidden" value="<?php echo $category2 ?>" id="cat2">
    <input type="hidden" value="<?php echo $category ?>" id="cat">
    <input type="hidden" value="<?php echo $brand ?>" id="brand">
    <input type="hidden" value="<?php echo $model ?>" id="model">
    <input type="hidden" value="<?php echo $clr ?>" id="clr">
    <input type="hidden" value="<?php echo $condition ?>" id="condi">
    <input type="hidden" value="<?php echo $sort ?>" id="sort">

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
                            <div class="link-des o2">
                                <i class="heart outline icon"></i>
                                Wishlist
                            </div>
                            <div class="link-des o4">
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

    <div class="dBack" id="dback"></div>

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
                            <input id="minP" type="number" name="price" value="<?php echo $minValue ?>" placeholder="Min price">
                        </div>
                        <div class="eight wide field">
                            <label>Max</label>
                            <input id="maxP" type="number" name="price" value="<?php echo $maxValue ?>" placeholder="Max price">
                        </div>
                    </div>
                    <br>
                    <div class="ui animated button" tabindex="0" onclick="filter(1);">
                        <div class="visible content">Search</div>
                        <div class="hidden content">
                            <i class="right arrow icon"></i>
                        </div>
                    </div>
                </form>

                <br>
                <!-- <form class="ui form">
                        <h4 class="ui dividing header">Filter by category</h4>
                        <div style=" display: flex; justify-content: center;">
                            <select name="gender" class="ui dropdown" id="select3">
                                <option value="">Select category</option>
                                <option id="all2" value="0">All</option>


                                <?php
                                $product_cat_rs = Database::search("SELECT * FROM `category`");
                                for ($x = 0; $x < $product_cat_rs->num_rows; $x++) {
                                    $product_cat_data = $product_cat_rs->fetch_assoc();

                                ?>
                                    <option value="<?php echo $product_cat_data["cat_id"]; ?>"
                                    ><?php echo $product_cat_data["cat_name"]; ?></option>

                                <?php

                                }
                                ?>

                            </select>
                        </div>

                    </form> -->
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
                                <option value="<?php echo $product_brand_data["brand_id"]; ?>" <?php if ($product_brand_data["brand_id"] == $brand) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $product_brand_data["brand_name"]; ?></option>

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
                                <option value="<?php echo $product_model_data["model_id"]; ?>" <?php if ($product_model_data["model_id"] == $model) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $product_model_data["model_name"]; ?></option>

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
                                <option value="<?php echo $product_color_data["clr_id"]; ?>" <?php if ($product_color_data["clr_id"] == $clr) {
                                                                                                    echo "selected";
                                                                                                } ?>><?php echo $product_color_data["clr_name"]; ?></option>

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
                        <?php
                        if ($condition == 1) {
                        ?>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="cond" checked id="bn">
                                    <label for="bn">Brandnew</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="cond" id="ud">
                                    <label for="ud">Used</label>
                                </div>
                            </div>
                        <?php
                        } else if ($condition == 2) {
                        ?>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" name="cond" id="bn">
                                    <label for="bn">Brandnew</label>
                                </div>
                            </div>
                            <div class="field">
                                <div class="ui radio checkbox">
                                    <input type="radio" checked name="cond" id="ud">
                                    <label for="ud">Used</label>
                                </div>
                            </div>

                        <?php
                        } else {
                        ?>
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
                        <?php
                        }
                        ?>


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div style="padding-left: 20px; margin-top: 10px;">
        <div class="ui breadcrumb">
            <a class="section" onclick="window.location='index.php';">Home</a>
            <span class="divider">/</span>
            <div class="active section">Search</div>
        </div>
    </div>

    <div class="ui container segment">
        <div class="d-flex search" role="search">
            <!-- <div class="select">
                <select class="selection " style="cursor: pointer;">

                    <option value="">All Categories</option>
                    <option value="">Electroncis</option>
                    <option value="">Business & Industrial</option>
                    <option value="">Home & Garden</option>
                    <option value="">collections & Art</option>
                    <option value="">Sporting goods </option>
                </select>
                <i class="fa-solid fa-caret-down"></i>
            </div> -->
            <div class="catgerybox" style="height: 40px;">
                <select name="gender" class="ui fluid dropdown" id="select">
                    <option value="">All Categories</option>

                    <?php
                    $product_rs = Database::search("SELECT * FROM `category`");
                    for ($x = 0; $x < $product_rs->num_rows; $x++) {
                        $product_data = $product_rs->fetch_assoc();

                    ?>
                        <option value="<?php echo $product_data["cat_id"]; ?>" <?php if ($product_data["cat_id"] == $category2 || $product_data["cat_id"] == $category) {
                                                                                    echo "selected";
                                                                                } ?>><?php echo $product_data["cat_name"]; ?></option>

                    <?php

                    }
                    ?>
                </select>
            </div>
            <div style="width: 100%; height: 40px; position: relative;">
                <input id="mainsearchbar" class="me-2 searchsyl" type="search" value="<?php echo $sTerm ?>" placeholder="Search" aria-label="Search">
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
                            <option value="<?php echo $product_data["cat_id"]; ?>" <?php if ($product_data["cat_id"] == $category2 || $product_data["cat_id"] == $category) {
                                                                                        echo "selected";
                                                                                    } ?>><?php echo $product_data["cat_name"]; ?></option>

                        <?php

                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="searchbox">
                <div>
                    <div class="btnsearch" onclick="filter(1);">Search</div>
                    <div class="btnsearch2" onclick="filter(1);">
                        <i class="ri-search-line"></i>
                    </div>
                </div>
                <div style="display: flex; align-items: center; align-content: center; justify-content: center;">
                    <div id="slideTrig" class="advancebox" onclick="slider();">
                        <i class="ri-equalizer-line"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div style="display: flex; align-items: center; align-content: center; justify-content: center;">
        <div style="display: block;" class="ui segment containerWidth">
            <div class="ui menu" style="position: relative; height: 45px;">

                <div class="sortDrop">
                    <select name="gender" class="ui dropdown" id="select7" onchange="filter(1);">
                        <option value="">Sort By</option>
                        <option value="1">None</option>
                        <option value="2">Price: Low - High</option>
                        <option value="3">Price: High - Low</option>
                        <option value="4">Time: New - Old</option>
                        <option value="5">Time: Old - New</option>
                    </select>
                </div>
            </div>
            <div id="resultGrid">
                <!-- product loads here -->

            </div>


        </div>
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

    <br><br>


    <!-- fotter -->
    <?php include "fotter.php"; ?>
    <!-- fotter -->














    <script src="Process/searchresult.js"></script>
    <script src="Animations/popAnimate.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        $('#select')
            .dropdown();

        $('#select1')
            .dropdown();

        $('#select2')
            .dropdown();
        $('#more')
            .dropdown();
        $('#director')
            .dropdown();
        $('#navDrop')
            .dropdown();

        $('#select3')
            .dropdown();

        $('#select4')
            .dropdown();

        $('#select5')
            .dropdown();
        $('#select6')
            .dropdown();
        $('#select7')
            .dropdown();


        $('#clear1').click(function() {
            $('#select2')
                .dropdown("clear");
        })

        $('#clear2').click(function() {
            $('#select1')
                .dropdown("clear");
        })
        $('.ui.rating')
            .rating('disable');

        $('.ui.modal')
            .modal();
    </script>

</body>

</html>


<?php

?>