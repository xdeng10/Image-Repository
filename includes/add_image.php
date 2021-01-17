<?php
include_once "connectDB.php";

$user_id = $_POST['userId'];

$image_name = $_POST['imagename'];
$image_price = $_POST['imageprice'];
$image_desc = $_POST['imageDesc'];
$image_inventory = $_POST['imageInventory'];
$image_visibility = $_POST['imageVisibility'];

//Add image
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}
if (isset($_FILES['imageFile'])) {
    $image_file = $_FILES["imageFile"];
} else {
    redirect("../error_message_user.php");
}

//Check if it's an actual image
$check = getimagesize($image_file["tmp_name"]);
if ($check == false) {
    redirect("../error_message_image.php");
}

//check size of image
if ($image_file["size"] > 500000) {
    redirect("../error_message_image.php");
}

//Only some image format are allowed
$imageFileType = strtolower(pathinfo(basename($image_file["name"]), PATHINFO_EXTENSION));
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    redirect("../error_message_image.php");
}

$imageNewName = "./assets/images/img-";
print_r($image_file);
$image_format = getimagesize($image_file["tmp_name"])[0] . " x " . getimagesize($image_file["tmp_name"])[1];
$image_size = ceil($image_file["size"] / 1000);

date_default_timezone_set('America/Montreal');
$created = date("Y/m/d h:i:s");


$sql = "INSERT INTO image_info (image_name, user_id, description, price, created, visibility, inventory, format, size) 
            VALUES('$image_name',$user_id ,'$image_desc', '$image_price', '$created', '$image_visibility', '$image_inventory', '$image_format', '$image_size');";
if (!mysqli_query($conn, $sql)) {
    redirect("../error_message_image.php?error=insertion");
}
$image_id = mysqli_insert_id($conn); //Retrieve id of product that was created


$imageNewName = $imageNewName . $image_id . "." . $imageFileType;


if (move_uploaded_file($image_file["tmp_name"], ("." . $imageNewName))) {
    $sql = "UPDATE image_info
    SET location='$imageNewName'
    WHERE image_id=$image_id;";
    if (!mysqli_query($conn, $sql)) {
        redirect("../error_message_image.php?error=update");
    }
} else {
    redirect("../error_message_image.php?error=insertImage");
}



//Go back to the page
header("Location: ../image_collection.php");
