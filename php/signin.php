<?php
require '../connect.php';

$Email = $_POST['Email'];
$Password = $_POST['Password'];

$Password = md5($Password."cjwcn13003kec");

// Проверка существует ли пользователь в базе данных с указанным email и паролем
$Check_user = "SELECT * FROM users WHERE email = '$Email' AND password = '$Password'";
$result = mysqli_query($connect, $Check_user);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $user_id = $row['user_id'];
        session_start();
        $_SESSION['user_id'] = $user_id;
        echo "Вы успешно вошли в систему";
        header('Refresh: 1; URL=../index.php');
    } else {
        echo "Неверная почта или пароль";
}

mysqli_close($connect);
?>
    