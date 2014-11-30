<?php
    session_start();
    if(isset($_SESSION['username']) && isset($_SESSION['password']))
    {
        
    }

    else
    {
        header("location:login.php");
    }

    function getItems()
    {
      if(isset($_POST['searched']) && isset($_POST['category']))
      {
        $searchedText = $_POST['searched'];
        $category = $_POST['category'];
        $host="localhost"; // Host name 
        $username="root"; // Mysql username 
        $password=""; // Mysql password 
        $db="bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);
          
        if (mysqli_connect_errno()) 
        {
           echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $query = "SELECT * FROM book WHERE $category LIKE '%{$searchedText}%'";

        $results = mysqli_query($con, $query);
        $num = mysqli_num_rows($results);

        if ($num > 0)
        {
            echo "<table bgcolor = #808080>";
            while ($row = mysqli_fetch_assoc($results))
            {
                echo "<tr bgcolor = #FFFFFF>";
                echo "<td>";
                echo "<h1 align='left'>" . $row['title'] . "</h1> <h4 align='left'>" . "Published by: " . $row['publisher'] . " on " . $row['publicationdate'] . "</h4> <h4 align='left'>" . "ISBN:" . $row['isbn'] . "</h4>";


                //print doc name, description, then text of the doc   
                echo "<form method = \"POST\" action = \"viewItem.php\">";
                echo "<input type=\"hidden\" name=\"title\" value='".$row['title']."'>";
                echo "<input type=\"hidden\" name=\"publisher\" value='".$row['publisher']."'>";
                echo "<input type=\"hidden\" name=\"publicationdate\" value='".$row['publicationdate']."'>";
                echo "<input type=\"hidden\" name=\"isbn\" value='".$row['isbn']."'>";
                echo "<input value =\"View Item\" type=\"submit\">";
                echo "</form>";

                echo "</td>";
                echo "</tr>";
            }
            echo "</table>";        
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