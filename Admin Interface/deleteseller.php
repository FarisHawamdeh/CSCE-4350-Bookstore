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
$sellerid = $_POST['sellerid'];

$sql = "UPDATE seller SET isdeleted='1' WHERE sellerid='$sellerid'";
mysqli_query($con, $sql);

$sql = "SELECT bookid FROM selleritem WHERE sellerid='$sellerid'";
$result = mysqli_query($con, $sql);

while ($row = mysqli_fetch_assoc($result)) {
	$query = "UPDATE book SET isdeleted='1' WHERE bookid='" . $row['bookid'] . "'";
	mysqli_query($con, $query);
}

header("location:viewSellers.php");
?>