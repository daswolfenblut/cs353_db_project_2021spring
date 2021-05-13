<?php

$dbServername = "127.0.0.1";
$dbUsername = "root";
$dbPassword = "";
$dbName = "database_project";

$db = mysqli_connect($dbServername, $dbUsername, $dbPassword, $dbName);

if (!$db) {
    die("error. " . mysqli_connect_error());
}
echo "Connected successfully.";
?>