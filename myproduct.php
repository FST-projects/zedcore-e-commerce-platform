<?php
session_start();

include "Process/connection.php";

if (isset($_SESSION["u"])) {
    $user_ses = $_SESSION["u"];
    $email = $_SESSION["u"]["email"];
    $pageno;


    $user_full_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user_ses["email"] . "'");
    if ($user_full_rs->num_rows == 1) {
        $user_full_data = $user_full_rs->fetch_assoc();

        if ($user_full_data["sell_approve"] == 1) {
            $shop_rs = Database::search("SELECT * FROM `shop` WHERE `seller_id` = '" . $user_ses["email"] . "'");
            $shop = $shop_rs->fetch_assoc();






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
                <title>My Products</title>
                <!-- <link rel="stylesheet" href="Styles/bootstrap.css"> -->
                <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
                <link rel="stylesheet" href="Styles/myproduct.css">
                <link rel="stylesheet" href="Styles/loading.css">
                <link rel="icon" href="resourses/logotop.svg" />

                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
                <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
                <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>



            </head>

            <body onload="clearFil(0);">
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
                                        <div class="item" onclick="window.location='addproduct.php'"><i class="plus icon"></i> Add Products</div>
                                        <?php
                                        $quest_rs = Database::search("SELECT title,product.id FROM `question` INNER JOIN `product` ON product.id = question.pid WHERE `user_email` = '" . $email . "' AND `msg_status` = '0' GROUP BY `pid`;");
                                        $ques_number = $quest_rs->num_rows;


                                        ?>

                                        <div class="item" style="display: flex;" onclick="window.location='questionChat.php'">
                                            <i class="facebook messenger icon"></i>Product Questions <?php if ($ques_number > 0) {
                                                                                                        ?><div style="margin-left: 10px; background-color: red; color: white; border-radius: 4px; width: fit-content; padding: 5px; height: 15px; display: flex; align-items: center; justify-content: center; font-size: 14px;"><?php echo $ques_number; ?></div><?php

                                                                                                                                                                                                                                                                                                                                                                } ?>
                                        </div>
                                        <div class="item" onclick="awarefollowersModal();"><i class="bullhorn icon"></i>Aware Followers</div>
                                    </div>
                                </div>
                            </div>




                            <div class="topother">
                                <div class="tophedCon" onclick="window.location='contact.php'">Help & Support</div>
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

                                        <div class="item" style="display: flex;" onclick="window.location='questionChat.php'">
                                            <i class="facebook messenger icon"></i>Product Questions <?php if ($ques_number > 0) {
                                                                                                        ?><div style="margin-left: 10px; background-color: red; color: white; border-radius: 4px; width: fit-content; padding: 5px; height: 15px; display: flex; align-items: center; justify-content: center; font-size: 14px;"><?php echo $ques_number; ?></div><?php

                                                                                                                                                                                                                                                                                                                                                                } ?>
                                        </div>
                                        <div class="item" onclick="awarefollowersModal();"><i class="bullhorn icon"></i>Aware Followers</div>
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






                        </div>
                        <div class="rightcon">
                            <div class="icon2"><i class="fa-regular fa-heart"></i></div>
                            <div class="tophedCon icon1" style="margin-left: 5px;"><i class="fa-solid fa-cart-shopping"></i></div>







                            <div class="profilebox" id="profilebox" onclick="showMenu();">

                                <div class="profilenm">
                                    <b>Hi,</b>&nbsp;<?php echo $user_full_data["fname"] ?>
                                </div>
                                <div class="profile">
                                    <img src="<?php echo $img; ?>" alt="" id="profileImg">
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
                                    <img src="<?php echo $img; ?>" alt="">
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


                    <div class="dBack" id="dback"></div>
                    <div class="filterBox2" id="filterBox2">
                        <div class="ui vertical menu" style="width: auto; height: 100vh;">

                            <div class="item disabled">
                                <div style="display: flex; align-items: center; align-content: center; justify-content: space-between;">
                                    <h3 class="ui header">Filter Your Products</h3>

                                    <div class="ui vertical animated button" onclick="clearFil(0);" id="clear1" tabindex="0">
                                        <div class="hidden content">clear</div>
                                        <div class="visible content">
                                            <i style="font-size: 16px;" class="ri-filter-off-line"></i>
                                        </div>
                                    </div>
                                </div>


                                <h4 class="ui dividing header">Search by product name</h4>
                                <div class="ui search" style="display: flex; justify-content: center;">
                                    <div class="ui icon input" style="width: 250px;">
                                        <input class="prompt" id="searchbar" type="text" placeholder="Search products . . .">
                                        <i onclick="filter(0);" class="search icon" style="pointer-events: all;"></i>
                                    </div>
                                    <div id="resultBox" class="result_box d-none">




                                    </div>
                                </div>

                                <br><br>
                                <form class="ui form">
                                    <h4 class="ui dividing header">Filter by price</h4>
                                    <div class="fields">
                                        <div class="eight wide field">
                                            <label>Min</label>
                                            <input id="minP" type="number" min="0" name="price" placeholder="Min price">
                                        </div>
                                        <div class="eight wide field">
                                            <label>Max</label>
                                            <input id="maxP" type="number" min="0" name="price" placeholder="Max price">
                                        </div>

                                    </div>

                                    <br>
                                    <div class="ui animated button" onclick="filter(0);" tabindex="0">
                                        <div class="visible content">Search</div>
                                        <div class="hidden content">
                                            <i class="right arrow icon"></i>
                                        </div>
                                    </div>
                                </form>

                                <br>
                                <form class="ui form">
                                    <h4 class="ui dividing header">Filter by category</h4>
                                    <div style=" display: flex; justify-content: center;">
                                        <select name="gender" class="ui dropdown" id="select2" onchange="filter(0);">
                                            <option value="">Select category</option>
                                            <option id="all2" value="0">All</option>


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

                                </form>
                            </div>
                            <div class="item disabled">
                                <h4 class="ui header">Filter by condition</h4>

                                <div class="ui form">
                                    <div class="grouped fields">
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input onclick="filter(0);" type="radio" name="cond" id="bn">
                                                <label for="bn">Brandnew</label>
                                            </div>
                                        </div>
                                        <div class="field">
                                            <div class="ui radio checkbox">
                                                <input onclick="filter(0);" type="radio" name="cond" id="ud">
                                                <label for="ud">Used</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="outercontainer">
                        <div class="filterBox">
                            <div class="ui vertical menu" style="width: auto; height: 100vh;">
                                <div class="item disabled">
                                    <div style="display: flex; align-items: center; align-content: center; justify-content: space-between;">
                                        <h3 class="ui header">Filter Your Products</h3>

                                        <div class="ui vertical animated button" onclick="clearFil(0);" id="clear2" tabindex="0">
                                            <div class="hidden content">clear</div>
                                            <div class="visible content">
                                                <i style="font-size: 16px;" class="ri-filter-off-line"></i>
                                            </div>
                                        </div>
                                    </div>


                                    <h4 class="ui dividing header">Search by product name</h4>
                                    <div class="ui search" style="display: flex; justify-content: center;">
                                        <div class="ui icon input" style="width: 250px;">
                                            <input class="prompt" id="searchbar2" type="text" placeholder="Search products . . .">
                                            <i onclick="filter(0);" class="search icon" style="pointer-events: all;"></i>
                                        </div>
                                        <div id="resultBox2" class="result_box d-none">




                                        </div>
                                    </div>
                                    <br><br>
                                    <form class="ui form">
                                        <h4 class="ui dividing header">Filter by price</h4>
                                        <div class="fields">
                                            <div class="eight wide field">
                                                <label>Min</label>
                                                <input id="minP2" type="number" name="price" placeholder="Min price">
                                            </div>
                                            <div class="eight wide field">
                                                <label>Max</label>
                                                <input id="maxP2" type="number" name="price" placeholder="Max price">
                                            </div>
                                        </div>
                                        <div class="ui animated button" onclick="filter(0);" tabindex="0">
                                            <div class="visible content">Search</div>
                                            <div class="hidden content">
                                                <i class="right arrow icon"></i>
                                            </div>
                                        </div>
                                    </form>

                                    <br>
                                    <form class="ui form">
                                        <h4 class="ui dividing header">Filter by category</h4>
                                        <div style=" display: flex; justify-content: center;">
                                            <select name="gender" class="ui dropdown" id="select1" onchange="filter(0);">
                                                <option value="">Select category</option>
                                                <option id="a11" value="0">All</option>


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

                                    </form>
                                </div>
                                <div class="item disabled">
                                    <h4 class="ui header">Filter by condition</h4>

                                    <div class="ui form">
                                        <div class="grouped fields">
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input onclick="filter(0);" type="radio" name="cond" id="bn2">
                                                    <label for="bn2">Brandnew</label>
                                                </div>
                                            </div>
                                            <div class="field">
                                                <div class="ui radio checkbox">
                                                    <input onclick="filter(0);" type="radio" name="cond" id="ud2">
                                                    <label for="ud2">Used</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="productDetil">
                            <div class="ui segment">

                                <div class="ui menu" style="position: relative; height: 45px;">
                                    <div onclick="slider();" id="slideTrig" class="header filterBtn">
                                        <i class="fa-solid fa-bars" style="margin-right: 5px; font-size: 16px; "></i>
                                        Filter
                                    </div>
                                    <div class="sortDrop">
                                        <select name="gender" class="ui dropdown" id="select" onchange="filter(0);">
                                            <option value="">Sort By</option>
                                            <option value="1">None</option>
                                            <option value="2">Price: Low - High</option>
                                            <option value="3">Price: High - Low</option>
                                            <option value="4">Time: New - Old</option>
                                            <option value="5">Time: Old - New</option>
                                        </select>
                                    </div>
                                </div>



                                <div class="ui grid" id="pdrs">

                                    <!--Product loads here -->

                                </div>



                            </div>
                        </div>
                    </div>

                    <div class="ui modal" id="changeAddress">
                        <div class="header">
                            Aware Shop Followers
                        </div>
                        <div class="content">
                            <form class="ui form">
                                <h4 class="ui dividing header">Use this option to aware your followers about shop deals, new items and many more.</h4>

                                <div class="awareImgBox">
                                    <div>
                                        <div class="awareImg">
                                            <img src="resourses/image.png" id="ImagePlace" alt="">
                                        </div>
                                        <div style="overflow: hidden; display: flex; align-items: center; align-content: center;" onclick="changeproductImage();">
                                            <input id="image" type="file" accept=".jpg,.jpeg,.png,.xml" multiple style="position: absolute;transform: translateX(0px);transform: scale(1); opacity: 0; cursor: pointer; width: 230px; z-index: 3;">
                                            <img src="resourses/addfile.svg" width="50px" alt="">
                                            <div class="ui labeled icon teal button" style=" cursor: pointer;">
                                                <i class="upload icon"></i>
                                                Upload pictures
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="sixteen wide field" style="margin-bottom: 15px;">
                                        <label>Title</label>
                                        <input type="text" id="title" placeholder="Discount">
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="sixteen wide field" style="margin-bottom: 15px;">
                                        <label>Description</label>
                                        <input type="text" id="desc" placeholder="10% discount for speakers!">
                                    </div>
                                </div>
                                <input type="hidden" value="<?php echo $email ?>" id="shopid">

                            </form>

                        </div>
                        <div class="actions">
                            <input type="hidden" value="" id="orderId">
                            <div class="ui button deny">Cancel</div>
                            <div class="ui black button" onclick="sendawareMsg();">SEND</div>
                        </div>
                    </div>


                    <!-- Site footer -->
                    <br><br>

                    <!-- fotter -->
                    <?php include "fotter.php"; ?>
                    <!-- fotter -->













                    <script src="Animations/myprodcut.js"></script>
                    <script src="Process/myproductProcess.js"></script>
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
            } else {
        ?>
        <script>
            alert("You haven't made your account a seller account!");
            window.location = "index.php";
        </script>
    <?php

            }
        } else {
    ?>
    <script>
        alert("Login details are not matched! Contact zedcore technical assistant!");
        window.location = "signin.php";
    </script>
<?php
        }
    } else {
        header('Location: signin.php');
    }


?>