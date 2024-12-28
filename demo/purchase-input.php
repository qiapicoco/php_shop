<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
if (!isset($_SESSION['customer'])) {
	echo '显示购买手续，请先登录。';
} else 
if (empty($_SESSION['product'])) {
	echo '购物车里没有商品。';
} else {
	echo '<p>姓名：', $_SESSION['customer']['name'], '</p>';
	echo '<p>发货地址：', $_SESSION['customer']['address'], '</p>';
	echo '<hr>';
	require 'cart.php';
	
	echo '<hr>';
	echo '<p>请确认内容后，点击确认购买。</p>';
	echo '<a href="purchase-output.php">确认购买</a>';
}
?>
<?php require '../footer.php'; ?>
