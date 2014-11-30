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
                <th>Price</th>
            </tr>

            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
                <tr>
                    <td><?php echo $value['isbn']; ?></td>
                    <td><?php echo $value['title']; ?></td>
                    <td><?php echo $value['publisher']; ?></td>
                    <td><?php echo $value['bookformat']; ?></td>
                    <td><?php echo $value['price']; ?></td>
                    <?php $total += $value['price']; ?>
                </tr>
            <?php } ?>

            <?php if ($total != 0) { ?>
                <tr>
                    <td colspan="4"><b>Total</b></td>
                    <td><b><?php echo $total; ?></b></td>
                </tr>
            <?php } ?>

        </table>

        <?php
        //remove the session data:
        $_SESSION['cart'] = array();
        ?>

    </body>
</html>
