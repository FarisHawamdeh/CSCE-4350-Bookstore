<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        
    }

    else
    {
        header("location:login.php");
    }

    if(isset($_POST['title']) && isset($_POST['publisher']) && isset($_POST['publicationdate']) && isset($_POST['isbn']))
    {
    	//display item information.... have to add to cart
    	echo "<h1 align='left'>" . $_POST['title'] . "</h1> <h4 align='left'>" . "Published by: " . $_POST['publisher'] . " on " . $_POST['publicationdate'] . "</h4> <h4 align='left'>" . "ISBN:" . $_POST['isbn'] . "</h4>";
    }

    else
    {
    	header("location:homescreen.php");
    }
?>