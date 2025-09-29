<?php
include "Process/connection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Zedcore | Admin Login</title>
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>

    <link rel="stylesheet" href="Styles/adminLog.css">
    <link rel="stylesheet" href="Styles/bootstrap.css">
    <link rel="icon" href="resourses/logotop.svg" />
</head>

<body style="height: 100vh!important">

    <style>

    </style>
    <div class="contain" id="contain" style="min-height: 400px;">
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
                <a href="#" class="title" style="color: rgb(17, 196, 142); pointer-events: none;" id="lg-btn">ADMIN LOGIN</a>

            </div>
            <div class="error-txt d-none" id="error-box"></div>

            <div style="display: flex;">

                <center>
                    <div class="signin" id="signin">
                        <div class="si-text-input">
                            <i class="ri-user-fill"></i>
                            <input type="email" placeholder="Email" id="email2">
                        </div>

                        <div class="si-text-inputpw">
                            <i class="ri-lock-fill"></i>
                            <input type="password" placeholder="Password" id="password2">
                            <i id="pwicon" class="ri-eye-fill wht pw"></i>
                        </div>
                        <br><br>
                        <button class="login-btn" onclick="ckCode();">LOGIN</button>
                        <a href="#" class="forgot"  onclick="reqpwReset();">Request Password Reset</a>


                    </div>
                </center>


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
    <script src="Process/adminlog.js"></script>
    <script src="Animations/index_animate.js"></script>
    <script src="Animations/pass-show-hide.js"></script>
    <script src="Animations/bootstrap.bundle.js"></script>
    <script src="Animations/bootstrap.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</body>

</html>