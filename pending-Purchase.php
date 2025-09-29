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
        if (isset($_GET["i"])) {
            $order_id = $_GET["i"];

            $order_details_rs = Database::search("SELECT * FROM `purchase_history` WHERE `u_id` = '" . $user_full_data["id"] . "' AND `or_id` = '$order_id'");
            if ($order_details_rs->num_rows > 0) {
                $order = $order_details_rs->fetch_assoc();



?>

                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Pending Purchase | Zedcore</title>
                    <link href="Styles/semantic.min.css" rel="stylesheet">
                    <link rel="stylesheet" href="Styles/cart.css">
                    <link rel="stylesheet" href="Styles/loading.css">
                    <link rel="stylesheet" href="Styles/pending-purchase.css">
                    <link rel="icon" href="resourses/logotop.svg" />

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
                    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
                    <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
                    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>
                    <style>
                        @import url("https://fonts.googleapis.com/css2?family=Fredoka:wght@300;400;500;600;700&display=swap");
                    </style>


                </head>

                <body style="background-color: rgb(245, 245, 245);">


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





                    <?php

                    $address_rs = Database::search("SELECT * FROM `invoice_address` WHERE `o_id` = '" . $order_id . "'");
                    $address = $address_rs->fetch_assoc();
                    ?>


                    <div class="ui container segment" style="min-height: 55vh; padding: 0; padding-bottom: 50px; box-shadow: rgba(0, 0, 0, 0.2) 0px 18px 50px -10px; position: relative;">
                        <div class="wishtop">
                            <span class="wishtoptxt1">Pending purchase</span>
                        </div>

                        <div class="wishContent" id="wishContent">

                            <div class="addressBox">
                                <?php
                                if ($order["status"] == 0) {
                                ?>
                                    <span class="title">Delivery Address</span>
                                    <span id="line" class="address"><?php echo $address["line1"]; ?></span>
                                    <button class="address-btn" style="cursor: pointer;" onclick="changeAddressModal();">Change Address</button>

                                <?php
                                } else {
                                ?>
                                    <span class="title">Delivery Address</span>
                                    <span id="line" class="address"><?php echo $address["line1"]; ?></span>
                                <?php
                                }
                                ?>

                            </div>

                            <table class="ui unstackable table">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Quantity</th>
                                        <th>Price (Rs)</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    $list_rs = Database::search("SELECT * FROM `purchase_history` WHERE `or_id` = '" . $order_id . "'");

                                    $city_rs_del = Database::search("SELECT * FROM `city` WHERE `city_id` = '" . $address["city_city_id"] . "'");
                                    $cityfetch_rs_del = $city_rs_del->fetch_assoc();
                                    $delivery_fee_district = 700;
                                    $delivery_fee_cal = Database::search("SELECT * FROM `delivery_fees` WHERE `district_id_del` = '" . $cityfetch_rs_del["district_district_id"] . "'");
                                    if ($delivery_fee_cal->num_rows == 1) {
                                        $delivery = $delivery_fee_cal->fetch_assoc();
                                        $delivery_fee_district = $delivery["fee"];
                                    }
                                    $item_price = 0;
                                    $delivery_fee = 0;

                                    for ($i = 0; $i < $list_rs->num_rows; $i++) {
                                        $list = $list_rs->fetch_assoc();

                                        $product_details_rs = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id` WHERE `product`.`id` = '" . $list['p_id'] . "'");
                                        $product_details = $product_details_rs->fetch_assoc();

                                        $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $list['p_id'] . "'");
                                        $product_img_data = $product_img_rs->fetch_assoc();


                                        $item_price = $item_price + $product_details["price"];
                                        $delivery_fee = $delivery_fee + $delivery_fee_district;

                                    ?>
                                        <tr>
                                            <td>
                                                <h4 class="ui image header">
                                                    <img src="<?php echo $product_img_data["img_path"] ?>" class="ui rounded image">
                                                    <div class="content">
                                                        <?php echo $product_details["title"] ?>
                                                        <div class="sub header"><?php echo $product_details["brand_name"] ?>
                                                        </div>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <?php echo $list["qty"]; ?>
                                            </td>
                                            <td>
                                                <?php echo $product_details["price"] ?>.00
                                            </td>
                                        </tr>

                                    <?php
                                    }

                                    $total = $delivery_fee + $item_price;
                                    ?>


                                </tbody>
                            </table>
                            <div class="payBox">
                                <div class="box">
                                    <span>Delivery Free : </span>
                                    <span> Rs <?php echo $delivery_fee ?>.00</span>
                                </div>
                                <div class="box">
                                    <span>Total Payment : </span>
                                    <span> Rs <?php echo $total ?>.00</span>
                                </div>
                                <?php
                                if ($order["status"] == 0) {
                                ?>
                                    <input type="hidden" id="oid" value="<?php echo $order_id; ?>">
                                    <button class="placeOrder" style="cursor: pointer;" onclick="placeOrder();">Place Order</button>
                                <?php
                                } else {
                                ?>
                                    <button class="placeOrder">Paid</button>
                                    <button class="ui black basic button" style="width:100%; cursor:pointer;" onclick="window.location='invoice.php?id=<?php echo $order_id; ?>'">Invoice</button>

                                <?php
                                }
                                ?>

                            </div>


                        </div>


                    </div>


                    <?php

                    $city_rs = Database::search("SELECT * FROM `city`");
                    $province_rs = Database::search("SELECT * FROM `province`");
                    $district_rs = Database::search("SELECT * FROM `district`");
                    $user_address_rs = Database::search("SELECT * FROM `invoice_address` INNER JOIN `city` ON invoice_address.city_city_id = city.city_id INNER JOIN  `district` ON city.district_district_id = district.district_id INNER JOIN `province` ON district.province_province_id = province.province_id WHERE `user_id` = '" . $user_full_data["id"] . "'");

                    $city_num = $city_rs->num_rows;
                    $province_num = $province_rs->num_rows;
                    $district_num = $district_rs->num_rows;
                    $user_address_num = $user_address_rs->num_rows;
                    $user_address_data = $user_address_rs->fetch_assoc();

                    ?>

                    <div class="ui modal" id="changeAddress">
                        <div class="header">
                            Delivery Address
                        </div>
                        <div class="content">
                            <form class="ui form">
                                <h4 class="ui dividing header">Shipping Information</h4>
                                <div class="field">
                                    <label>Name</label>
                                    <div class="two fields">
                                        <div class="field">
                                            <input type="text" disabled name="shipping[first-name]" placeholder="First Name" value="<?php echo $user_full_data["fname"] ?>">
                                        </div>
                                        <div class="field">
                                            <input type="text" disabled name="shipping[last-name]" placeholder="Last Name" value="<?php echo $user_full_data["lname"] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="fields">
                                    <div class="ten wide field">
                                        <label>Billing Address</label>
                                        <?php
                                        if (!empty($user_address_data["line1"])) {
                                        ?>
                                            <input type="text" id="inputAddress" placeholder="1234 Main St" value="<?php echo $user_address_data["line1"] ?>">

                                        <?php
                                        } else {
                                        ?>
                                            <input type="text" id="inputAddress" placeholder="1234 Main St">

                                        <?php
                                        }
                                        ?>

                                    </div>
                                    <div class="six wide field">
                                        <label>Postal Code</label>
                                        <input type="text" id="inputZip" placeholder="Code">
                                    </div>
                                </div>

                                <div class="two fields">
                                    <div class="field">
                                        <label>City</label>
                                        <select class="ui dropdown" id="city">



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
                                    <div class="field">
                                        <label>District</label>
                                        <select class="ui dropdown" id="district">



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

                                    <div class="field">
                                        <label>Province</label>
                                        <select class="ui dropdown" id="province">
                                            <option value="">Select category</option>



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
                                </div>
                        </div>
                        <div class="actions">
                            <input type="hidden" value="<?php echo $order_id; ?>" id="orderId">
                            <div class="ui button deny">Cancel</div>
                            <div class="ui black button" onclick="changeAddress();">OK</div>
                        </div>
                    </div>


                    <!-- Modal -->
                    <!-- <div class="modal" id="staticBackdrop" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    </div> -->

                    <!-- Site footer -->
                    <br><br>


                    <?php
                    include "fotter.php";
                    ?>












                    <script src="Animations/cartanimate.js"></script>
                    <script src="Process/cartProcess.js"></script>
                    <script src="Process/pending-purchase.js"></script>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        $('#more')
                            .dropdown();
                        $('#director')
                            .dropdown();
                        $('#navDrop')
                            .dropdown();
                        $('#city')
                            .dropdown();
                        $('#district')
                            .dropdown();
                        $('#province')
                            .dropdown();



                        $('.ui.modal')
                            .modal();
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
                alert("Something went wrong!");
                window.history.back();
            </script>
    <?php
        }
    }
} else {
    ?>
    <script>
        window.location = "index.php";
    </script>
<?php
}
?>