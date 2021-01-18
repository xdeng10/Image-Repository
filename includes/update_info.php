<?php
include_once "connectDB.php";

//Redirect user to another webpage
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

$image_id = $_POST['imageId'];
$image_name = $_POST['imagename'];
$image_price = $_POST['imageprice'];
$image_discount = $_POST['imageDiscount'];
if (!is_numeric($image_discount)) {
    $image_discount = 'NULL';
}
$image_desc = $_POST['imageDesc'];
$image_inventory = $_POST['imageInventory'];
$image_visibility = $_POST['imageVisibility'];

$sql = "UPDATE image_info
            SET image_name='$image_name', price=$image_price, discount=$image_discount, description='$image_desc', inventory='$image_inventory', visibility='$image_visibility'
            WHERE image_id=$image_id;";
if (!mysqli_query($conn, $sql)) {
    redirect("./error_message_user.php?error=connectdb");
}

//Go back to the page
header("Location: ../image_info.php?imageid=$image_id");
