<?php

date_default_timezone_set('Asia/Kolkata');

$hostname = "localhost";
$username = "root";
$password = '';
$database = "commuteguard";

$conn = mysqli_connect($hostname, $username, $password, $database);

if (!$conn) {
    die("Database Connection Failed: " . mysqli_connect_error());
}
