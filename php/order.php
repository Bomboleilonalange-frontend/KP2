<?php
require 'connect.php';
session_start();
$order_id = $_GET['id'];

$sql = "SELECT o.order_id, o.date, o.status, o.total, d.method, d.address, d.cost, d.date as delivery_date, p.name as product_name, od.quantity as product_quantity
FROM orders o
JOIN delivery d ON o.order_id = d.order_id
JOIN order_details od ON o.order_id = od.order_id
JOIN products p ON od.product_id = p.product_id
WHERE o.order_id = '$order_id'";

$result = mysqli_query($mysqli, $sql);


if (mysqli_num_rows($result) > 0) {

    $row = mysqli_fetch_assoc($result);
    echo "<section class =main>";
    echo "<div class='store-text'>Заказ #" . $row['order_id'] . "</div>";
    echo "<div class='order-wrapper'>";
    echo "<div class='order-status'>";
    echo "<p>Статус: Заказ подтверждён</p>";
    echo "<p>Дата " . $row["date"] . "</p>";
    echo "</div>";
    echo "<div class='order-details-wrapper'>";
    echo "<div class='order-details'>";
    echo "<p class='order-goods'>Подробная информация</p>";
    echo "<p>Способ получения: " . $row["method"] . "</p>";
    echo "<p>Адрес доставки: " . $row["address"] . "</p>";
    echo "<p>Стоимость доставки: " . $row["cost"] . "</p>";
    echo "<p>Дата доставки: " . $row["delivery_date"] . "</p>";
    echo "<p>Итого: " . $row["total"] . "₽" . "</p>";
    echo "</div>";
} else {

    echo "Данные о заказе не найдены.";
}
$sql = "SELECT products.name AS 'name', order_details.quantity AS 'quantity'
FROM orders
JOIN order_details ON orders.order_id = order_details.order_id
JOIN products ON order_details.product_id = products.product_id
WHERE orders.order_id = $order_id;";

$result = $mysqli->query($sql);

if ($result->num_rows > 0) {

    echo "<div class='order-list'>";
    echo "<p class='order-goods'>Товары</p>";
    while($row = $result->fetch_assoc()) {
        echo "<p>" . $row["name"]. "</p>";
        echo '<p>' . $row["quantity"] . 'шт.' . '</p>';
    }
    echo "</div>";
    echo "</section>";
} else {
    echo "<div>0 результатов</div>";
    echo "</section>";
}
mysqli_close($mysqli);
?>