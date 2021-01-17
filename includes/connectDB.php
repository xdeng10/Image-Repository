<?php
$db_servername="localhost";
$db_username="root";
$db_password="";
$db_name="shopify2021_imagerepo";

$conn=mysqli_connect($db_servername,$db_username,$db_password,$db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
