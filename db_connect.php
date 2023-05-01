<?php
/* Database connection start */
$servername = "anysql.itcollege.ee";
$username = "ICS0008_WT_19";
$password = "9913c37187f6";
$dbname = "ICS0008_19";
$conn = mysqli_connect($servername, $username, $password, $dbname) or die("Connection failed: " . mysqli_connect_error());
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}
?>