<!DOCTYPE html>
<html>
    <head>
        <link href="stylesheet.css" rel="stylesheet" type="text/css" />
    </head>
    <body>

        <?php
        session_start();
        if (isset($_SESSION['username']) && isset($_SESSION['password'])) {
            
        } else {
            header("location:login.php");
        }
        $total = 0;
        ?> 

        <ul>
            <li><a href="homescreen.php">Home</a></li>
        </ul>
        <h1>Thank You!!!</h1>

        <p>Summary of transaction is:</p>

        <table border="1">
            <tr>
                <th>ISBN</th>
                <th>Title</th>
                <th>Publisher</th>
                <th>Book Format</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total Price</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['isbn']; ?></td>
                    <td><?php echo $value['title']; ?></td>
                    <td><?php echo $value['publisher']; ?></td>
                    <td><?php echo $value['bookformat']; ?></td>
                    <td><?php echo $value['quantity']; ?></td>
                    <td><?php echo $value['price']; ?></td>
                    <td><?php echo ($value['quantity'] * $value['price']); ?></td>
                    <?php $total += ($value['quantity'] * $value['price']); ?>
                </tr>
            <?php } ?>

            <?php if ($total != 0) { ?>
                <tr>
                    <td colspan="6"><b>Grand Total</b></td>
                    <td><b><?php echo $total; ?></b></td>
                </tr>
            <?php } ?>

        </table>

        <?php
        if (count($_SESSION['cart']) > 0) {

            $host = "localhost"; // Host name 
            $username = "root"; // Mysql username 
            $password = ""; // Mysql password 
            $db = "bookstore"; // Database name  

            $con = mysqli_connect($host, $username, $password, $db);
            if (mysqli_connect_errno()) {
                echo "Failed to connect to MySQL: " . mysqli_connect_error();
            }

            // username and password from session
            $myusername = $_SESSION['username'];
            $mypassword = $_SESSION['password'];
            $sql = "SELECT * FROM customer WHERE emailaddress='$myusername' and password='$mypassword'";
            $result = mysqli_query($con, $sql);

            $row = mysqli_fetch_assoc($result);
            $orderid = 0;
            $query = "INSERT INTO orders (customerid, creditcard, address, city, state, zip, total) VALUES(" . $row['customerid'] . ",'" . $row['creditcard'] . "','" . $row['address'] . "', '" . $row['city'] . "', '" . $row['state'] . "', '" . $row['zip'] . "', " . $total . ")";
            mysqli_query($con, $query); //returns FALSE if query fails
            $orderid = mysqli_insert_id($con);
            if ($orderid > 0) {
                foreach ($_SESSION['cart'] as $key => $value) {
                    $query = "INSERT INTO orderitems (orderid, bookid, format, quantity, status, cost) VALUES(" . $orderid . "," . $value['bookid'] . ",'" . $value['bookformat'] . "', " . $value['quantity'] . ", 0, '" . ($value['quantity'] * $value['price']) . "')";
                    mysqli_query($con, $query); //returns FALSE if query fails
                }
            }
        }

        //remove the session data:
        $_SESSION['cart'] = array();
        ?>

    </body>
</html>
