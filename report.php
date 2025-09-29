<?php

session_start();
include "process/connection.php";

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "'");
    if ($permissionValidation->num_rows > 0) {
        $array = array();
        for ($i = 0; $i < $permissionValidation->num_rows; $i++) {
            $valid = $permissionValidation->fetch_assoc();
            $array[] = $valid["cat_id"];
        }

?>

        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Reports | Zedcore</title>
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

        <body style="background-color: rgb(245, 245, 245);" onload="printReport();">


            <?php
            if (!isset($_GET["type"]) || empty($_GET["type"])) {
            ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    Swal.fire({
                        title: "Report Type not Found!",
                        text: "Please select report type form the admin panel of zedcore.",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.close();
                        }
                    });
                </script>
            <?php
            } else if (!isset($_GET["status"]) || empty($_GET["status"])) {
            ?>
                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                <script>
                    Swal.fire({
                        title: "Report Status not Found!",
                        text: "Please check the report status in the admin panel of zedcore.",
                        icon: "error",
                        confirmButtonText: "OK"
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.close();
                        }
                    });
                </script>
                <?php
            } else {

                $type = $_GET["type"];
                $status = $_GET["status"];

                if ($type == 1) {
                    if (in_array("2", $array)) {
                        $query = "SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id`";

                        $condition = [];

                        if (isset($_GET["sD"]) && !empty($_GET["sD"]) && isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `datetime_added` BETWEEN '" . $_GET["sD"] . "' AND '" . $_GET["eD"] . "'";
                        } else if (isset($_GET["sD"]) && !empty($_GET["sD"])) {
                            $condition[] = " `datetime_added` >= '" . $_GET["sD"] . "'";
                        } else if (isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `datetime_added` <= '" . $_GET["eD"] . "'";
                        }
                        if ($status == 1) {
                            $condition[] = " `status_status_id` = '1'";
                        } else if ($status == 2) {
                            $condition[] = " `status_status_id` = '2'";
                        }
                        if (!empty($condition)) {
                            $query .= " WHERE" . implode(" AND", $condition) . "";
                        }

                        $result_rs = Database::search($query);

                        if ($result_rs->num_rows > 0) {
                ?>
                            <div class="ui container" style="padding-top: 30px;" id="printArea">
                                <table class="ui unstackable table">
                                    <h2 class="ui header">Product Report</h2>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Quantity</th>
                                            <th>Price (Rs)</th>
                                            <th>Seller</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <?php
                                    for ($i = 0; $i < $result_rs->num_rows; $i++) {
                                        $result = $result_rs->fetch_assoc();
                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $result["id"] . "'");
                                        $img = $img_rs->fetch_assoc();


                                    ?>
                                        <tr>
                                            <td>
                                                <h4 class="ui image header">
                                                    <img src="<?php echo $img["img_path"] ?>" class="ui rounded image">
                                                    <div class="content">
                                                        <?php echo $result["title"] ?>
                                                        <div class="sub header"><?php echo $result["brand_name"] ?>
                                                        </div>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <?php echo $result["qty"] ?>
                                            </td>
                                            <td>
                                                <?php echo $result["price"] ?>.00
                                            </td>
                                            <td>
                                                <?php echo $result["user_email"] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($result["status_status_id"] == 1) {
                                                ?>
                                                    Active
                                                <?php
                                                } else if ($result["status_status_id"] == 2) {
                                                ?>
                                                    Deactive
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            <script>
                                Swal.fire({
                                    title: "No results Found!",
                                    text: "No results Found at the moment",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.close();
                                    }
                                });
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            Swal.fire({
                                title: "access Denied!",
                                text: "You don't have access to this report!",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                }
                            });
                        </script>
                        <?php
                    }
                }

                else if ($type == 2) {
                    if (in_array("5", $array)) {
                        $query = "SELECT * FROM `user`";

                        $condition = [];

                        if (isset($_GET["sD"]) && !empty($_GET["sD"]) && isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `joined_date` BETWEEN '" . $_GET["sD"] . "' AND '" . $_GET["eD"] . "'";
                        } else if (isset($_GET["sD"]) && !empty($_GET["sD"])) {
                            $condition[] = " `joined_date` >= '" . $_GET["sD"] . "'";
                        } else if (isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `joined_date` <= '" . $_GET["eD"] . "'";
                        }
                        if ($status == 1) {
                            $condition[] = " `status_status_id` = '1'";
                        } else if ($status == 2) {
                            $condition[] = " `status_status_id` = '2'";
                        }
                        if (!empty($condition)) {
                            $query .= " WHERE" . implode(" AND", $condition) . "";
                        }

                        $result_rs = Database::search($query);

                        if ($result_rs->num_rows > 0) {
                        ?>
                            <div class="ui container" style="padding-top: 30px;" id="printArea">
                                <table class="ui unstackable table">
                                    <h2 class="ui header">User Report</h2>
                                    <thead>
                                        <tr>
                                            <th>Customer</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Join date</th>
                                            <th>Sell Approval</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <?php
                                    for ($i = 0; $i < $result_rs->num_rows; $i++) {
                                        $result = $result_rs->fetch_assoc();

                                        $date = explode(" ", $result["joined_date"]);
                                        if (!empty($result['img'])) {
                                            $img = $result['img'];
                                        } else {
                                            if ($result["gender_gender_id"] == 1) {
                                                $img = "profilepic/default/male.png";
                                            } else {
                                                $img = "profilepic/default/female.png";
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <h4 class="ui image header">
                                                    <img src="<?php echo $img ?>" class="ui rounded image">
                                                    <div class="content">
                                                        <?php echo $result["fname"] ?> <?php echo $result["lname"] ?>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <?php echo $result["email"] ?>
                                            </td>
                                            <td>
                                                <?php echo $result["mobile"] ?>
                                            </td>
                                            <td>
                                                <?php echo $date[0] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($result["sell_approve"] == 1) {
                                                ?>
                                                    Yes
                                                <?php
                                                } else {
                                                ?>
                                                    No
                                                <?php
                                                }
                                                ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($result["status_status_id"] == 1) {
                                                ?>
                                                    Active
                                                <?php
                                                } else if ($result["status_status_id"] == 2) {
                                                ?>
                                                    Inactive
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            <script>
                                Swal.fire({
                                    title: "No results Found!",
                                    text: "No results Found at the moment",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.close();
                                    }
                                });
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            Swal.fire({
                                title: "access Denied!",
                                text: "You don't have access to this report!",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                }
                            });
                        </script>
                        <?php
                    }
                }

                else if ($type == 3) {
                    if (in_array("7", $array)) {
                        $query = "SELECT * FROM `admin`";

                        $condition = [];

                        if (isset($_GET["sD"]) && !empty($_GET["sD"]) && isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `added_date` BETWEEN '" . $_GET["sD"] . "' AND '" . $_GET["eD"] . "'";
                        } else if (isset($_GET["sD"]) && !empty($_GET["sD"])) {
                            $condition[] = " `added_date` >= '" . $_GET["sD"] . "'";
                        } else if (isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `added_date` <= '" . $_GET["eD"] . "'";
                        }
                        if ($status == 1) {
                            $condition[] = " `status` = '1'";
                        } else if ($status == 2) {
                            $condition[] = " `status` = '2'";
                        }
                        if (!empty($condition)) {
                            $query .= " WHERE" . implode(" AND", $condition) . "";
                        }

                        $result_rs = Database::search($query);

                        if ($result_rs->num_rows > 0) {
                        ?>
                            <div class="ui container" style="padding-top: 30px;" id="printArea">
                                <table class="ui unstackable table">
                                    <h2 class="ui header">Admin Report</h2>
                                    <thead>
                                        <tr>
                                            <th>Admin</th>
                                            <th>Email</th>
                                            <th>role</th>
                                            <th>Join date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <?php
                                    for ($i = 0; $i < $result_rs->num_rows; $i++) {
                                        $result = $result_rs->fetch_assoc();

                                        $date = explode(" ", $result["added_date"]);
                                        if (!empty($result['img'])) {
                                            $img = $result['img'];
                                        } else {
                                            if ($result["gender_gender_id"] == 1) {
                                                $img = "profilepic/default/male.png";
                                            } else {
                                                $img = "profilepic/default/female.png";
                                            }
                                        }
                                    ?>
                                        <tr>
                                            <td>
                                                <h4 class="ui image header">
                                                    <img src="<?php echo $img ?>" class="ui rounded image">
                                                    <div class="content">
                                                        <?php echo $result["fname"] ?> <?php echo $result["lname"] ?>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <?php echo $result["admin_email"] ?>
                                            </td>
                                            <td>
                                                <?php echo $result["role"] ?>
                                            </td>
                                            <td>
                                                <?php echo $date[0] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($result["status"] == 1) {
                                                ?>
                                                    Active
                                                <?php
                                                } else if ($result["status"] == 2) {
                                                ?>
                                                    Inactive
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            <script>
                                Swal.fire({
                                    title: "No results Found!",
                                    text: "No results Found at the moment",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.close();
                                    }
                                });
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            Swal.fire({
                                title: "access Denied!",
                                text: "You don't have access to this report!",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                }
                            });
                        </script>
                        <?php
                    }
                }

                else if ($type == 4) {
                    if (in_array("6", $array)) {
                        $query = "SELECT * FROM `shop`";

                        $condition = [];

                        if (isset($_GET["sD"]) && !empty($_GET["sD"]) && isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `shop_jonied_date` BETWEEN '" . $_GET["sD"] . "' AND '" . $_GET["eD"] . "'";
                        } else if (isset($_GET["sD"]) && !empty($_GET["sD"])) {
                            $condition[] = " `shop_jonied_date` >= '" . $_GET["sD"] . "'";
                        } else if (isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `shop_jonied_date` <= '" . $_GET["eD"] . "'";
                        }
                        if ($status == 1) {
                            $condition[] = " `shop_status` = '1'";
                        } else if ($status == 2) {
                            $condition[] = " `shop_status` = '2'";
                        }
                        if (!empty($condition)) {
                            $query .= " WHERE" . implode(" AND", $condition) . "";
                        }

                        $result_rs = Database::search($query);

                        if ($result_rs->num_rows > 0) {
                        ?>
                            <div class="ui container" style="padding-top: 30px;" id="printArea">
                                <table class="ui unstackable table">
                                    <h2 class="ui header">Shop Report</h2>
                                    <thead>
                                        <tr>
                                            <th>Shop</th>
                                            <th>Seller</th>
                                            <th>Join date</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <?php
                                    for ($i = 0; $i < $result_rs->num_rows; $i++) {
                                        $result = $result_rs->fetch_assoc();

                                        $date = explode(" ", $result["shop_jonied_date"]);
                                    ?>
                                        <tr>
                                            <td>
                                                <?php echo $result["shop_name"] ?>
                                            </td>
                                            <td>
                                                <?php echo $result["seller_id"] ?>
                                            </td>
                                            <td>
                                                <?php echo $date[0] ?>
                                            </td>
                                            <td>
                                                <?php
                                                if ($result["shop_status"] == 1) {
                                                ?>
                                                    Active
                                                <?php
                                                } else {
                                                ?>
                                                    Inactive
                                                <?php
                                                }
                                                ?>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            <script>
                                Swal.fire({
                                    title: "No results Found!",
                                    text: "No results Found at the moment",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.close();
                                    }
                                });
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            Swal.fire({
                                title: "access Denied!",
                                text: "You don't have access to this report!",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                }
                            });
                        </script>
                        <?php
                    }
                }

                else if ($type == 5) {
                    if (in_array("3", $array)) {
                        $query = "SELECT * FROM `invoice`";

                        $condition = [];

                        if (isset($_GET["sD"]) && !empty($_GET["sD"]) && isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `date` BETWEEN '" . $_GET["sD"] . "' AND '" . $_GET["eD"] . "'";
                        } else if (isset($_GET["sD"]) && !empty($_GET["sD"])) {
                            $condition[] = " `date` >= '" . $_GET["sD"] . "'";
                        } else if (isset($_GET["eD"]) && !empty($_GET["eD"])) {
                            $condition[] = " `date` <= '" . $_GET["eD"] . "'";
                        }
                        if (!empty($condition)) {
                            $query .= " WHERE" . implode(" AND", $condition) . "";
                        }

                        $result_rs = Database::search($query);

                        if ($result_rs->num_rows > 0) {
                        ?>
                            <div class="ui container" style="padding-top: 30px;" id="printArea">
                                <table class="ui unstackable table">
                                    <h2 class="ui header">Selling Report</h2>
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Customer</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Order Id</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                    <?php
                                    for ($i = 0; $i < $result_rs->num_rows; $i++) {
                                        $result = $result_rs->fetch_assoc();

                                        $product = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id` WHERE `product`.`id` = '" . $result["p_invoice_id"] . "'");
                                        $product = $product->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $result["p_invoice_id"] . "'");
                                        $img = $img_rs->fetch_assoc();

                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $result["in_user_email"] . "'");
                                        $user = $user->fetch_assoc();

                                        $date = explode(" ", $result["date"]);
                                    ?>
                                        <tr>
                                            <td>
                                                <h4 class="ui image header">
                                                    <img src="<?php echo $img["img_path"] ?>" class="ui rounded image">
                                                    <div class="content">
                                                        <?php echo $product["title"] ?>
                                                        <div class="sub header"><?php echo $product["brand_name"] ?>
                                                        </div>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <h4 class="ui image header">
                                                    <div class="content">
                                                        <?php echo $user["fname"] ?>
                                                        <div class="sub header"><?php echo $result["in_user_email"] ?>
                                                        </div>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <?php echo $result["in_qty"] ?>
                                            </td>
                                            <td>
                                                <?php echo $result["total"] ?>
                                            </td>
                                            <td>
                                                <?php echo $date[0] ?>
                                            </td>
                                            <td>
                                                <?php echo $result["order_id"] ?>

                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php
                        } else {
                        ?>
                            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                            <script>
                                Swal.fire({
                                    title: "No results Found!",
                                    text: "No results Found at the moment",
                                    icon: "error",
                                    confirmButtonText: "OK"
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        window.close();
                                    }
                                });
                            </script>
                        <?php
                        }
                    } else {
                        ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            Swal.fire({
                                title: "access Denied!",
                                text: "You don't have access to this report!",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                }
                            });
                        </script>
                    <?php
                    }
                } else if ($type == 6) {

                    $query = "SELECT * FROM `invoice`";

                    $condition = [];

                    if (isset($_GET["sD"]) && !empty($_GET["sD"]) && isset($_GET["eD"]) && !empty($_GET["eD"])) {
                        $condition[] = " `date` BETWEEN '" . $_GET["sD"] . "' AND '" . $_GET["eD"] . "'";
                    } else if (isset($_GET["sD"]) && !empty($_GET["sD"])) {
                        $condition[] = " `date` >= '" . $_GET["sD"] . "'";
                    } else if (isset($_GET["eD"]) && !empty($_GET["eD"])) {
                        $condition[] = " `date` <= '" . $_GET["eD"] . "'";
                    }
                    if (!empty($condition)) {
                        $query .= " WHERE" . implode(" AND", $condition) . "";
                    }

                    $result_rs = Database::search($query);

                    if ($result_rs->num_rows > 0) {
                    ?>
                        <div class="ui container" style="padding-top: 30px;" id="printArea">
                            <table class="ui unstackable table">
                                <h2 class="ui header">Income Report</h2>
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Customer</th>
                                        <th>Qty</th>
                                        <th>Date</th>
                                        <th>Income</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $subtotal = 0;
                                    for ($i = 0; $i < $result_rs->num_rows; $i++) {
                                        $result = $result_rs->fetch_assoc();

                                        $product = Database::search("SELECT * FROM `product` INNER JOIN `model_has_brand` ON `model_has_brand`.`id` = `product`.`model_has_brand_id` INNER JOIN `brand` ON `brand`.`brand_id` = `model_has_brand`.`brand_brand_id` WHERE `product`.`id` = '" . $result["p_invoice_id"] . "'");
                                        $product = $product->fetch_assoc();

                                        $img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id`='" . $result["p_invoice_id"] . "'");
                                        $img = $img_rs->fetch_assoc();

                                        $user = Database::search("SELECT * FROM `user` WHERE `email`='" . $result["in_user_email"] . "'");
                                        $user = $user->fetch_assoc();

                                        $income = ((int)$product["price"] * (int)$result["in_qty"]) * 5 / 100;
                                        $subtotal = $subtotal + $income;
                                        $date = explode(" ", $result["date"]);
                                    ?>
                                        <tr>
                                            <td>
                                                <h4 class="ui image header">
                                                    <img src="<?php echo $img["img_path"] ?>" class="ui rounded image">
                                                    <div class="content">
                                                        <?php echo $product["title"] ?>
                                                        <div class="sub header"><?php echo $product["brand_name"] ?>
                                                        </div>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <h4 class="ui image header">
                                                    <div class="content">
                                                        <?php echo $user["fname"] ?>
                                                        <div class="sub header"><?php echo $result["in_user_email"] ?>
                                                        </div>
                                                    </div>
                                                </h4>
                                            </td>
                                            <td>
                                                <?php echo $result["in_qty"] ?>
                                            </td>
                                            <td>
                                                <?php echo $date[0] ?>
                                            </td>
                                            <td>
                                                <?php echo $income ?>.00
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <h2>Total : <?php echo $subtotal; ?>.00</h2>
                        </div>
                    <?php
                    } else {
                    ?>
                        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                        <script>
                            Swal.fire({
                                title: "No results Found!",
                                text: "No results Found at the moment",
                                icon: "error",
                                confirmButtonText: "OK"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.close();
                                }
                            });
                        </script>
                    <?php
                    }
                } else {
                    ?>
                    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

                    <script>
                        Swal.fire({
                            title: "Invalid Report Type",
                            text: "Report Type is not found! Please try again",
                            icon: "error",
                            confirmButtonText: "OK"
                        }).then((result) => {
                            if (result.isConfirmed) {
                                window.close();
                            }
                        });
                    </script>
                <?php
                }
                ?>


                <script>
                    function printReport() {
                        var original = document.body.innerHTML;
                        var printArea = document.getElementById("printArea");

                        document.body.innerHTML = printArea.innerHTML;

                        window.print();

                        document.body.innerHTML = original;
                    }
                </script>
            <?php
            }
            ?>
        </body>

        </html>

    <?php

    } else {
    ?>
        <script>
            alert("Something went wrong!")
        </script>
    <?php
    }
} else {
    ?>
    <script>
        alert("Relogin to access")
    </script>
<?php
}

?>