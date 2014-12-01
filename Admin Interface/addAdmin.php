<html>
    <head>
		<title>Add Admin</title>
    </head>
	<style>
	a {font-weight:bold; text-decoration:none; color:#000000; text-align: right;}
	</style>
	<body bgcolor=#DEDEDE>
	
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
echo "<tr bgcolor = #DEDEDE><td><font color = black size = '4'>First Name: </font></td>";
echo "<td><input name=\"firstname\" type=\"text\" value= \" \" size=\"45\" maxlength=\"45\" /></td></tr>";
echo "<tr bgcolor = #DEDEDE><td><font color = black size = '4'>Last Name: </font></td>";
echo "<td><input name=\"lastname\" type=\"text\" value= \" \" size=\"45\" maxlength=\"60\" /></td></tr>";
echo "<tr bgcolor = #DEDEDE><td><font color = black size = '4'>Username: </font></td>";
echo "<td><input name=\"username\" type=\"text\" value= \"\" size=\"45\" maxlength=\"45\" /></td></tr>";
echo "<tr bgcolor = #DEDEDE><td><font color = black size = '4'>Password: </font></td>";
echo "<td><input name=\"password\" type=\"password\" value= \"\" size=\"45\" maxlength=\"45\"  /></td></tr>";
echo "<tr bgcolor = #DEDEDE><td><input name = \"submitInfo\" value =\"Submit Account Info\" type=\"submit\"></td>
		<td><a href='viewadmins.php'>Return</a></td></tr></div>";
echo "</table>";
echo "</div>";
echo "</form>";

if (isset($_POST['submitInfo'])) {
    if ($_POST['username'] == "" || $_POST['password'] == "") {
        echo "<font color = red>Make sure to fill out required fields.</font><br>";
    }
    if (strlen($_POST['password']) < 6) {
        echo "<font color = red>Passwords must be at least 6 characters long.</font><br>";
    } else {
        //confirm that username has not already been selected
        $wantedUsername = $_POST['username'];
        //find if username is already being used in database
        $query = "SELECT * FROM admin WHERE username = '$wantedUsername'";
        $result = mysqli_query($con, $query);
        $row = mysqli_fetch_array($result);
        if (mysqli_num_rows($result) == 1) {
            echo "<font color = red>This username is already associated with an account.</font>";
        } else if (mysqli_num_rows($result) == 0) {
            $newUsername = $wantedUsername;
            $newPass = $_POST['password'];
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            //insert account into database
            $query = "INSERT INTO admin (firstname, lastname, username, password, issuper)VALUES('" . $firstname . "','" . $lastname . "','" . $newUsername . "', '" . $newPass . "', '0')";
            mysqli_query($con, $query); //returns FALSE if query fails
            header("Location: viewadmins.php");
            echo "Account Created!";
        }
    }
}
?>

	</body>
</html>