<?php
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['password']) && $_SESSION['issuper'] == 1) {
        $host = "localhost"; // Host name 
        $username = "root"; // Mysql username 
        $password = ""; // Mysql password 
        $db = "bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        $sql = "SELECT * FROM admin WHERE issuper=0";

        $result = mysqli_query($con, $sql);
    } else {
        header("location:login.php");
    }
	
	$username = $_SESSION['username'];
?>

<html>
    <head>
		<title>View Admins</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
	
	<body>
		<div id="box" class="main">
			<img src="books-banner.jpg" border=2 width=800><br><br>

			<a href="splashscreen.php">Home</a> |
			<a href="viewSellers.php">Sellers</a> |
			<a href="addAdmin.php">Add Admin</a> |
			<a href="logout.php">Logout</a>
			<br><br>
			
<?php
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            while ($row = mysqli_fetch_assoc($result)) {
				echo "<tr>";
                echo "<td>";
                echo "<h3>" . $row['firstname'] . " " . $row['lastname'] . "</h3>";
				echo "<p>Admin ID: " . $row['adminid'] . "</p>";
				echo "<p>Username: " . $row['username'] . "</p>";
				
				echo "<form method = \"POST\" action = \"deleteadmin.php\">";
                echo "<input type=\"hidden\" name=\"adminid\" value='" . $row['adminid'] . "'>";
				echo "<input value =\"Delete\" type=\"submit\">";
                echo "</form>";
				
				echo "</td>";
                echo "</tr>";
			}
			echo "</table>";
		}
		else {
			echo "<p>No Admins Found!</p>";
		}

?>
		</div>
	</body>
</html>