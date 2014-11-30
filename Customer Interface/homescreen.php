<!DOCTYPE html>
<html>
<head>
    <link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>
<body>
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


    <?php
        session_start();
        if(isset($_SESSION['username']) && isset($_SESSION['password']))
        {
            
        }

        else
        {
            header("location:login.php");
        }
    ?>   
</body>
</html>
