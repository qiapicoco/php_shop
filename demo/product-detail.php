<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>商品页面</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php if (isset($_SESSION['customer'])): ?>
        <p>欢迎您，<?php echo htmlspecialchars($_SESSION['customer']['name']); ?> 先生（女士）。</p>
    <?php else: ?>
        <p>请先登录。</p>
    <?php endif; ?>

    <form class="search-form" action="product-detail.php" method="post">
        <input type="text" name="keyword" placeholder="请输入商品名或价格" value="<?php echo isset($_POST['keyword']) ? htmlspecialchars($_POST['keyword']) : ''; ?>">
        <input type="submit" value="检索">
    </form>
    <hr>

    <?php
    if (isset($_GET['id'])) {
        // 显示商品详情
        try {
            $sql = $pdo->prepare('SELECT * FROM product WHERE id=?');
            $sql->execute([$_GET['id']]);
            $row = $sql->fetch();
            if ($row) {
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
                echo '<p><a href="product-detail.php">返回商品列表</a></p>';
                echo '<p><a href="favorite-insert.php?id=', $row['id'], '">添加到收藏夹</a></p>';
            } else {
                echo '商品不存在';
            }
        } catch (PDOException $e) {
            echo '数据库错误：', $e->getMessage();
        }
    } else {
        // 显示商品列表
        echo '<table class="product-table">';
        echo '<tr><th>商品编号</th><th>商品名</th><th>图片</th><th>价格</th></tr>';
        try {
            if (isset($_REQUEST['keyword'])) {
                $sql = $pdo->prepare('SELECT * FROM product WHERE name LIKE ?');
                $sql->execute(['%' . $_REQUEST['keyword'] . '%']);
            } else {
                $sql = $pdo->query('SELECT * FROM product');
            }
            foreach ($sql as $row) {
                $id = $row['id'];
                echo '<tr>';
                echo '<td>', $id, '</td>';
                echo '<td>';
                echo '<a href="product-detail.php?id=', $id, '">', $row['name'], '</a>';
                echo '</td>';
                echo '<td>';
                echo '<img class="product-image" alt="image" src="image/', isset($row['image']) ? $row['image'] : '', '">';
                echo '</td>';
                echo '<td>', $row['price'], '</td>';
                echo '</tr>';
            }
            echo '</table>';
        } catch (PDOException $e) {
            echo '数据库错误：', $e->getMessage();
        }
    }
    ?>
</body>
</html>

<?php require '../footer.php'; ?>