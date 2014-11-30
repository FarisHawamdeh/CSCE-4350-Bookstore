<?php
	$host="localhost"; // Host name 
	$username="root"; // Mysql username 
	$password=""; // Mysql password 
	$db="bookstore"; // Database name  

	$con = mysqli_connect($host, $username, $password, $db);
		
   if (mysqli_connect_errno()) 
   {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
   }

	echo "<div align = center>";
    echo "<form method = \"POST\" action = \"\">";
    echo"<table width = 30% bgcolor = grey >";
    echo "<tr bgcolor = white><td><font color = black size = '4'>Name: </font>";
    echo "<input name=\"name\" type=\"text\" value= \" \" size=\"20\" maxlength=\"45\" /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>Email: </font>";
    echo "<input name=\"email\" type=\"text\" value= \" \" size=\"20\" maxlength=\"60\" /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>Password: </font>";
    echo "<input name=\"password\" type=\"password\" value= \"\" size=\"20\" maxlength=\"45\" /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>Address: </font>";
    echo "<input name=\"address\" type=\"text\" value= \"\" size=\"20\" maxlength=\"45\"  /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>City: </font>";
    echo "<input name=\"city\" type=\"text\" value= \"\" size=\"20\" maxlength=\"45\"  /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>State: </font>";
    echo "<input name=\"state\" type=\"text\" value= \"\" size=\"20\" maxlength=\"45\" /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>Zipcode: </font>";
    echo "<input name=\"zip\" type=\"text\" value= \"\" size=\"20\" maxlength=\"7\" /></td></tr>";
    echo "<tr bgcolor = white><td><font color = black size = '4'>Credit Card: </font>";
    echo "<input name=\"creditcard\" type=\"text\" value= \"\" size=\"20\" maxlength=\"20\" /></td></tr>";
    echo "<tr bgcolor = white><td><input name = \"submitInfo\" value =\"Submit Account Info\" type=\"submit\"></td></tr></div>";
    echo "</table>";
    echo "</div>";
    echo "</form>";

    if(isset($_POST['submitInfo']))
    {
        if($_POST['email'] == "" || $_POST['password'] == "")
        {
            echo "<font color = red>Make sure to fill out required feilds.</font><br>";
        }
        if(strlen($_POST['password']) < 6)
        {
            echo "<font color = red>Passwords must be at least 6 characters long.</font><br>";
        }

        else
        {
            //confirm that username has not already been selected
            $wantedUsername = $_POST['email'];
            //find if username is already being used in database
            $query = "SELECT * FROM member WHERE emailaddress = '$wantedUsername'"; 
            $result = mysqli_query($con, $query);
            $row = mysqli_fetch_array($result);
            if (mysqli_num_rows($result) == 1)
            {
                echo "<font color = red>This email is already associated with an account.</font>";
            }
            else if (mysqli_num_rows($result) == 0)
            {
                $newUsername = $wantedUsername;
                $newPass = $_POST['password'];
                $name = $_POST['name'];
                $address = $_POST['address'];
                $city = $_POST['city'];
                $state = $_POST['state'];
                $zip = $_POST['zip'];
                $creditcard = $_POST['creditcard'];
                //insert account into database
                $query = "INSERT INTO customer (name, emailaddress, password, address, city, state, zip, creditcard, isdeleted)VALUES('".$name."','".$newUsername."','".$newPass."', '".$address."', '".$city."', '".$state."', '".$zip."', '".$creditcard."', '0')";
                mysqli_query($con, $query);//returns FALSE if query fails
                header("Location: login.php");
                echo "Thank you for creating an account. Please Log In.";
            } 
        }
    }
    
?>