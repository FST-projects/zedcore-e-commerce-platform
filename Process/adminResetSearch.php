<?php

session_start();
include "connection.php";

if (isset($_SESSION["admin"])) {
    $permissionValidation = Database::search("SELECT * FROM `admin` INNER JOIN `admin_cat` ON `admin`.`admin_email`=`admin_cat`.`admin_email` WHERE `admin_id` = '" . $_SESSION["admin"]["admin_id"] . "' AND `cat_id` = '7'");
    if ($permissionValidation->num_rows  == 1) {




        $result = Database::search("SELECT * FROM `admin` WHERE `req_password` = '1' ");
        $result_num = $result->num_rows;

        if ($result_num != 0) {

?>


            <table>
                <thead>
                    <tr>

                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>request</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    for ($x = 0; $x < $result_num; $x++) {
                        $total_product_data = $result->fetch_assoc();


                    ?>


                        <tr id="admin<?php echo $total_product_data["admin_id"] ?>">

                            <td style="min-width: 290px;">
                                <?php
                                if (!empty($total_product_data['img'])) {
                                    $img = $total_product_data['img'];
                                } else {
                                    if ($total_product_data["gender_gender_id"] == 1) {
                                        $img = "profilepic/default/male.png";
                                    } else {
                                        $img = "profilepic/default/female.png";
                                    }
                                }
                                ?>
                                <div style="display: flex; align-items: center; align-content: center;  pointer-events: none;">
                                    <img src="<?php echo $img; ?>">
                                    <p style="margin-left: 10px;"><?php echo $total_product_data['fname'] ?> <?php echo $total_product_data['lname'] ?></p>
                                </div>
                            </td>
                            <td style="min-width: 180px; pointer-events: none;"><?php echo $total_product_data['admin_email'] ?></td>
                            <td style="min-width: 180px; pointer-events: none;"><?php echo $total_product_data['role'] ?></td>


                            <td>

                                <button id="adminreset<?php echo $total_product_data['admin_id'] ?>" class="ui teal button" style="width: 120px;" onclick="reqPasswordReset(<?php echo $total_product_data['admin_id'] ?>);">Confirm</button>

                            </td>
                        </tr>

                    <?php
                    }
                    ?>


                </tbody>
            </table>


        <?php
        } else {
        ?>
            <center>
                <div style="font-size: 16px;">
                    No Requests for password reset
                </div>
            </center>

<?php
        }
    } else {
        echo ("Access Denied");
    }
} else {
    echo ("Relogin to access");
}

?>