<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php

// 修改 SQL 查询语句，添加 ORDER BY 子句
$sql = $pdo->prepare('SELECT * FROM product WHERE id=? ORDER BY id ASC');
$sql->execute([$_REQUEST['id']]);
foreach ($sql as $row) {
	echo '<p><img alt="image" src="image/', $row['id'], '.jpg"></p>';
	echo '<form action="cart-insert.php" method="post">';
	echo '<p>商品编号：', $row['id'], '</p>';
	echo '<p>商品名：', $row['name'], '</p>';
	echo '<p>价格（￥）：', $row['price'], '</p>';
	echo '<p>数量：<select name="count">';
	for ($i = 1; $i <= 10; $i++) {
		echo '<option value="', $i, '">', $i, '</option>';
	}
	echo '</select></p>';
	echo '<input type="hidden" name="id" value="', $row['id'], '">';
	echo '<input type="hidden" name="name" value="', $row['name'], '">';
	echo '<input type="hidden" name="price" value="', $row['price'], '">';
	echo '<p><input type="submit" value="添加到购物车"></p>';
	echo '</form>';
	echo '<p><a href="favorite-insert.php?id=', $row['id'],
	'">添加到收藏夹</a></p>';
}
?>
<?php require '../footer.php'; ?>