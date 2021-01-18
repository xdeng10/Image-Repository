<?php
session_start();
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
$username;


$sql = "SELECT * FROM image_info where image_id=$image_id;";
$result = mysqli_query($conn, $sql) or redirect("./error_message_user.php?error=connectdb");
$resultCheck = mysqli_num_rows($result);

//Makes sure that the connection was established
if ($resultCheck > 0) {
    $row = mysqli_fetch_assoc($result);
    $image_name = $row['image_name'];
    $image_price = $row['price'];
    $image_discount = $row['discount'];
    $image_desc = $row['description'];
    $image_format = $row['format'];
    $image_size = $row['size'];
    $image_location = $row['location'];
    $user_id = $row['user_id'];

    $sql1 = "SELECT * FROM users where user_id=$user_id;";
    $result1 = mysqli_query($conn, $sql1) or redirect("./error_message_user.php?error=connectdb");
    $resultCheck1 = mysqli_num_rows($result1);

    //Makes sure that the connection was established
    if ($resultCheck1 > 0) {
        $row1 = mysqli_fetch_assoc($result1);
        $username = $row1['username'];
    } else {
        redirect("./error_message_user.php?error=readdb");
    }
} else {
    redirect("./error_message_user.php?error=readdb");
}





$page_title = $image_name;
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

            <?php
                if ($image_discount != null) {
                    $str = <<<END
                    <del><strong>Original Price: </strong> \$$image_price<br></del>
                    <span style="color:red"><strong>Discounted Price: </strong>\$$image_discount</span>
                    END;
                    print $str;
                } else {
                    echo "<strong>Price: </strong> \$$image_price";
                }
            ?>
            </p>
            <p style='font-size: large; white-space: pre-line'><strong>Description:</strong> <?php echo $image_desc ?></p>
            <p style='font-size: large'>
                <strong>Format:</strong> <?php echo $image_format ?><br>
                <strong>Size:</strong> <?php echo $image_size ?><br>
            </p>
            <p style='font-size: large'>
                <strong>Artist: </strong><?php echo "<a href='./artist_profile.php?username=$username'>$username</a>" ?><br>
            </p>
            <br>
            <button type="submit" class="btn btn-primary" style="outline:none" disabled>Purchase</button>
        </div>
    </div>

</main>

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