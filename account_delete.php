<?php
include 'connect.php';
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $sql = "DELETE FROM users WHERE user_id = '$user_id'";
    if (mysqli_query($connect, $sql)) {
            echo "Аккаунт удалён";
            session_destroy();
            header('Refresh:2, URL=login.php');
    }
}
mysqli_close($connect);