<!DOCTYPE html>
<html>
    <head>
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

        <a href="viewItem.php">Cart (<?php echo count($_SESSION['cart']); ?>)</a>

        <form method="post" id="searchForm" action="searchItems.php">
            Enter your search:<br>
            <input type="text" name="searched">
            <br><br>
            <input type="submit" value="Search">
            <select name="category" form="searchForm">
                <option value="title">Title</option>
                <option value="publisher">Publisher</option>
                <option value="isbn">ISBN</option>
            </select>
        </form>  

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='0'>
            <br><br>
            <input type="submit" value="Travel">

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='1'>
            <input type="submit" value="Mystery">

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='2'>
            <input type="submit" value="Humor">

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='3'>
            <input type="submit" value="Fiction">

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='4'>
            <input type="submit" value="Nonfiction">
    </body>
</html>
