<?php
include_once "includes/connectDB.php";

//Find user id vased on username
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if (isset($_GET['username'])) {
    $username = $_GET['username'];
} else {
    redirect("./error_message_user.php?error='imageid");
}
$page_title = $username;

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

<main class="" id="main-collapse">


    <div class="row">
        <div class="col-xs-12 col-md-8">

            <div class="section-container-spacer">
                <h1><?php echo $username ?>'s Image Collection</h1>
                <p>Support your local artists!</p>
            </div>

            <div class="section-container-spacer">
            <div class="hero-full-wrapper">
            <div class="grid">
            <div class="gutter-sizer"></div>
            <div class="grid-sizer"></div>
                <?php
                //Retrieve all products from the database
                $image_name;
                $image_price;
                $total_sales;
                $image_inventory;
                $image_visibility;


                $sql = "SELECT * FROM image_info WHERE (visibility='public') AND (user_id=$user_id) ORDER BY sales DESC";
                $result = mysqli_query($conn, $sql);
                $resultCheck = mysqli_num_rows($result);

                //Makes sure that the connection was established
                if ($resultCheck > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $image_id = $row['image_id'];
                        $image_name = $row['image_name'];
                        $image_desc = $row['description'];
                        $image_location = $row['location'];

                        $str = <<<END
                    <div class="grid-item">
                    <img class="img-responsive" alt="" src="$image_location">
                    <a href="./project.php?imageid=$image_id" class="project-description">
                    <div class="project-text-holder">
                    <div class="project-text-inner">
                    <h3>$image_name</h3>
                    <p>$image_desc</p>
                    </div>
                    </div>
                    </a>
                    </div>
                    END;
                        print $str;
                    }
                } else {
                    redirect("./error_message_user.php");
                }
                ?>
            </div>
            </div>

            </div>
        </div>

    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function(event) {
            masonryBuild();
        });
    </script>

</main>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        navbarToggleSidebar();
        navActivePage();
    });
</script>

<script type="text/javascript" src="./main.85741bff.js"></script>
</body>

</html>