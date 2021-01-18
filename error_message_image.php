<?php
session_start();

$page_title = "Error";
include("includes/header.php");
?>

<main class="" id="main-collapse">
    <h1>Error when uploading the image. </h1>
    <p>The file you uploaded is not a valid image format or it is too big. <br>
        Please upload an valid image (JPG, JPEG, PNG, or GIF) that is less than 500kb in size.
    </p>
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