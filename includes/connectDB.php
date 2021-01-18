<?php
//Local connection
/*
$db_servername="localhost";
$db_username="root";
$db_password="";
$db_name="shopify2021_imagerepo";
*/
$db_servername="lfmerukkeiac5y5w.cbetxkdyhwsb.us-east-1.rds.amazonaws.com";
$db_username="c8dc8h2u94iz4o29";
$db_password="gq48kizwlxljqfmf";
$db_name="uymlztae5kse83h8";

$conn=mysqli_connect($db_servername,$db_username,$db_password,$db_name);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
