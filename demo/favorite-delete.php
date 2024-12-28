<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
if (isset($_SESSION['customer'])) {
	
	$sql=$pdo->prepare(
		'delete from favorite where customer_id=? and product_id=?');
	$sql->execute([$_SESSION['customer']['id'], $_REQUEST['id']]);
	echo '删除成功！已从收藏夹里删除该商品。';
	echo '<hr>';
} else {
	echo '要从收藏夹中删除商品，请先登录。';
}
require 'favorite.php';
?>
<?php require '../footer.php'; ?>
