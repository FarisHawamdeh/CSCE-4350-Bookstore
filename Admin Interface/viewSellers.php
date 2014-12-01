<?php
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
        $host = "localhost"; // Host name 
        $username = "root"; // Mysql username 
        $password = ""; // Mysql password 
        $db = "bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql = "SELECT * FROM seller WHERE isdeleted=0";

        $result = mysqli_query($con, $sql);
    } else {
        header("location:login.php");
    }
	
	$username = $_SESSION['username'];
?>

<html>
    <head>
		<title>View Sellers</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
	
	<body>
		<div id="box" class="main">
			<img src="books-banner.jpg" border=2 width=800><br><br>

			<a href="splashscreen.php">Home</a> |
			<a href="addseller.php">Add Seller</a> |
			
<?php
    if ($_SESSION["issuper"] == 1) {
        echo '<a href="viewAdmins.php">Admins</a> | ';
    }
?>

			<a href="logout.php">Logout</a>
			<br><br>
			
<?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
                echo "<td>";
                echo "<h3>" . $row['name'] . "</h3>";
				echo "<p>Email Address: " . $row['emailaddress'] . "</p>";
				echo "<p>Address: " . $row['address'] . ", " . $row['city'] . ", " . $row['state'] . ", " . $row['zip'] . "</p>";
				echo "<p>Phone Number: " . $row['phonenumber'] . "</p>";
				
				echo "<form method = \"POST\" action = \"deleteseller.php\">";
                echo "<input type=\"hidden\" name=\"sellerid\" value='" . $row['sellerid'] . "'>";
				echo "<input value =\"Delete\" type=\"submit\">";
                echo "</form>";
				
				echo "</td>";
                echo "</tr>";
			}
			echo "</table>";
		}
		else {
			echo "<p>No Sellers Found!</p>";
		}

?>
		</div>
	</body>
</html>
