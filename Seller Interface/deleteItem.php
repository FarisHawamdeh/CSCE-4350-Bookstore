<!DOCTYPE html>
<html>
    <head>
        <title>Seller Interface</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    
} else {
    header("location:login.php");
}
?>

<?php
function deleteItem(){
$host = "localhost"; // Host name 
    $username = "root"; // Mysql username 
    $password = ""; // Mysql password 
    $db = "bookstore"; // Database name  

$con = mysqli_connect($host, $username, $password, $db);
$query = "UPDATE book SET isdeleted = 1 WHERE bookid = '" . $_POST['deletebookid']. "'";
mysqli_query($con, $query);
echo "" . $_POST['deletebookid']. "";
header("location:sellerscreen.php");
}

deleteItem();
?>


    </body>
</html>
