<?php

include "connection.php";

session_start();

if (isset($_SESSION["u"])) {
    if (!empty($_GET["id"])) {
        $id = $_GET["id"];
        $email = $_SESSION["u"]["email"];
        $review_rs = Database::search("SELECT * FROM `review` WHERE `alert_id` = '$id'");
        $alert_rs =  Database::search("SELECT * FROM `alerts` WHERE `id` = '" . $id . "'");
        $alert = $alert_rs->fetch_assoc();
        $product_img_rs = Database::search("SELECT * FROM `product_img` WHERE `product_id` = '" . $alert["pid"] . "'");
        $product_img = $product_img_rs->fetch_assoc();
        if ($review_rs->num_rows == 1) {
            $review = $review_rs->fetch_assoc();

?>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Review</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="width: 100%; display: flex; pointer-events: none; flex-direction: column; align-items: center; align-content: center; justify-content: center; margin-top: 20px; margin-bottom: 20px;">
                    <div>
                        <img src="<?php echo $product_img["img_path"] ?>" style="width: 180px;" alt="">
                    </div>
                    <div class="ui massive star rating review" data-rating="<?php echo $review["stars"]; ?>" data-max-rating="5" id="starsrate"></div>
                </div>
                <div class="mb-3">
                    <input type="hidden" value="<?php echo $id ?>" id="alertId">
                    <label for="exampleFormControlTextarea1" class="form-label">Review</label>
                    <textarea class="form-control fred" rows="4" readonly><?php echo $review["review"]; ?></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        <?php
        } else {


        ?>
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Review</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div style="width: 100%; display: flex; flex-direction: column; align-items: center; align-content: center; justify-content: center; margin-top: 20px; margin-bottom: 20px;">
                    <div>
                        <img src="<?php echo $product_img["img_path"] ?>" style="width: 180px;" alt="">
                    </div>
                    <div class="ui massive star rating review" data-rating="0" data-max-rating="5" id="starsrate"></div>
                </div>
                <div class="mb-3">
                    <input type="hidden" value="<?php echo $id ?>" id="alertId">
                    <label for="exampleFormControlTextarea1" class="form-label">Review</label>
                    <textarea class="form-control fred" id="reviewText" rows="4" placeholder="How is your product?"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="postReview();">Post</button>
            </div>

<?php
        }
    }
}
?>