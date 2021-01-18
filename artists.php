<?php
session_start();

include_once "includes/connectDB.php";

$page_title = "Artists";
include("includes/header.php");
?>

<main class="" id="main-collapse">


    <div class="row">
        <div class="col-xs-12 section-container-spacer">
            <h1>Artists</h1>
            <p>Discover some great artists! <br>
                Here is the list of all our top artists and their top seller image!</p>
        </div>

        <?php

            //Retrieve the information of all artists in the database
            $sql = "SELECT * FROM users;";
            $result = mysqli_query($conn, $sql) or redirect("./error_message_user.php?error=connectdb");
            $resultCheck = mysqli_num_rows($result);

            //Makes sure that the connection was established
            if ($resultCheck > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $username = $row['username'];
                    $user_id = $row['user_id'];

                    $sql1 = "SELECT * FROM image_info WHERE (user_id=$user_id) AND (visibility='public') ORDER BY sales DESC limit 1";
                    $result1 = mysqli_query($conn, $sql1) or redirect("./error_message_user.php?error=connectdb");
                    $resultCheck1 = mysqli_num_rows($result1);

                    if($resultCheck1 > 0){
                        $row1 = mysqli_fetch_assoc($result1);
                        $image_location = $row1['location'];

                        $str = <<<END
                        <div class="col-xs-12 col-md-4 section-container-spacer">
                        <img class="img-responsive" alt="" src="$image_location">
                        <h2>$username</h2>
                        <p></p>
                        <a href="./artist_profile.php?username=$username" class="btn btn-primary" title="">Visit</a>
                        </div>
                        END;
                        print $str;
                    }
                }
            } else {
                redirect("./error_message_user.php?error=connectDB");
            }
            ?>
    </div>

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