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
    if (isset($_POST['wanted']))
    {
        $searchedText = $_POST['wanted'];
        $host = "localhost"; // Host name 
        $username = "root"; // Mysql username 
        $password = ""; // Mysql password 
        $db = "bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query = "SELECT * FROM book WHERE title LIKE '%{$searchedText}%'";

        $results = mysqli_query($con, $query);
        $num = mysqli_num_rows($results);

        if ($num > 0) 
        {
            $row = mysqli_fetch_assoc($results);
            //get the books genre
            $genreQuery = "SELECT * from category WHERE bookid = " . $row['bookid'];
            $gResults = mysqli_query($con, $genreQuery);
            $genreRow = mysqli_fetch_assoc($gResults);
            $genre = $genreRow['genre'];
            $genre = parseGenre($genre);

            echo "<h1 align='left'>" . $row['title'] . "</h1> <h4 align='left'>" . "Published by: " . $row['publisher'] . " on " . $row['publicationdate'] . "</h4> <h4 align='left'>" . "ISBN:" . $row['isbn'] . "</h4>" 
            . "<h4 align='left'>" . "Genre: " . $genre . "</h4>";

            echo "<br>";

            echo "<form action='saveComment.php' method='post'>";
            echo "<input type=\"hidden\" name=\"bookid\" value='" . $row['bookid'] . "'>";
            echo "<textarea rows=\"10\" cols=\"50\" name = 'text'>Write comment here</textarea>";
            echo "<input type='submit' value='Comment'>";
            echo "</form>";
        }
             
        else
        {
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
