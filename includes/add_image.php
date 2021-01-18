<?php
include_once "connectDB.php";

//Redirect user to another webpage
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

//POST variables sent from image_collection.php
$user_id = $_POST['userId'];
$image_name = $_POST['imagename'];
$image_price = $_POST['imageprice'];
$image_desc = $_POST['imageDesc'];
$image_inventory = $_POST['imageInventory'];
$image_visibility = $_POST['imageVisibility'];

/* Read the image file and make sure they can be uploaded */
if (isset($_FILES['imageFile'])) {
    $image_file = $_FILES["imageFile"];
} else {
    redirect("../error_message_user.php?error=noimage");
}

//Check if it's an actual image
$check = getimagesize($image_file["tmp_name"]);
if ($check == false) {
    redirect("../error_message_image.php?error=not_an_image");
}

//Check size of image, only accepts image less than 500kb.
if ($image_file["size"] > 500000) {
    redirect("../error_message_image.php?error=image_too_big");
}

//Only some image format are allowed: jpg, png, jpeg
$imageFileType = strtolower(pathinfo(basename($image_file["name"]), PATHINFO_EXTENSION));
if (
    $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif"
) {
    redirect("../error_message_image.php?error=wrong_image_format");
}

//Read the format and size of the image.
$image_format = getimagesize($image_file["tmp_name"])[0] . " x " . getimagesize($image_file["tmp_name"])[1];
$image_size = ceil($image_file["size"] / 1000);

date_default_timezone_set('America/Montreal');
$created = date("Y/m/d h:i:s");

//Add to SQL database
$sql = "INSERT INTO image_info (image_name, user_id, description, price, created, visibility, inventory, format, size) 
            VALUES('$image_name',$user_id ,'$image_desc', '$image_price', '$created', '$image_visibility', '$image_inventory', '$image_format', '$image_size');";
if (!mysqli_query($conn, $sql)) {
    redirect("../error_message_image.php?error=insertion");
}
$image_id = mysqli_insert_id($conn); //Retrieve id of image that was just created


//Move the uploaded image to the right repository
$imageNewName = "./assets/images/img-" . $image_id . "." . $imageFileType;
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
