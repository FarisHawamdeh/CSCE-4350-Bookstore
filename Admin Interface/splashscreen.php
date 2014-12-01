<?php
    session_start();
    if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
            
    } else {
        header("location:login.php");
    }
	
	$username = $_SESSION['username'];
?>

<html>
    <head>
		<title>Books Admin</title>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
	
	<body>
		<div id="box" class="main">
			<img src="books-banner.jpg" border=2 width=800><br><br>

			<a href="viewSellers.php">Sellers</a> |
			
<?php
    if ($_SESSION["issuper"] == 1) {
        echo '<a href="viewAdmins.php">Admins</a> | ';
    }
?>

			<a href="logout.php">Logout</a>
			<br><br>
			
			<h2>Welcome</h2>
<?php

        echo "<h3>" . $username . "</h3><br><br>";

?>
		</div>
	</body>
</html>