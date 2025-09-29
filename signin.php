<?php
include "Process/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zedcore | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <link rel="stylesheet" href="Styles/signin.css">
    <link rel="stylesheet" href="Styles/bootstrap.css">
    <link rel="icon" href="resourses/logotop.svg" />
</head>

<body id="body" style="height: 100vh!important">

    <style>

    </style>
    <div class="contain" id="contain">
        <div class="design">
            <div class="pill-1 rotate-45" id="pill-1"></div>
            <div class="pill-2 rotate-45" id="pill-2"></div>
            <div class="pill-3 rotate-45" id="pill-3"></div>
            <div class="pill-4 rotate-45" id="pill-4"></div>
            <div class="pill-5 rotate-45" id="pill-5"></div>
            <div>
                <img id="des-img" src="resourses/imageedit_1_6093473234 (1).svg" alt="">
            </div>
        </div>



        <div class="login">
            <div class="logo">
                <img src="resourses/imageedit_1_6093473234 (1).svg" alt="">
            </div>
            <div class="title-box" id="title-box">
                <a href="#" class="title" style="color: rgb(17, 196, 142);" id="lg-btn" onclick="disap();">Login</a>
                <a class="title" style="color: black;" id="reg-btn" onclick="disap();">Register</a>
            </div>
            <div class="error-txt d-none" id="error-box"></div>

            <div style="display: flex;">

                <?php
                $email = "";
                $password = "";

                if (isset($_COOKIE["email"])) {
                    $email = $_COOKIE["email"];
                }

                if (isset($_COOKIE["password"])) {
                    $password = $_COOKIE["password"];
                }
                ?>

                <center>
                    <div class="signin" id="signin">
                        <div class="si-text-input">
                            <i class="ri-user-fill"></i>
                            <input type="email" placeholder="Email" id="email2" value="<?php echo $email; ?>">
                        </div>
                        <div class="si-text-inputpw">
                            <i class="ri-lock-fill"></i>
                            <input type="password" placeholder="Password" id="password2" value="<?php echo $password; ?>">
                            <i id="pwicon" class="ri-eye-fill wht pw"></i>
                        </div>
                        <label class="remem-txt">
                            <input class="remem-box" type="checkbox" name="remember" id="rememberme"> Remember me
                        </label>
                        <button class="login-btn" onclick="signin();">LOGIN</button>
                        <a href="#" class="forgot" onclick="fgPw();">Forgot Username/Password?</a>
                        <div class="create">
                            <a href="#" id="create-acc">Create Your Account</a>
                            <i class="ri-arrow-right-fill"></i>
                        </div>
                    </div>

                    <div class="signup" id="signup">
                        <div class="si-text-input">
                            <input type="text" placeholder="First Name" id="fname">
                        </div>
                        <div class="si-text-input">
                            <input type="text" placeholder="Last Name" id="lname">
                        </div>
                        <div class="si-text-input">
                            <i class="ri-mail-fill"></i>
                            <input type="email" placeholder="Email" id="email">
                        </div>

                        <div class="si-text-inputpw1">
                            <i class="ri-lock-fill"></i>
                            <input type="password" placeholder="Password" id="password">
                            <i id="pwicon2" class="ri-eye-fill wht pw"></i>
                        </div>
                        <div class="si-text-input">
                            <i class="ri-smartphone-fill"></i>
                            <input type="text" placeholder="Mobile" id="mobile">
                        </div>
                        <div class="si-text-input">

                            <select class="drop" placeholder="Gender" id="gender">

                                <?php
                                $rs = Database::search("SELECT * FROM `gender`");
                                $num = $rs->num_rows;

                                for ($x = 0; $x < $num; $x++) {
                                    $data = $rs->fetch_assoc();
                                ?>


                                    <option class="option" value="<?php echo $data["gender_id"]; ?>">
                                        <?php echo $data["gender_name"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <button class="login-btn" onclick="register();">SIGN UP</button>

                        <div class="create1">
                            <i class="ri-arrow-left-fill"></i>
                            <a href="#" id="hav-acc">Already have an account</a>

                        </div>
                    </div>
                </center>


            </div>

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
                    <div class="error-txt" id="error-boxpop"></div>
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
                        <input type="password" class="form-control" id="pw1" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <i id="pwicon3" class="ri-eye-fill wht pw3"></i>
                        <span class="input-group-text">New Password

                        </span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" id="pw2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <i id="pwicon4" class="ri-eye-fill wht pw2"></i>
                        <span class="input-group-text">Re-enter Password</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="modal-btn" onclick="upDt();">RESET</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="emsent" tabindex="-1" aria-hidden="true">
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


    <div class="shade" id="shade"></div>
    <div class="lds-ellipsis" id="load">
        <div></div>
        <div></div>
        <div></div>
        <div></div>
    </div>
    <script src="Process/script.js"></script>
    <script src="Animations/index_animate.js"></script>
    <script src="Animations/pass-show-hide.js"></script>
    <script src="Animations/bootstrap.bundle.js"></script>
    <script src="Animations/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>