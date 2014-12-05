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

    <h2>Thank you for being a valued seller!</h2>


        <!-- Shows current items, button to view comments, button to update, button to remove item-->
        <h3>Your Current Items</h3>
        <?php
function checkCurrentItems()
{
    $sellername=$_SESSION['username'] ;
    $host = "localhost"; // Host name 
    $username = "root"; // Mysql username 
    $password = ""; // Mysql password 
    $db = "bookstore"; // Database name  

    $con = mysqli_connect($host, $username, $password, $db);

    if (mysqli_connect_errno()) {
       echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }

    //Query to get books with matching id (will make username be email)
    $query = "SELECT *\n"
    . "FROM\n"
    . "\n"
    . "(SELECT *\n"
    . "FROM book \n"
    . "WHERE isdeleted = 0)AS b\n"
    . "\n"
    . "INNER JOIN\n"
    . "\n"
    . "(SELECT\n"
    . "seller.emailaddress,\n"
    . "seller.sellerid, \n"
    . "selleritem.bookid\n"
    . "FROM seller \n"
    . "LEFT JOIN selleritem \n"
    . "ON seller.sellerid = selleritem.sellerid\n"
    . "WHERE seller.emailaddress= '$_SESSION[username]') As s\n"
    . "\n"
    . "ON b.bookid = s.bookid";

    $results = mysqli_query($con, $query);
    $num = mysqli_num_rows($results);

    //Create table
    if ($num > 0) {
            echo "<table bgcolor = #808080>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo "<tr bgcolor = #FFFFFF>";
                echo "<td>";
                echo "<h1 align='left'>" . $row['title'] . "</h1> <h4 align='left'>" . "Published by: " . $row['publisher'] . " on " . $row['publicationdate'] . "</h4> <h4 align='left'>" . "ISBN:" . $row['isbn'] . "</h4>";

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
        /////////////////DELETE FUNCTIONALITY
                
                echo '<br>';
                echo "<form method = \"POST\" action = \"deleteItem.php\">";
                echo "<input type=\"hidden\" name=\"deletebookid\" value='" . $row['bookid'] . "'>";
                echo "<input value =\"Delete Item\" type=\"submit\">";
                echo "</form>";


        /////////////READ COMMENTS
                echo "<form method = \"POST\" action = \"readComments.php\">";
                echo "<input value =\"Read Comments\" type=\"submit\">";
                echo "</form>";


        /////////////VIEW ORDERS
                echo "<form method = \"POST\" action = \"viewOrders.php\">";
                echo "<input value =\"View Orders\" type=\"submit\">";
                echo "</form>";

                echo "</td>";
                echo "</tr>";

    }
    echo "</table>";
    
    }
    else {
        echo "<hr>";
        echo "<h2 align='center'>No items found!</h2>";      //print out there are no items if none found
        }
}
    checkCurrentItems();
?>
        <!-- Add items-->
        <form action="addItem.php">
        <input type="submit" value="Add New Item">
        </form>
        <!--Logout of system-->
        <br>
        <form action="logout.php">
            <input type="submit" value="Logout">
        </form>
    </body>
</html>
