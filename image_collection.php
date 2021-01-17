<?php
include_once "includes/connectDB.php";
$page_title = "Images";
$username = 'xdeng10';

//Find user id vased on username
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

$user_id;
$sql = "SELECT * FROM users WHERE username='$username';";
$result = mysqli_query($conn, $sql) or redirect("./error_message_user.php");
$resultCheck = mysqli_num_rows($result);
if ($resultCheck > 0) {
    $row = mysqli_fetch_assoc($result);
    $user_id = $row['user_id'];
} else {
    redirect("./error_message_user.php");
}

include("includes/header.php");
?>
<link rel="stylesheet" type="text/css" href="style.css" />

<main class="" id="main-collapse">
    <div class="row">
        <div class="col-xs-12 section-container-spacer">
            <h1><?php echo $username ?>'s Images</h1>
            <p>This is an overview of images in your collection.<br>
                You can click on your images to modify there information.<br>
                Click on the button below to add more images to your collection.
            </p>
            <button type="submit" class="btn btn-primary" style="outline:none" id="popup_button1">Add Images </button>
        </div>
        <div class="row" style="padding: 2em 2em 2em 2em;">
            <table class="product-table table-sortable">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th># sales</th>
                        <th>Inventory</th>
                        <th>Visibility</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    //Retrieve all products from the database
                    $image_name;
                    $image_price;
                    $total_sales;
                    $image_inventory;
                    $image_visibility;


                    $sql = "SELECT * FROM image_info where user_id=$user_id";
                    $result = mysqli_query($conn, $sql);
                    $resultCheck = mysqli_num_rows($result);

                    //Makes sure that the connection was established
                    if ($resultCheck > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $image_id = $row['image_id'];
                            $image_name = $row['image_name'];
                            $image_price = (float) $row['price'];
                            $total_sales = (float) $row['sales'];
                            $image_inventory = (float) $row['inventory'];
                            $image_location = $row['location'];
                            $image_visibility = $row['visibility'];


                            print("<tr> <td>$image_name</td>");
                            print("<td style='text-align: center'><a href='./image_info.php?imageid=$image_id'><img class='image-table' alt='' src=$image_location></a></td>");
                            print("<td>\$$image_price </td>");
                            print("<td>$total_sales</td>");
                            print("<td>$image_inventory </td>");
                            print("<td>$image_visibility </td></tr>");
                        }
                    } else {
                        redirect("./error_message_user.php");
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>


</main>



<!-- Popup window for creating new page -->
<div class="popup" id="popup-1">
    <div class="overlay"></div>
    <div class="content" id="popup_box">
        <div id="close-btn">&times;</div>
        <h1 style="padding-bottom: 1em;">Add a new image</h1>
        <form action="./includes/add_image.php" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="userId" value="<?php echo $user_id; ?>">
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Name: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imagename" id="imagename" placeholder="Image Name" >
                </div>
            </div>
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Price: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imageprice" id="imageprice" placeholder="Price" pattern="^[0-9]{1,}.[0-9]{2}$" title="Valid monetary values only. (E.g. 13.10)">
                </div>
            </div>

            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Description: </strong></p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <textarea class="form-control" rows="3" name="imageDesc" id="imageDesc" placeholder="Image Description" ></textarea>
                </div>
            </div>
            <div class="col-md-3">
                <p style="text-align: left; font-size: large"><strong>Inventory: </strong>
                </p>
            </div>
            <div class="col-md-9">
                <div class="form-group">
                    <input class="form-control" type="text" name="imageInventory" id="imageInventory" placeholder="Inventory" pattern="[0-9]{1,}" title="Integers Only" >
                </div>
            </div>

            <div class="col-md-12">
                <div class="form-group" style="text-align: left; font-size: large">
                    <label for="publicVisibility">Public:&nbsp;</label><input type="radio" name="imageVisibility" id="publicVisibility" value="public" checked>
                    <label for="privateVisibility">&nbsp;&nbsp; Private:&nbsp;</label><input type="radio" name="imageVisibility" id="privateVisibility" value="private"><br>
                    <input type="file" name="imageFile" id="imageFile" style="font-size: large;" required>
                </div>
            </div>
            <button type="submit" name="submit" id="popup_button"> Submit </button>
        </form>
    </div>

</div>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        navbarToggleSidebar();
        navActivePage();
    });
</script>

<script src="animation.js"></script>
<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script type="text/javascript" src="./main.85741bff.js"></script>
</body>

</html>