<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    
} else {
    header("location:login.php");
}
?>

<ul>
    <li><a href="sellerscreen.php">Back</a></li>
</ul>

