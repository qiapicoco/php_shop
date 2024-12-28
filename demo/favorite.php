<?php
if (isset($_SESSION['customer'])) {
	echo '<table>';
	echo '<tr><th>商品编号</th><th>商品名</th>';
	echo '<th>价格</th><th></th></tr>';
	
	$sql = $pdo->prepare(
		'select * from favorite, product ' .
			'where customer_id=? and product_id=id'
	);
	$sql->execute([$_SESSION['customer']['id']]);
	foreach ($sql as $row) {
		$id = $row['id'];
		echo '<tr>';
		echo '<td>', $id, '</td>';
		echo '<td><a href="detail.php?id=' . $id . '">', $row['name'],
		'</a></td>';
		echo '<td>', $row['price'], '</td>';
		echo '<td><a href="favorite-delete.php?id=', $id,
		'">删除</a></td>';
		echo '</tr>';
	}
	echo '</table>';
} else {
	echo '要显示收藏夹，请先登录';
}
?>