<?php
session_start();
require 'connect.php';
if (!isset($_SESSION['user_id'])) {
    echo "Необходимо авторизоваться, чтобы воспользоваться корзиной!";
    exit();
}
$user_id = $_SESSION['user_id'];
$product_id = $_GET['product_id'];

$sql = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die('Could not execute the query: ' . mysqli_error($connect));
}
mysqli_close($connect);
header('Location: cart.php');
?>