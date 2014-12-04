<?php

$host = "localhost"; // Host name 
$username = "root"; // Mysql username 
$password = ""; // Mysql password 
$db = "bookstore"; // Database name  

$con = mysqli_connect($host, $username, $password, $db);

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

echo "<div align = center>";
echo "<form method = \"POST\" action = \"\">";
echo"<table width = 30% bgcolor = grey >";

echo "<tr bgcolor = white><td><font color = black size = '4'>Title: </font>";
echo "<input name=\"title\" type=\"text\" value= \" \" size=\"20\" maxlength=\"45\" /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Publisher: </font>";
echo "<input name=\"publisher\" type=\"text\" value= \" \" size=\"20\" maxlength=\"45\" /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Publisher Date: </font>";
echo "<input name=\"publicationdate\" type=\"date\" value= \"\" size=\"20\" /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>ISBN :</font>";
echo "<input name=\"isbn\" type=\"text\" value= \"\" size=\"20\" maxlength=\"17\"  /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Author: </font>";
echo "<input name=\"author\" type=\"text\" value= \"\" size=\"20\" maxlength=\"45\"  /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Book Format: </font>";
echo "<input name=\"format\" type=\"text\" value= \"\" size=\"20\" maxlength=\"20\" /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Price: </font>";
echo "<input name=\"price\" type=\"text\" value= \"\" size=\"20\" maxlength=\"5\" /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Genre: </font>";
echo "<input name=\"genre\" type=\"text\" value= \"\" size=\"20\" maxlength=\"1\" /></td></tr>";

echo "<tr bgcolor = white><td><input name = \"submitInfo\" value =\"Submit New Book Item\" type=\"submit\"></td></tr></div>";
echo "</table>";
echo "</div>";
echo "</form>";

if (isset($_POST['submitInfo']))
{
    $title = $_POST['title'];
    $publisher = $_POST['publisher'];
    $publicationdate = $_POST['publicationdate'];
    $isbn = $_POST['isbn'];
    $author = $_POST['author'];
    //$format = $_POST['format'];
    //$price = $_POST['price'];
    //$genre = $_POST['genre'];
    //insert new book into database
    $query = "INSERT INTO book (title, publisher, publicationdate, isbn, isdeleted)VALUES('" . $title . "','" . $publisher . "','" . $publicationdate . "', '" . $isbn . "', '0')";
    mysqli_query($con, $query); //returns FALSE if query fails
    //return bookid
    $bookidquery = "SELECT bookid\n"
    . "FROM `book` \n"
    . "WHERE title = '$title' AND publisher = '$publisher' AND publicationdate = '$publicationdate' AND isbn = '$isbn'";

    $bookresult = mysqli_query($con, $bookidquery);
    $bookidRow = mysqli_fetch_assoc($bookresult);
    $bookid = $bookidRow['bookid'];
    $bookid = parseGenre($bookid);
    $query2 = "INSERT INTO author (bookid, author)VALUES('" . $bookid . "','" . $author . "')";
    header("Location: sellerscreen.php");
}
    

?>