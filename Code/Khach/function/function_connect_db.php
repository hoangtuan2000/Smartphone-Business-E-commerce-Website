<?php

$host = "localhost";
$user = "root";
$password = "";
$database = "htshop";
$con = mysqli_connect($host, $user, $password, $database);
if (mysqli_connect_errno()) {
    echo "Connection Fail: " . mysqli_connect_errno();
    exit;
}