<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
if (isset($_SESSION['customer'])) {
	
	$sql=$pdo->prepare('insert into favorite values(?,?)');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo '已将商品添加到收藏夹';
	echo '<hr>';
	require 'favorite.php';
} else {
	echo '要把商品添加到收藏夹，请先登录。';
}
?>
<?php require '../footer.php'; ?>
