<?php
session_start();
?>

<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="css/reset.css" />
  <link rel="stylesheet" href="css/main.css" />
  <title>Аренда авто</title>
</head>

<body>
  <header class="header">
    <div class="container">
      <div class="header-nav">
        <div class="header-left ">
          <div class="logo">
            <a href="index.php">Эх прокачу</a>
          </div>
          <nav>
            <ul class="nav-list">
              <li><a href="" class="nav-link active navbar">Главная</a></li>
            </ul>
          </nav>
        </div>
        <div class="header-right">
          <div class="Logic">
            <?php if (!empty($_SESSION['user_id'])) : ?>
              <a href="cart.php">
                Корзина
              </a>
              <a class="" href="cabinet.php">
                Личный кабинет
              </a>
            <?php else : ?>
              <button class="Enter" id="OpenForm">Войти</button>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="header-row" id="">
      <div class="wrapper">
        <div class="Registrathion-container">
          <span class="close">
            <img src="img/Header/close-svgrepo-com.svg" alt="">
          </span>
          <h2 class="Registrathion">Регистрация</h2>
          <div class="login">
            <form class="form-box" id="signup-form" action="php/signup.php" method="post">
              <div class="email-or-phone">
                <span class="icon"></span>
                <label for="">Email или телофон</label>
                <input type="text" name="Email" id="RegEmail" required>
              </div>
              <div class="password">
                <span class="icon"></span>
                <label for="">Пароль</label>
                <input type="password" name="Password" required>
              </div>
              <div class="Registrathion-remember">
                <input type="checkbox">
                <label for="">Запомнить меня</label>
              </div>
              <button type="submit" class="Submit">Войти</button>
              <div class="login-register">
                <p>Уже есть аккаунт?<a class="Registrathion-link" href="#">Войдите</a></p>
              </div>
            </form>
          </div>
        </div>
        <div class="Authorization-container">
          <span class="close2">
            <!-- <img src="img/Header/close-svgrepo-com.svg" alt=""> -->
          </span>
          <h2 class="Authorization">Авторизация</h2>
          <div class="login">
            <form class="form-box" id="signin-form" action="php/signin.php" method="post">
              <div class="email-or-phone">
                <span class="icon"></span>
                <label for="">Email или телофон</label>
                <input type="text" name="Email" id="AuthEmail" required>
              </div>
              <div class="password">
                <span class="icon"></span>
                <label for="">Пароль</label>
                <input type="password" id="AutPass" name="Password" required>
                <a href="#">Забыли Пароль</a>
              </div>
              <div class="Authorization-remember">
                <input type="checkbox">
                <label for="">Запомнить меня</label>
              </div>
              <button type="submit" class="Submit">Войти</button>
              <div class="login-register">
                <p>Нет аккаунта?<a class="Authorization-link" href="#">Создайте</a></p>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="zatemnenie" id="zatemnenie"></div>
    </div>
    </div>
  </header>
  <main class="main">
    <div class="container">
      <h1 class="menu-heading" id="Order">Ознакомьтесь с асортиментом</h1>
      <div class="cards">
        <?php
        require 'connect.php';
        $sql = "SELECT * FROM products WHERE page = '1'";
        $result = mysqli_query($connect, $sql);
        if (!$result) {
          die('Could not query the database: ' . mysqli_error($connect));
        }
        while ($row = mysqli_fetch_assoc($result)) {
          echo '<form action="add_to_cart.php" class="Dish" method="POST">';
          echo '<img src="' . $row['image'] . '" alt="">';
          echo '<h3>' . $row['name'] . '</h3>';
          echo '<p class="description">' . $row['description'] . '</p>';
          echo '<div class="add">';
          echo '<div class="Off-button">';
          echo '<button name="product_id" class="click" value="' . $row['product_id'] . '">
          <div class="plus"></div>
          </button>';
          echo '<p class="price">' . $row['price'] . '₽</p>';
          echo '</div>';
          echo "</div>";
          echo "</div>";
          echo '</form>';
        }
        ?>
      </div>
    </div>
  </main>
  <script src="js/form.js"></script>
</body>

</html>