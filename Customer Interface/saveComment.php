<ul>
    <li><a href="homescreen.php">Home</a></li>
</ul>

<?php
	session_start();
	if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
	    
	} else {
	    header("location:login.php");
	}

	if(isset($_POST['text']) && isset($_POST['bookid']))
	{
		$host = "localhost"; // Host name 
        $username = "root"; // Mysql username 
        $password = ""; // Mysql password 
        $db = "bookstore"; // Database name  

        $con = mysqli_connect($host, $username, $password, $db);

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }

        date_default_timezone_set('America/Chicago');
		$date = date('Y/m/d h:i:s a', time());

        $query = "INSERT INTO comments (bookid, customerid, date, comment) VALUES (" . $_POST['bookid'] . ", 2, " . $date . ", " . $_POST['text'] . ")";
        mysqli_query($con, $query);

        echo "Comment saved! Seller can now view this comment";
	}
?>