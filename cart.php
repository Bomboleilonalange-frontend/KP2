<?php
session_start();
require 'connect.php';
if (!isset($_SESSION['user_id'])) {
    echo "Необходимо авторизоваться, чтобы воспользоваться корзиной!";
    exit();
}
$user_id = $_SESSION['user_id'];
$sql = "SELECT product_id, quantity FROM cart WHERE user_id = $user_id";
$result = mysqli_query($connect, $sql );
if (!$result) {
    die('Could not query the database: ' . mysqli_error($connect));
}

$cart_items = array();
while ($row = mysqli_fetch_assoc($result)) {
    $cart_items[] = $row;
}

$sql = "SELECT product_id, name, price, image FROM products";
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
echo '<section class="main">';
echo '<div class="store-text">Корзина</div>';
echo '<div class="cart-wrapper">';

$total = 0;
foreach ($cart_items as $item) {

    $product_id = $item['product_id'];
    $quantity = $item['quantity'];

    $name = $products[$product_id]['name'];
    $price = $products[$product_id]['price'];
    $image = $products[$product_id]['image'];

    $sum = $price * $quantity;

    $total += $sum;

    echo '<div class="cart-item">';
    echo '<div class="cart-item-image"><img src="'. $image .'" alt="" width="108.1px" height="98px"></div>';
    echo '<div class="cart-item-name">' . $name .'</div>';
    echo '<div class="cart-item-quantity">' . $quantity . '</div>';
    echo '<div class="cart-item-price">' . $price .'</div>';
    echo '<a href="delete_cart_item (2).php?product_id=' . $product_id . '"><img src="img/Main-boxes/trash.svg" alt=""></a>';
    echo '</div>';
}

echo '<tr>';
echo '<td colspan="3">Итого:</td>';
echo '<td>' . $total . '₽</td>';
echo '<td></td>';
echo '</tr>';
echo '</table>';


mysqli_close($connect);
?>
<form action="clear_cart.php" method="POST">
    <button class="submit-btn" onclick="return confirm('Вы уверены, что хотите очистить корзину?');">Очистить корзину</button>
</form>
<form action="place_order.php" method="POST">
    <button>Оформить</button>
</form>
<?php
echo '</div>';
echo '</section>';
echo '</body>';
?>