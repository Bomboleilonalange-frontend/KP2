<?php
require 'connect.php';
session_start();
$user_id = $_SESSION['user_id'];
$sql = "DELETE FROM cart WHERE user_id = $user_id";
$result = mysqli_query($connect, $sql);
if ($result) {
    header('Location: cart.php');
} else {
    echo 'Произошла ошибка при удалении записей о товарах';
}
?>