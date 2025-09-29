<!DOCTYPE html>
<html lang="en">

<head>
    <title>Zedcore | invoice</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">

    <link type="text/css" rel="stylesheet" href="Styles/bootstrap.css">
    <link type="text/css" rel="stylesheet" href="Styles/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="Styles/invoice.css">

    <link rel="icon" href="resourses/logotop.svg" />



    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>

    <?php
    session_start();
    include "Process/connection.php";
    if (isset($_SESSION["u"])) {
        $email = $_SESSION["u"]["email"];
        $oid = $_GET["id"];

    ?>
        <div class="invoice-6 invoice-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="invoice-inner clearfix">
                            <div class="invoice-info clearfix" id="invoice_wrapper">
                                <div class="invoice-headar">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="invoice-logo">

                                                <div class="logo">
                                                    <img src="resourses/logo_hori.svg" alt="logo">
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="invoice-contact-us">
                                                <h1>Contact Us</h1>
                                                <ul class="link">
                                                    <li>
                                                        <i class="fa fa-map-marker"></i> Orion City, Colombo
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-envelope"></i> <a href="mailto:dsbamarasinghe1234@gmail.com">zedcore.eshop@gmail.com</a>
                                                    </li>
                                                    <li>
                                                        <i class="fa fa-phone"></i> <a href="tel:+55-417-634-7071">+94 78 582 4918</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="invoice-contant">
                                    <div class="invoice-top">
                                        <div class="row">
                                            <?php
                                            $address_rs = Database::search("SELECT * FROM `user_has_address` WHERE `user_email` = '" . $email . "'");
                                            $address_data = $address_rs->fetch_assoc();

                                            $invoice_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");
                                            $invoice_data = $invoice_rs->fetch_assoc();


                                            $string = $invoice_data["date"];
                                            $delimiter = " ";
                                            $date = explode($delimiter, $string);



                                            ?>
                                            <div class="col-sm-6">
                                                <h1 class="invoice-name">Invoice</h1>
                                            </div>
                                            <div class="col-sm-6 mb-30">
                                                <div class="invoice-number-inner">
                                                    <h2 class="name">Invoice No: #<?php echo $invoice_data["invoice_id"]; ?></h2>
                                                    <p class="mb-0">Invoice Date: <span><?php echo $date["0"] ?></span></p>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 mb-30">
                                                <div class="invoice-number">
                                                    <h4 class="inv-title-1">Invoice To</h4>
                                                    <h2 class="name mb-10"><?php echo $_SESSION["u"]["fname"] ?> <?php echo $_SESSION["u"]["lname"] ?></h2>
                                                    <p class="invo-addr-1 mb-0">
                                                        <!-- Theme Vessel <br /> -->
                                                        <?php echo $email ?> <br />
                                                        <?php echo $address_data["line1"] ?> <br />
                                                    </p>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="invoice-center">
                                        <div class="order-summary">
                                            <div class="table-outer">
                                                <table class="default-table invoice-table">
                                                    <thead>
                                                        <tr>
                                                            <th>Description</th>
                                                            <th>Quantity</th>
                                                            <th>Price</th>
                                                            <th>Delivery Fee</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $subtotal = 0;
                                                        $invoice_new_rs = Database::search("SELECT * FROM `invoice` WHERE `order_id` = '" . $oid . "'");
                                                        for ($x = 0; $invoice_new_rs->num_rows > $x; $x++) {
                                                
                                                            $invoice_fetch_data = $invoice_new_rs->fetch_assoc();


                                                            $product_rs  = database::search("SELECT * FROM `product` WHERE `id` = '" . $invoice_fetch_data["p_invoice_id"] . "'");
                                                            $product_data = $product_rs->fetch_assoc();

                                                            $total = ($product_data['price'] * $invoice_fetch_data['in_qty']) + $invoice_fetch_data["delivery_price"];

                                                            $subtotal = $subtotal + $total;
                                                        ?>
                                                            <tr>
                                                                <td><?php echo $product_data["title"] ?></td>
                                                                <td><?php echo $invoice_fetch_data["in_qty"] ?></td>
                                                                <td>LKR <?php echo $product_data["price"] ?>.00 </td>
                                                                <td>LKR <?php echo $invoice_fetch_data["delivery_price"] ?>.00</td>
                                                                <td>LKR <?php echo $total ?>.00</td>
                                                            </tr>

                                                        <?php
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><strong>Total Due</strong></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                            <td><strong>LKR <?php echo $subtotal ?>.00</strong></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="invoice-bottom">
                                        <div class="row">
                                            <div class="col-lg-7 col-md-7 col-sm-7">
                                                <div class="terms-conditions mb-30">
                                                    <h3 class="inv-title-1 mb-10">Terms & Conditions</h3>
                                                    Money-back warranty valid for one month from purchase; refunds only within warranty period; conditions apply, product must be returned undamaged.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="invoice-btn-section clearfix d-print-none">
                                <a class="btn btn-lg btn-print" onclick="printInvoice();">
                                    <i class="fa fa-print"></i> Print Invoice
                                </a>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<script>
    function printInvoice(){
        var restorePage = document.body.innerHTML;

        window.print();
        document.body.innerHTML = restorePage;
    }
</script>

    <?php
    }

    ?>


</body>

</html>