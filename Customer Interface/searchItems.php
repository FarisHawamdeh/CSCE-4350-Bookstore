<?php
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
    
} else {
    header("location:login.php");
}
?>
<ul>
    <li><a href="homescreen.php">Home</a></li>
</ul>
<?php

function parseGenre($currentGenre)
{
    $parsedGenre = "Travel";

    switch($currentGenre)
    {
        case 0:
            $parsedGenre = "Travel";
            break;
        case 1:
            $parsedGenre = "Mystery";
            break;
        case 2:
            $parsedGenre = "Humor";
            break;
        case 3:
            $parsedGenre = "Fiction";
            break;
        case 4:
            $parsedGenre = "Nonfiction";
            break;
        default:
            break;
    }

    return $parsedGenre;
}
function getItems() {
    if (isset($_POST['searched']) && isset($_POST['category'])) 
    {
        $searchedText = $_POST['searched'];
        $category = $_POST['category'];
        $host = "localhost"; // Host name 
        $username = "root"; // Mysql username 
        $password = ""; // Mysql password 
        $db = "bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query = "SELECT * FROM book WHERE $category LIKE '%{$searchedText}%'";

        $results = mysqli_query($con, $query);
        $num = mysqli_num_rows($results);

        if ($num > 0) {
            echo "<table bgcolor = #808080>";
            while ($row = mysqli_fetch_assoc($results)) {
                //get the books genre
                $genreQuery = "SELECT * from category WHERE bookid = " . $row['bookid'];
                $gResults = mysqli_query($con, $genreQuery);
                $genreRow = mysqli_fetch_assoc($gResults);
                $genre = $genreRow['genre'];
                $genre = parseGenre($genre);
                echo "<tr bgcolor = #FFFFFF>";
                echo "<td>";
                echo "<h1 align='left'>" . $row['title'] . "</h1> <h4 align='left'>" . "Published by: " . $row['publisher'] . " on " . $row['publicationdate'] . "</h4> <h4 align='left'>" . "ISBN:" . $row['isbn'] . "</h4>" 
                . "<h4 align='left'>" . "Genre: " . $genre . "</h4>";

                //print doc name, description, then text of the doc   
                echo "<form method = \"POST\" action = \"viewItem.php\">";
                echo "<input type=\"hidden\" name=\"bookid\" value='" . $row['bookid'] . "'>";
                echo "<input type=\"hidden\" name=\"title\" value='" . $row['title'] . "'>";
                echo "<input type=\"hidden\" name=\"publisher\" value='" . $row['publisher'] . "'>";
                echo "<input type=\"hidden\" name=\"publicationdate\" value='" . $row['publicationdate'] . "'>";
                echo "<input type=\"hidden\" name=\"isbn\" value='" . $row['isbn'] . "'>";

                $query2 = "SELECT * FROM bookformat WHERE bookid = " . $row['bookid'];
                $results2 = mysqli_query($con, $query2);

                $price = 0;

                echo '<select name="bookformat" id="bookformat" onchange="bookformatchange()">';
                while ($row2 = mysqli_fetch_assoc($results2)) {
                    if ($price == 0) {
                        $price = $row2['price'];
                    }
                    echo '<option value="' . $row2['price'] . ',' . $row2['format'] . '">' . $row2['format'] . '</option>';
                }
                echo '<select>';

                echo '  $';

                echo "<input type=\"text\" name=\"bookprice\" id=\"bookprice\" value='" . $price . "' readonly >";

                echo '<br>';
                echo "<input value =\"Add to Cart\" type=\"submit\">";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<hr>";
            echo "<h2 align='center'>No items found!</h2>";      //print out there are no items if none found
        }
    } 

    else if(!isset($_POST['searched']) && !isset($_POST['category']) && isset($_POST['genre']))
    {
        $wantedGenre = $_POST['genre'];
        $host = "localhost"; // Host name 
        $username = "root"; // Mysql username 
        $password = ""; // Mysql password 
        $db = "bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query = "SELECT * FROM book INNER JOIN category ON book.bookid=category.bookid AND category.genre = " . $wantedGenre;

        $results = mysqli_query($con, $query);
        $num = mysqli_num_rows($results);

        if ($num > 0) {
            echo "<table bgcolor = #808080>";
            while ($row = mysqli_fetch_assoc($results)) {
                //get the books genre
                $genreQuery = "SELECT * from category WHERE bookid = " . $row['bookid'];
                $gResults = mysqli_query($con, $genreQuery);
                $genreRow = mysqli_fetch_assoc($gResults);
                $genre = $genreRow['genre'];
                $genre = parseGenre($genre);
                echo "<tr bgcolor = #FFFFFF>";
                echo "<td>";
                echo "<h1 align='left'>" . $row['title'] . "</h1> <h4 align='left'>" . "Published by: " . $row['publisher'] . " on " . $row['publicationdate'] . "</h4> <h4 align='left'>" . "ISBN:" . $row['isbn'] . "</h4>" 
                . "<h4 align='left'>" . "Genre: " . $genre . "</h4>";

                //print doc name, description, then text of the doc   
                echo "<form method = \"POST\" action = \"viewItem.php\">";
                echo "<input type=\"hidden\" name=\"bookid\" value='" . $row['bookid'] . "'>";
                echo "<input type=\"hidden\" name=\"title\" value='" . $row['title'] . "'>";
                echo "<input type=\"hidden\" name=\"publisher\" value='" . $row['publisher'] . "'>";
                echo "<input type=\"hidden\" name=\"publicationdate\" value='" . $row['publicationdate'] . "'>";
                echo "<input type=\"hidden\" name=\"isbn\" value='" . $row['isbn'] . "'>";

                $query2 = "SELECT * FROM bookformat WHERE bookid = " . $row['bookid'];
                $results2 = mysqli_query($con, $query2);

                $price = 0;

                echo '<select name="bookformat" id="bookformat" onchange="bookformatchange()">';
                while ($row2 = mysqli_fetch_assoc($results2)) {
                    if ($price == 0) {
                        $price = $row2['price'];
                    }
                    echo '<option value="' . $row2['price'] . ',' . $row2['format'] . '">' . $row2['format'] . '</option>';
                }
                echo '<select>';

                echo '  $';

                echo "<input type=\"text\" name=\"bookprice\" id=\"bookprice\" value='" . $price . "' readonly >";

                echo '<br>';
                echo "<input value =\"Add to Cart\" type=\"submit\">";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "<hr>";
            echo "<h2 align='center'>No items found!</h2>";      //print out there are no items if none found
        }
    } 
    else 
    {
        header("location:homescreen.php");
    }
}

    getItems();     //get and print the items
?>

<script>
    function bookformatchange() {
        var str = document.getElementById('bookformat').value;
        var res = str.split(",");
        document.getElementById('bookprice').value = res[0];
    }
</script>