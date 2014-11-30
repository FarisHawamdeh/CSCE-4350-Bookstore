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

<table border="1">
    <tr>
        <th>ISBN</th>
        <th>Title</th>
        <th>Publisher</th>
        <th>Book Format</th>
        <th>Price</th>
        <th>Action</th>
    </tr>

    <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
        <tr>
            <td><?php echo $value['isbn']; ?></td>
            <td><?php echo $value['title']; ?></td>
            <td><?php echo $value['publisher']; ?></td>
            <td><?php echo $value['bookformat']; ?></td>
            <td><?php echo $value['price']; ?></td>
            <?php $total += $value['price']; ?>
            <td>
                <form method="post">
                    <input type="hidden" name="del_bookid" value="<?php echo $value['bookid']; ?>" />
                    <input type="hidden" name="del_isbn" value="<?php echo $value['isbn']; ?>" />
                    <input type="hidden" name="del_title" value="<?php echo $value['title']; ?>" />
                    <input type="hidden" name="del_publisher" value="<?php echo $value['publisher']; ?>" />
                    <input type="hidden" name="del_bookformat" value="<?php echo $value['bookformat']; ?>" />
                    <input type="hidden" name="del_price" value="<?php echo $value['price']; ?>" />
                    <input type="submit" name="del_submit" value="Delete" />
                </form>
            </td>
        </tr>
    <?php } ?>

    <?php if ($total != 0) { ?>
        <tr>
            <td colspan="4"><b>Total</b></td>
            <td><b><?php echo $total; ?></b></td>
        </tr>
    <?php } ?>

</table>

<a href="homescreen.php">Continue Shopping</a>
<span>|</span>
<a href="thankyou.php">Check out</a>

<?php
if (isset($_POST['del_submit'])) {
    $_SESSION['cart'] = array();
    foreach ($_SESSION['cart'] as $key => $value) {
        if ($value['bookid'] == $_POST['del_bookid'] && $value['isbn'] == $_POST['del_isbn'] && $value['bookformat'] == $_POST['del_bookformat'] && $value['price'] == $_POST['del_price']) {
            echo 'matched: ' . $key;
        } else {
            $temp = array();
            $temp['bookid'] = $value['bookid'];
            $temp['isbn'] = $value['isbn'];
            $temp['title'] = $value['title'];
            $temp['publisher'] = $value['publisher'];
            $temp['bookformat'] = $value['bookformat'];
            $temp['price'] = $value['price'];
            $_SESSION['cart'][] = $temp;
        }
    }
    header("location:viewItem.php");
}
?>

<?php
if (isset($_POST['bookid']) && isset($_POST['title']) && isset($_POST['publisher']) &&
        isset($_POST['isbn']) && isset($_POST['bookformat']) && isset($_POST['bookprice'])) {
    //display item information.... have to add to cart

    $temp = array();

    $str = $_POST['bookformat'];
    $str = explode(',', $str);

    $temp['bookid'] = $_POST['bookid'];
    $temp['isbn'] = $_POST['isbn'];
    $temp['title'] = $_POST['title'];
    $temp['publisher'] = $_POST['publisher'];
    $temp['bookformat'] = $str[1];
    $temp['price'] = $_POST['bookprice'];

    $_SESSION['cart'][] = $temp;

    header("location:viewItem.php");
}
?>