<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $user_ses = $_SESSION["u"];
}

$search_txt = $_POST["s"];

$all_product_rs = Database::search("SELECT * FROM `product` WHERE `title` LIKE '%{$search_txt}%' ");
if ($all_product_rs->num_rows > 0) {
    for ($x = 0; $x < $all_product_rs->num_rows; $x++) {
        $all_product_data = $all_product_rs->fetch_assoc();


?>
        <div class="result" onclick="choseProd(<?php echo $all_product_data['id'] ?>);"><?php echo $all_product_data["title"] ?></div>
    <?php
    }
} else {
    ?>
    <div class="result" style="display: flex; justify-content: center; padding-left: 0;">Product not Found!</div>

<?php
}



?>