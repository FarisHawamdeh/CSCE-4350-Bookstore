<?php

$host = "localhost"; // Host name 
$username = "root"; // Mysql username 
$password = ""; // Mysql password 
$db = "bookstore"; // Database name  

$con = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// username and password sent from form 
$myusername = $_POST['myusername'];
$mypassword = $_POST['mypassword'];

$myusername = stripslashes($myusername);
$mypassword = stripslashes($mypassword);
$myusername = mysql_real_escape_string($myusername);
$mypassword = mysql_real_escape_string($mypassword);
$sql = "SELECT * FROM seller WHERE emailaddress='$myusername' and password='$mypassword'";
$result = mysqli_query($con, $sql);

$count = mysqli_num_rows($result);

if ($count == 1) {
    // Register $myusername, $mypassword and redirect to file "login_success.php"
    session_start();
    $_SESSION['username'] = $myusername;
    $_SESSION['password'] = $mypassword;
    header("location:sellerscreen.php");
} else {
    echo "Wrong Username or Password";
}
?>