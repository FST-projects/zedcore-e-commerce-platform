<?php
session_start();
if (isset($_SESSION["u"])) {

    $user_ses = $_SESSION["u"];
    $email = $_SESSION["u"]["email"];

    include "Process/connection.php";


    $user_full_rs = Database::search("SELECT * FROM `user` WHERE `email` = '" . $user_ses["email"] . "'");
    if ($user_full_rs->num_rows == 1) {
        $user_full_data = $user_full_rs->fetch_assoc();


        if (isset($_GET["i"])) {
            $order_id = $_GET["i"];

            $order_details_rs = Database::search("SELECT * FROM `purchase_history` WHERE `u_id` = '" . $user_full_data["id"] . "' AND `or_id` = '$order_id' AND `status` = '0'");
            if ($order_details_rs->num_rows > 0) {

?>

                <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Pay | Zedcore</title>
                    <link rel="icon" href="resourses/logotop.svg" />
                </head>

                <body onload="payhereload();">
                    <input type="hidden" id="oid" value="<?php echo $order_id; ?>">
                    <!-- PayHere loads -->

                    <script src="process/pay.js"></script>
                    <script type="text/javascript" src="https://www.payhere.lk/lib/payhere.js"></script>
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