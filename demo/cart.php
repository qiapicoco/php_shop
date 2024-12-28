<?php
echo "购物车";
if (!empty($_SESSION['product'])) {
	echo '<table>';
	echo '<tr><th>商品编号</th><th>商品名</th>';
	echo '<th>价格</th><th>数量</th><th>小计（￥）</th><th></th></tr>';
	$total=0;
	foreach ($_SESSION['product'] as $id=>$product) {
		echo '<tr>';
		echo '<td>', $id, '</td>';
		echo '<td><a href="detail.php?id=', $id, '">', 
			$product['name'], '</a></td>';
		echo '<td>', $product['price'], '</td>';
		echo '<td>', $product['count'], '</td>';
		$subtotal=$product['price']*$product['count'];
		$total+=$subtotal;
		echo '<td>', $subtotal, '</td>';
		echo '<td><a href="cart-delete.php?id=', $id, '">删除</a></td>';
		
		echo '</tr>';
		
	}
	echo '<tr><td>合计</td><td></td><td></td><td></td><td>', $total, 
		'</td><td></td></tr>';
		echo '</table>';
} else {
	echo '购物车里没有商品';
}

?>
