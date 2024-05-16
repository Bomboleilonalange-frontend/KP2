
<?php
session_start();
unset($_SESSION['user_id']);
$_SESSION['user_id'] = false;
header('Location: ../index.php');