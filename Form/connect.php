<?php
$servername = "localhost";
$username = "Utsav";
$password = "";
$db = "logindata";

$conn = mysqli_connect($servername, $username, $password, $db);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
