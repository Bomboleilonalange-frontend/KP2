<?php
require 'connect.php';
session_start();
if (!isset($_SESSION['user_id'])) {
    echo "Необходимо авторизоваться, чтобы воспользоваться личным кабинетом!";
    header('Refresh:2, URL=login.php');
    exit();
}
$user_id = $_SESSION['user_id'];
$strSQL = "SELECT * FROM users WHERE user_id=?";
$stmt = $connect->prepare($strSQL);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();
?>
<html lang="en">
<title>Личный кабинет</title>

<body>
    <section class="main">
        <h1 class="store-text">Личный кабинет</h1>
        <div class="cabinet-wrapper">
            <div class="cabinet-information">
                <p class="user-data">Данные о пользователе:</p>
                <div class="user-information">
                    <p>email: <?= $row['email'] ?></p>
                    <p><a href="php/logout.php">Выйти</a></p>
                    <p><a href="index.php">На главную</a></p>
                    <p><a href="account_delete.php">Удалить аккаунт</a></p>
                </div>
            </div>
            <div class="orders-information">
                <?php
                $sql = "SELECT o.order_id, o.date, o.status FROM orders o WHERE o.user_id = '$user_id'";
                $result = mysqli_query($connect, $sql);
                if (mysqli_num_rows($result) > 0) {
                    echo "<table>
  <tr>
    <th>Номер заказа</th>
    <th>Статус</th>
    <th>Дата заказа</th>
  </tr>";

                    while ($row = mysqli_fetch_assoc($result)) {

                        echo "<tr>
    <td>" . $row['order_id'] . "</td>
    <td>" . $row['status'] . "</td>
    <td>" . $row['date'] . "</td>
  </tr>";
                    }

                    echo "</table>";
                }
                mysqli_close($connect);
                ?>
            </div>
        </div>
    </section>
</body>

</html>