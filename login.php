<?php
session_start();
include_once "includes/connectDB.php";

$page_title = "Login";
include("includes/header.php");

//Find user id vased on username
function redirect($url, $statusCode = 303)
{
    header('Location: ' . $url, true, $statusCode);
    die();
}

if(!empty($_SESSION["username"]) && !empty($_SESSION["user_id"])){
    redirect("./image_collection.php", $statusCode = 303);
}

//Verify login information
$error_message = "";
$username;
$user_id;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST["username"]) && !empty($_POST["email"])) {

        $username = mysqli_real_escape_string($conn,$_POST['username']);
        $email = mysqli_real_escape_string($conn,$_POST['email']);


        $sql = "SELECT * FROM users WHERE username='$username';";
        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        
        //If username match with one in the database
        if ($resultCheck > 0) {
            $row = mysqli_fetch_assoc($result);
            $email_retrieved = $row['email'];

            if($email_retrieved == $email){
                $user_id = $row['user_id'];
                $_SESSION["username"]=$username;
                $_SESSION["user_id"]=$user_id;
                redirect("./image_collection.php?1", $statusCode = 303);
            }
        }else{
            $sql1 = "SELECT * FROM users WHERE email='$email';";
            $result1 = mysqli_query($conn, $sql1);
            $resultCheck1 = mysqli_num_rows($result1); 

            //If email matches with one in the database
            if ($resultCheck1 > 0) {
                $login = false;
            }else{
                //If username and email is not in the database, sign up the information
                $sql2 = "INSERT INTO users (username, email) 
                            VALUES('$username','$email');";
                if (!mysqli_query($conn, $sql2)) {
                    redirect("./error_message_user.php?error=insertion");
                }
                $user_id = mysqli_insert_id($conn); //Retrieve id of product that was created
                $_SESSION["username"]=$username;
                $_SESSION["user_id"]=$user_id;
                redirect("./image_collection.php?1", $statusCode = 303);
            } 
        } 
    }
    $error_message = "The username and/or the email does not match the information in our database.";
}

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