<?php
session_start();
require_once '../connect.php';


$Email = $_POST['Email'];
$Password = $_POST['Password'];

$Password = md5($Password . "cjwcn13003kec");
// Проверка существует ли пользователь в базе данных
$check_user_exists = mysqli_query($connect, "SELECT * FROM `users` WHERE `email` = '$Email'");
if (mysqli_num_rows($check_user_exists) > 0) {
 // Пользователь уже существует, перенаправление на главную страницу
 header('Location: ../index.php');
 echo json_encode(array("error" => "Неправильный email"));
} else {
 // Пользователь не существует, вставка в базу данных и перенаправление на главную страницу

//  mysqli_query($connect, "INSERT INTO `users` (`id`, `Email`, `password`) VALUES (NULL, '$Email', '$Password')");
if (mysqli_query($connect, "INSERT INTO `users` (`user_id`, `email`, `password`) VALUES (NULL, '$Email', '$Password')")) {
    $_SESSION['reg'] = true;
    $user = mysqli_fetch_assoc($check_user_exists);
    $_SESSION['User'] = [
    'id' => $user['id'],
    'email' => $user['Email']
    ];
}
 header('Location: ../index.php');
 // echo json_encode(array("success" => true));
}
