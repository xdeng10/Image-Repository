<?php
include_once "includes/connectDB.php";

$page_title = "Login";
include("includes/header.php");

//Find user id vased on username
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

//Verify login information
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["email"])) {

    $sql = "SELECT * FROM users;";
    $result = mysqli_query($conn, $sql);
    $resultCheck = mysqli_num_rows($result);        


        redirect("./image_collection.php", $statusCode = 303);
    } else {
        $error_message = "The username and/or the email does not match the information in our database.";
    }
}

/*
$sql = "SELECT * FROM users;";
$result = mysqli_query($conn, $sql);
$resultCheck = mysqli_num_rows($result);

//Makes sure that the connection was established
if ($resultCheck > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $username = $row['username'];
        $user_id = $row['user_id'];

        $sql1 = "SELECT * FROM image_info WHERE user_id=$user_id ORDER BY sales DESC limit 1";
        $result1 = mysqli_query($conn, $sql1);
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
    redirect("./error_message_user.php");
}
*/

?>

<main class="" id="main-collapse">
    <div class="row">
        <div class="col-xs-12">
            <div class="section-container-spacer">
                <h1>Login</h1>
                <br>
                Please enter your credentials. <br><br>
                To sign up, enter an username and an email. If the username and/or the email is already taken, an error message will be sent.
                <br><br>
                <p style="color: red"><?php echo $error_message ?></p>
                <br>
                <form action="" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input class="form-control" type="text" name="username" id="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input class="form-control" type="email" name="email" id="email" placeholder="E-mail">
                        </div>

                        <button type="submit" class="btn btn-primary btn-lg">Sign-in / Sign-up</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</main>

<script>
    document.addEventListener("DOMContentLoaded", function(event) {
        navbarToggleSidebar();
        navActivePage();
    });
</script>

<script src="https://unpkg.com/ionicons@5.2.3/dist/ionicons.js"></script>
<script type="text/javascript" src="./main.85741bff.js"></script>
</body>

</html>