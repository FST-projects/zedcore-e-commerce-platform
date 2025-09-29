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
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us | Zedcore</title>
    <link rel="stylesheet" href="Styles/bootstrap.css">
    <link href="Styles/semantic.min.css" rel="stylesheet">
    <link rel="stylesheet" href="Styles/wishlist.css">
    <link rel="stylesheet" href="Styles/contact.css">
    <link rel="stylesheet" href="Styles/loading.css">
    <link rel="icon" href="resourses/logotop.svg" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.5.0/dist/semantic.min.js"></script>

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
                           
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>


            <div class="topother">
                <div class="tophedCon" onclick="window.location='contact.php'">Help & Support</div>
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


    <br><br>




    <section class="about-us">
        <div class="about">

            <div class="text">
                <div style="margin-bottom: 10px;">
                    <img src="resourses/logo_hori.svg" width="270px" alt="">
                </div>
                <h2>About Us</h2>
                <p>Welcome to Zedcore, the premier platform for electronic commerce. We are dedicated to creating a seamless marketplace where sellers can showcase their diverse range of electronic products and buyers can discover the latest technology with ease and confidence.

                    At Zedcore, we pride ourselves on fostering a secure, user-friendly environment that connects sellers and buyers. Our platform is designed to accommodate a wide variety of electronic items, ensuring that our customers always have access to the most innovative and reliable products on the market.</p>
                <br><br>
                <ul class="social-icons">
                    <li><a class="facebook" href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li><a class="twitter" href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li><a class="dribbble" href="#"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a class="linkedin" href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                </ul>
            </div>
        </div>
    </section>

















    <div class="toast-container position-fixed bottom-0 end-0 p-3">
        <div id="liveToast8" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex" style="background-color: white; border-radius: 5px;">
                <div class="toast-body">
                    Product Successfully Removed from Wishlist.
                </div>
                <button type="button" class="btn-close me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>

        </div>
    </div>



    <!-- Modal -->
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










    <script src="Animations/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>



    <script src="Animations/cartanimate.js"></script>
    <script src="Process/wishProcess.js"></script>
    <script src="Animations/bootstrap.js"></script>
    <script src="Animations/bootstrap.bundle.js"></script>

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

</body>

</html>