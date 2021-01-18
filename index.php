<?php
session_start();
include_once "includes/connectDB.php";

//Redirect user to another webpage
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

//If the user is redirected from the sign ou link, reset session.
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if($status == 'signout'){
        session_unset();
        session_destroy();
        redirect("./index.php");
    }
} else {
}

$page_title = "Discovery";
include("includes/header.php");
?>

<!-- Add your site or app content here -->
<main class="" id="main-collapse">
    <div class="hero-full-wrapper">
        <div class="grid">
            <div class="gutter-sizer"></div>
            <div class="grid-sizer"></div>

            <?php
            $image_name;
            $image_price;
            $total_sales;
            $image_inventory;
            $image_visibility;

            //Retrieve all "public" images
            $sql = "SELECT * FROM image_info WHERE visibility='public' ORDER BY sales DESC" ;
            $result = mysqli_query($conn, $sql) or redirect("./error_message_user.php?error=connectdb");
            $resultCheck = mysqli_num_rows($result);

            //Makes sure that the connection was established
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $image_id = $row['image_id'];
                    $image_name = $row['image_name'];
                    $image_desc = $row['description'];
                    $image_location = $row['location'];

                    $str = <<<END
                    <div class="grid-item" style="white-space: pre-line">
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