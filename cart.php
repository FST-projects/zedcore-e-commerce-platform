<?php
session_start();
if (isset($_SESSION["u"])) {

    $user_ses = $_SESSION["u"];
    $email = $_SESSION["u"]["email"];

    include "Process/connection.php";


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

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Cart | Zedcore</title>
            <link rel="stylesheet" href="Styles/bootstrap.css">
            <link href="Styles/semantic.min.css" rel="stylesheet">
            <link rel="stylesheet" href="Styles/cart.css">
            <link rel="stylesheet" href="Styles/loading.css">
            <link rel="icon" href="resourses/logotop.svg" />

            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
            <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
            <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>


        </head>

        <body onload="tikclear();" style="background-color: rgb(245, 245, 245);">

            <style>
                input[type=number]::-webkit-inner-spin-button,
                input[type=number]::-webkit-outer-spin-button {
                    -webkit-appearance: none;
                    appearance: none;
                }
            </style>

            <div class="headertop">
                <div class="leftcon">

                    <?php
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

                                    <div class="link-des o4" onclick="window.location='wishlist.php'">
                                        <i class="fa-regular fa-heart" style="margin-right: 10px;"></i>
                                        Wishlist
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
                                </div>
                            </div>
                        </div>

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
                                        <i class="shopping basket icon"></i>
                                        Sell
                                    </div>

                                    <div class="divider o3"></div>

                                    <div class="link-des o4" onclick="window.location='wishlist.php'">
                                        <i class="fa-regular fa-heart" style="margin-right: 10px;"></i>
                                        Wishlist
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

                    <div class="tophedCon icon1" style="margin-left: 5px;" onclick="window.location='wishlist.php'"><i class="fa-regular fa-heart"></i></div>







                    <div class="profilebox" id="profilebox" onclick="showMenu();">

                        <div class="profilenm">
                            <b>Hi,</b>&nbsp;<?php echo $user_full_data["fname"] ?>
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
                            <img src="<?php echo $img ?>" alt="">
                        </div>
                        <div class="menuNm">
                            <span class="name"><?php echo $user_full_data["fname"] ?> <?php echo $user_full_data["lname"] ?></span>
                            <span class="email"><?php echo $user_full_data["email"] ?></span>
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

            <div style="padding-left: 20px; margin-top: 10px;">
                <div class="ui breadcrumb">
                    <a class="section" onclick="window.location='index.php';">Home</a>
                    <span class="divider">/</span>
                    <div class="active section">My Cart</div>
                </div>
            </div>



            <div id="sumHolder" class="sumryHolder sumHide">
                <div id="sumbox" class="summery sumHide sumpadoff" style="padding-left: 10px; padding-right:10px;">
                    <div>
                        <div style="display: flex; justify-content: space-between; padding: 5px; padding-left: 10px; padding-right: 10px; background-color: white; margin-bottom: 5px; border-radius: 6px; font-size: 16px;">
                            <div style="display: flex;">
                                <span>Item price (x</span> <span id="itemnum"></span> &nbsp;<span>items)</span>
                            </div>

                            <div style="display: flex;">
                                <span>LKR</span> &nbsp;<span id="itemprice"></span><span>.00</span>
                            </div>
                        </div>
                        <div style="display: flex; justify-content: space-between; padding: 5px; padding-left: 10px; padding-right: 10px; background-color: white; margin-bottom: 5px; border-radius: 6px; font-size: 16px;">
                            <div>
                                Delivery
                            </div>
                            <div>

                            </div>
                            <div style="display: flex;">
                                <span>LKR</span> &nbsp;<span id="delivery"></span><span>.00</span>
                            </div>
                        </div>
                        <hr>
                        <div style="display: flex; justify-content: space-between; padding-left: 10px; padding-right: 10px; background-color: white; margin-bottom: 10px; border-radius: 6px; font-size: 16px;">
                            <div>
                                Total Amount
                            </div>
                            <div>

                            </div>
                            <div style="display: flex;">
                                <span>LKR</span> &nbsp;<span id="total"></span><span>.00</span>
                            </div>
                        </div>
                        <div class="buybg">
                            <button class="buybtn fred" onclick="preBuy2();">BUY NOW</button>
                        </div>
                    </div>
                </div>
            </div>

            <?php

            $user_cart_rs = Database::search("SELECT * FROM `cart` WHERE `user_id` = '" . $email . "'");

            ?>


            <div class="ui container segment" style="min-height: 55vh; padding: 0; padding-bottom: 50px; box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px; position: relative;">
                <div class="wishtop">
                    <span class="wishtoptxt1">My Cart</span>
                    <div style="display: flex;">
                        <span id="numrow" class="wishtoptxt2"><?php echo $user_cart_rs->num_rows ?></span>
                        <span class="wishtoptxt2">&nbsp; items</span>
                    </div>
                </div>

                <div class="wishContent" id="wishContent">

                    <?php

                    if ($user_cart_rs->num_rows > 0) {
                        for ($x = 0; $user_cart_rs->num_rows  > $x; $x++) {
                            $user_cart_data = $user_cart_rs->fetch_assoc();

                            $product_details_rs = Database::search("SELECT * FROM `product` WHERE `id` = '" . $user_cart_data['product_id'] . "' ");
                            $product_details = $product_details_rs->fetch_assoc();

                            $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $user_cart_data['product_id'] . "'");
                            $product_img_data = $product_img_rs->fetch_assoc();

                            if ($product_details["qty"] > 0) {
                    ?>

                                <div class="wishProduct d-flex" id="pbox<?php echo $product_details['id'] ?>">
                                    <div class="tik" id="tik<?php echo $product_details['id'] ?>">
                                        <div class="ui checkbox" style="margin-left: 8px;">
                                            <input type="checkbox" id="d<?php echo $product_details['id'] ?>" onclick="multipurch(<?php echo $product_details['id'] ?>);">
                                            <label></label>
                                        </div>
                                    </div>
                                    <div class="wishImgBox">
                                        <img src="<?php echo $product_img_data["img_path"]; ?>" class="wishImg" alt="">
                                    </div>
                                    <div class="wishdetails" id="wish<?php echo $product_details['id'] ?>">
                                        <div class="wishProdDetail">
                                            <span class="wishProdNm"><?php echo $product_details["title"]; ?></span>
                                            <div class="specBox">
                                                <?php
                                                if ($product_details["condition_condition_id"] == 1) {
                                                ?>
                                                    <span class="f1">Condition: New</span>

                                                <?php
                                                } else {
                                                ?>
                                                    <span class="f1">Condition: Used</span>

                                                <?php
                                                }
                                                ?>
                                                <div style="margin-top: 10px;" class="twoLineBlock2">
                                                    <span class="f1" style="margin-bottom: 2px;">Description : </span>
                                                    <span class="f1" style="font-size: 14px;"><?php echo $product_details["description"]; ?></span>
                                                </div>
                                            </div>
                                            <div class="ui right labeled input" style="margin-bottom: 10px;">
                                                <label id="sub<?php echo $user_cart_data['product_id']; ?>" onclick="qtydown(<?php echo $user_cart_data['product_id']; ?>);" type="button" class="ui label button"><i class="ri-subtract-fill"></i></label>
                                                <input type="text" min="1" value="<?php echo $user_cart_data['user_qty']; ?>" id="amount<?php echo $user_cart_data['product_id']; ?>" style="width: 60px; padding: 0; text-align: center; pointer-events: none;">
                                                <div id="add<?php echo $user_cart_data['product_id']; ?>" onclick="qtyup(<?php echo $user_cart_data['product_id']; ?> , <?php echo $product_details['qty'] ?>);" type="button" class="ui label button"><i class="ri-add-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="WishBtnBox">
                                            <div class="wishProdNm padTop">
                                                LKR <?php echo $product_details["price"]; ?>.00
                                            </div>
                                            <div class="btnBox">
                                                <button class="fred wishBtn wishbtn2" onclick="preBuy(<?php echo $product_details['id'] ?>);">
                                                    Buy Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cls<?php echo $product_details['id'] ?>" class="tikCls" onclick="removeProd(<?php echo $user_cart_data['product_id']; ?>);">
                                        <i class="ri-delete-bin-5-line cls"></i>
                                    </div>
                                </div>

                            <?php
                            } else {

                            ?>
                                <div class="wishProduct d-flex" id="pbox<?php echo $product_details['id'] ?>">
                                    <div class="disableCart">
                                        <p>Out of Stock</p>
                                    </div>
                                    <div class="tik">

                                    </div>
                                    <div class="wishImgBox">
                                        <img src="<?php echo $product_img_data["img_path"]; ?>" class="wishImg" alt="">
                                    </div>
                                    <div class="wishdetails" id="wish<?php echo $product_details['id'] ?>">

                                        <div class="wishProdDetail">
                                            <span class="wishProdNm"><?php echo $product_details["title"]; ?></span>
                                            <div class="specBox">
                                                <span class="f1">Condition: New</span>
                                                <div style="margin-top: 10px;" class="twoLineBlock2">
                                                    <span class="f1" style="margin-bottom: 2px;">Description : </span>
                                                    <span class="f1" style="font-size: 14px;"><?php echo $product_details["description"]; ?></span>
                                                </div>
                                            </div>
                                            <div class="ui right labeled input" style="margin-bottom: 10px;">
                                                <label type="button" class="ui label button"><i class="ri-subtract-fill"></i></label>
                                                <input type="text" min="1" value="0" style="width: 60px; padding: 0; text-align: center; pointer-events: none;">
                                                <div type="button" class="ui label button"><i class="ri-add-fill"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="WishBtnBox">
                                            <div class="wishProdNm padTop">
                                                LKR <?php echo $product_details["price"]; ?>.00
                                            </div>
                                            <div class="btnBox">
                                                <button class="fred wishBtn wishbtn2">
                                                    Buy Now
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="cls<?php echo $product_details['id'] ?>" class="tikCls" onclick="removeProd(<?php echo $user_cart_data['product_id']; ?>);">
                                        <i class="ri-delete-bin-5-line cls"></i>
                                    </div>
                                </div>
                            <?php
                            }
                            ?>

                            <center>
                                <div id="emtcart" class="d-none" style="padding-top: 30px; padding-bottom: 40px;">
                                    <div>
                                        <img src="resourses/empty (2).svg" class="statimg" alt="">
                                    </div>
                                    <br>
                                    <span class="statfontz">Add Products to Buy</span>
                                </div>
                            </center>
                        <?php
                        }
                    } else {
                        ?>
                        <center>
                            <div style="padding-top: 30px; padding-bottom: 40px;">
                                <div>
                                    <img src="resourses/empty (2).svg" class="statimg" alt="">
                                </div>
                                <br>
                                <span class="statfontz">Add Products to Buy</span>
                            </div>
                        </center>
                    <?php
                    }
                    ?>


                </div>

                <div class="continueShop" onclick="window.location='index.php';">
                    Continue Shoppping
                </div>
            </div>















            <div class="toast-container position-fixed bottom-0 end-0 p-3">
                <div id="liveToast19" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="d-flex" style="background-color: rgb(255, 201, 201); border-radius: 5px;">
                        <div class="toast-body">
                            Please Update your delivery address on Profile!
                        </div>
                        <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
                    </div>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                    <input type="text" readonly class="fred form-control-plaintext" value="<?php echo $_SESSION["u"]["email"] ?>">
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












            <script src="Animations/bootstrap.js"></script>
            <script src="Animations/cartanimate.js"></script>
            <script src="Process/cartProcess.js"></script>
            <script src="Animations/bootstrap.bundle.js"></script>
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


                $('#clear1').click(function() {
                    $('#select2')
                        .dropdown("clear");
                })

                $('#clear2').click(function() {
                    $('#select1')
                        .dropdown("clear");
                })


                $('.ui.modal')
                    .modal();
            </script>

        </body>

        </html>

    <?php
    }
} else {
    ?>
    <script>
        window.location = "signin.php";
    </script>
<?php
}
?>