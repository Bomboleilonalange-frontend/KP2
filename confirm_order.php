<?php
session_start();
require 'connect.php';
$user_id = $_SESSION['user_id'];
$method = $_POST['method'];
if ($method == 'Самовывоз' && empty($address)) {
    $address = '-';
} else {
    $address = $_POST['address'];
}

$date = $_POST['date'];
$cost = $_POST['cost'];
$total = $_POST['total'];
$product_ids = $_POST['product_id'];
$quantities = $_POST['quantity'];

$sql = "INSERT INTO orders (user_id, date, status, total) VALUES ($user_id, '$date', 'Заказ оформлен', $total)";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die('Could not insert into orders: ' . mysqli_error($connect));
}
$order_id = mysqli_insert_id($connect);

$sql = "INSERT INTO delivery (delivery_id, order_id, method, address, cost, date) VALUES ($order_id, $order_id, '$method', '$address', $cost, '$date')";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die('Could not insert into delivery: ' . mysqli_error($connect));
}
$sql = "SELECT product_id, quantity FROM cart WHERE user_id = $user_id";
$result = mysqli_query($connect, $sql);
$cart_items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
}

$sql = "SELECT product_id, name, price FROM products";
$result = mysqli_query($connect, $sql);
$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['product_id']] = $row;
}

foreach ($product_ids as $index => $product_id) {
    $quantity = $quantities[$index];
    $price = $quantity * $products[$product_id]['price'];
    $sql = "INSERT INTO order_details (order_id, product_id, quantity, price) VALUES ($order_id, $product_id, $quantity , $price)";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        die('Could not insert into order_details: ' . mysqli_error($mysqli));
    }
}

$sql = "UPDATE orders SET status = 'Заказ подтверждён' WHERE order_id = $order_id";
$result = mysqli_query($connect, $sql);
echo '<p>Ваша доставка №' . $order_id . ' успешно подтверждена.</p>';
echo '<p>Спасибо за покупку</p>';
header('Refresh: 1; URL=clear_cart.php');
mysqli_close($connect);
?>