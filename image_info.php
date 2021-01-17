<?php
include_once "includes/connectDB.php";

function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if (isset($_GET['imageid'])) {
    $image_id = $_GET['imageid'];
} else {
    redirect("./error_message_user.php?error='imageid");
}

//Retrieve all products from the database
$image_name;
$image_price;
$image_price_discount;
$image_desc;
$image_num_sold;
$image_inventory;
$image_format;
$image_size;
$image_visibility;


$sql = "SELECT * FROM image_info where image_id=$image_id;";
$result = mysqli_query($conn, $sql) or redirect("./error_message_user.php?error=connectdb");
$resultCheck = mysqli_num_rows($result);

//Makes sure that the connection was established
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $image_name = $row['image_name'];
        $image_price = $row['price'];
        $image_discount = $row['discount'];
        $total_sales = $row['sales'];
        $image_desc = $row['description'];
        $image_inventory = $row['inventory'];
        $image_format = $row['format'];
        $image_size = $row['size'];
        $image_location = $row['location'];
        $image_visibility = $row['visibility'];
    }
} else {
    redirect("./error_message_user.php?error=readdb");
}



$page_title = $image_name;
$username = "xdeng10";
include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="style.css" />

<main class="" id="main-collapse">
    <div class="row">
        <div class="col-xs-12 col-md-6">
            <img class="img-responsive" alt="Image" src="<?php echo $image_location ?>">
        </div>
        <div class="col-xs-12 col-md-6">
            <h1><?php echo $image_name ?></h1>

            <p style='font-size: large'>
                <strong>Original Price:</strong> $<?php echo $image_price ?><br>
                <strong>Discounted Price:</strong>
                <?php
                if ($image_discount != null) {
                    echo "$" . $image_discount;
                } else {
                    echo "NONE";
                }
                ?>
            </p>
            <p style='font-size: large'><strong>Description:</strong> <?php echo $image_desc ?></p>
            <p style='font-size: large'>
                <strong>Sales:</strong> <?php echo $total_sales ?><br>
                <strong>Inventory:</strong> <?php echo $image_inventory ?>
            </p>
            <p style='font-size: large'>
                <strong>Format:</strong> <?php echo $image_format ?><br>
                <strong>Size:</strong> <?php echo $image_size ?><br>
                <strong>Visibility:</strong> <?php echo $image_visibility ?>
            </p>
            <br>
            <button type="submit" class="btn btn-primary" style="outline:none" id="popup_button1">Edit Image Info</button>
        </div>
    </div>

</main>

<!-- Popup window for creating new page -->
<div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="content" id="popup_box">
        <div id="close-btn">&times;</div>
        <h1 style="padding-bottom: 1em;">Edit Image Information</h1>
        <form action="includes/update_info.php" method="POST">
            <input type="hidden" name="imageId" value="<?php echo $image_id; ?>">
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Name: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imagename" id="imagename" value="<?php echo $image_name ?>" required>
                </div>
            </div>
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Price: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imageprice" id="imageprice" value="<?php echo $image_price ?>" required>
                </div>
            </div>
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Discount: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imageDiscount" id="imageDiscount" value="<?php
                                                                                                            if ($image_discount != null) {
                                                                                                                echo $image_discount;
                                                                                                            } else {
                                                                                                                echo "NONE";
                                                                                                            }
                                                                                                            ?>">
                </div>
            </div>

            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Description: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="imageDesc" id="imageDesc" required><?php echo $image_desc ?></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Inventory: </strong>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imageInventory" id="imageInventory" value="<?php echo $image_inventory ?>" required>
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group" style="text-align: left; font-size: large">
                    <?php
                    if ($image_visibility == 'public') {
                        $public = "checked";
                        $private = "";
                    } else {
                        $private = "checked";
                        $public = "";
                    }
                    ?>
                    <label for="publicVisibility">Public:&nbsp;</label><input type="radio" name="imageVisibility" id="publicVisibility" value="public" <?php echo $public ?>>
                    <label for="privateVisibility">&nbsp;&nbsp; Private:&nbsp;</label><input type="radio" name="imageVisibility" id="privateVisibility" value="private" <?php echo $private ?>>
                </div>
            </div>
            <button type="submit" name="submit" id="popup_button"> Submit </button>
    </div>
    </form>
</div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        navbarToggleSidebar();
        navActivePage();
    });
</script>
<script src="animation.js "></script>
<script type="text/javascript" src="./main.85741bff.js"></script>
</body>

</html>