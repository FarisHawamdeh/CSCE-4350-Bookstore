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
//Book format
echo "<tr bgcolor = white><td><font color = black size = '4'>Book Format and Price: </font>";
echo "<br>";
echo "<input name=\"hardbackbutton\" type=\"radio\" value= \"Hardback\"/>Hardback<input name=\"HBprice\" type=\"text\" value= \"\" size=\"5\" maxlength=\"5\" />";
echo "<br>";
echo "<input name=\"paperbackbutton\" type=\"radio\" value= \"Paperback\"/>Paperback<input name=\"PBprice\" type=\"text\" value= \"\" size=\"5\" maxlength=\"5\" /></td></tr>";

echo "<tr bgcolor = white><td><font color = black size = '4'>Genre: </font><br>";
echo "<input name=\"genre\" type=\"radio\" value= \"0\" />Travel<br>";
echo "<input name=\"genre\" type=\"radio\" value= \"1\" />Mystery<br>";
echo "<input name=\"genre\" type=\"radio\" value= \"2\" />Humor<br>";
echo "<input name=\"genre\" type=\"radio\" value= \"3\" />Fiction<br>";
echo "<input name=\"genre\" type=\"radio\" value= \"4\" />Nonfiction</td></tr>";

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
    $hardbackbutton = $_POST['hardbackbutton'];
    $paperbackbutton = $_POST['paperbackbutton'];
    $HBprice = $_POST['HBprice'];
    $PBprice = $_POST['PBprice'];
    $genre = $_POST['genre'];

    //insert new book into database
    $query = "INSERT INTO book (title, publisher, publicationdate, isbn, isdeleted)VALUES('" . $title . "','" . $publisher . "','" . $publicationdate . "', '" . $isbn . "', '0')";
    mysqli_query($con, $query); //returns FALSE if query fails

    //return bookid
    $bookidquery = "SELECT bookid FROM book WHERE title =  '" . $title . "' AND publisher ='" . $publisher . "' AND publicationdate = '" . $publicationdate . "' AND isbn = '" . $isbn . "'";
    $bookresult = mysqli_query($con, $bookidquery);
    $bookidRow = mysqli_fetch_assoc($bookresult);
    $bookid = $bookidRow['bookid'];
    
    //Insert author
    $query2 = "INSERT INTO author (bookid, author)VALUES('" . $bookid . "','" . $author . "')";
    mysqli_query($con, $query2);

    //format & price --BROKEN DOES NOT WORK AS INTENDED--
    if (isset($_POST['hardbackbutton'])) {
    $query3 = "INSERT INTO bookformat (bookid, format, price)VALUES('" . $bookid . "','Hardcover'," . $HBprice . "')";
    mysqli_query($con, $query3);
    }
    if (isset($_POST['paperbackbutton'])) {
    $query4 = "INSERT INTO bookformat (bookid, format, price)VALUES('" . $bookid . "','Paperback'," . $PBprice . "')";
    mysqli_query($con, $query4);
    }

    //Genre
    $query5 = "INSERT INTO category (bookid, genre)VALUES('" . $bookid . "','" . $genre . "')";
    mysqli_query($con, $query5);

    //SellerItem
    //return sellerid --BROKEN DOES NOT WORK AS INTENDED--
    $selleridquery = "SELECT sellerid FROM seller WHERE emailaddress = '" . $_SESSION['username'] . "'";
    $sellerresult = mysqli_query($con, $selleridquery);
    $selleridRow = mysqli_fetch_assoc($sellerresult);
    $sellerid = $selleridRow['sellerid'];

    $query6 = "INSERT INTO selleritem (sellerid, bookid)VALUES('" . $sellerid . "','" . $bookid . "')";
    mysqli_query($con, $query6);
    header("Location: sellerscreen.php");
}
    

?>