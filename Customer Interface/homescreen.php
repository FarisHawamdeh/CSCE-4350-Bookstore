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

        <form method="post" action="logout.php">
            <input type="submit" value="Logout">
        </form>

        <br>

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

        <br><br>

        <form id="genreButton"  method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='0'>
            <input type="submit" value="Travel">
        </form>

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='1'>
            <input type="submit" value="Mystery">
        </form>

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='2'>
            <input type="submit" value="Humor">
        </form>

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='3'>
            <input type="submit" value="Fiction">
        </form>

        <form id="genreButton" method="post" action="searchItems.php">
            <input type="hidden" name="genre" value='4'>
            <input type="submit" value="Nonfiction">
        </form>

        <br><br><br>

        <form method="post" action="searchItemToComment.php">
            Enter a book title EXACTLY to comment on:<br>
            <input type="text" name="wanted">
            <br>
            <input type="submit" value="Search">
        </form>  

    </body>
</html>
