<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
unset($_SESSION['product'][$_REQUEST['id']]);
echo '从购物车里删除了商品';
echo '<hr>';
require 'cart.php';
?>
<?php require '../footer.php'; ?>
