<?php
/* Database connection start */
$servername = "your_servername";
$username = "your_username";
$password = "your_password";
$dbname = "ICS0008_19";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>