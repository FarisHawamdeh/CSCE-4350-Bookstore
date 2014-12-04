<?php

$host = "localhost"; // Host name 
$username = "root"; // Mysql username 
$password = ""; // Mysql password 
$db = "bookstore"; // Database name  

$con = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Delete Admin Account usint adminid
$adminid = $_POST['adminid'];

$sql = "DELETE FROM admin WHERE adminid='$adminid'";
$result = mysqli_query($con, $sql);

header("location:viewAdmins.php");
?>