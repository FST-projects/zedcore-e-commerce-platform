<?php
session_start();
include "connection.php";

if (isset($_SESSION["u"])) {
    $user_ses = $_SESSION["u"];

    $search_txt = $_POST["s"];

    $user_product_rs = Database::search("SELECT * FROM `product` WHERE `user_email` = '" . $user_ses["email"] . "' AND ( `title` LIKE '%{$search_txt}%') ");
    if ($user_product_rs->num_rows > 0){
        for ($x = 0; $x < $user_product_rs->num_rows; $x++) {
            $user_product_data = $user_product_rs->fetch_assoc();


?>
        <div class="result" onclick="choseProd(<?php echo $user_product_data['id'] ?>);"><?php echo $user_product_data["title"] ?></div>
<?php
        }
    }else{
        ?>
        <div class="result" style="display: flex; justify-content: center; padding-left: 0;">Product not Found!</div>
        
        <?php
    }

}

?>