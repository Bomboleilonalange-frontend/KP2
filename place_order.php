<?php
session_start();
require 'connect.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT product_id, quantity FROM cart WHERE user_id = $user_id";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die('Could not query the database: ' . mysqli_error($connect));
}

$cart_items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
}

$sql = "SELECT product_id, name, price FROM products";
$result = mysqli_query($connect, $sql);
if (!$result) {
    die('Could not query the database: ' . mysqli_error($connect));
}

$products = array();
while ($row = mysqli_fetch_assoc($result)) {
    $products[$row['product_id']] = $row;
}
echo '<html lang="en">';
echo '<body>';
echo '<div class="login-form">';
echo '<form action="confirm_order.php" method="POST">';
echo '<label for="address">Адрес доставки:</label>';
echo '<input type="text" id="address" name="address" required>';
echo '<label for="method">Метод доставки:</label>';
echo '<select id="method" name="method" onchange="updateCost(this.value)">';
echo '<option value="Курьерская служба">Доставка к вам</option>';
echo '<option value="Самовывоз">Самовывоз</option>';
echo '</select>';
echo '<label for="date">Дата доставки:</label>';
echo '<input type="date" id="date" name="date" required>';
echo '<label for="cost">Стоимость доставки:</label>';
echo '<input type="number" id="cost" name="cost" value="500" readonly>';
$total = 0;
foreach ($cart_items as $item) {
    $product_id = $item['product_id'];
    $quantity = $item['quantity'];
    $name = $products[$product_id]['name'];
    $price = $products[$product_id]['price'];
    $sum = $price * $quantity;
    $total += $sum;
    echo '<input type="hidden" name="product_id[]" value="' . $product_id . '">';
    echo '<input type="hidden" name="quantity[]" value="' . $quantity . '">';
}
echo '<input type="hidden" name="total" value="' . $total . '">';
echo '<button>Подтвердить заказ</button>';
echo '</form>';
echo '</div>';
echo '</body>';
echo '</html>';
mysqli_close($connect);
?>
<script>
    function updateCost(method) {
        let cost = document.getElementById("cost");
        let address = document.getElementById("address");
        if (method === "Самовывоз") {
            cost.value = 0;
            address.disabled = true;
        } else if (method === "Доставка к вам") {
            cost.value = 500;
            address.disabled = false;
        }
    }
</script>