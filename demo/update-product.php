<?php require '../header.php'; ?>
<?php
// 初始化变量
$name = '';
$price = '';
$id = '';
$message = '';
$search_query = '';
// 检查表单是否已提交
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $price = $_POST['price'];
    $id = $_POST['id'];

    // 处理图片上传
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $target_dir = "image/";
        $target_file = $target_dir . basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // 检查文件类型
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            $message = "只允许 JPG, JPEG, PNG & GIF 文件。";
            $uploadOk = 0;
        }

        // 检查文件大小
        if ($_FILES["image"]["size"] > 500000) {
            $message = "文件太大。";
            $uploadOk = 0;
        }

        // 如果没有错误，尝试上传文件
        if ($uploadOk == 1) {
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
                // 更新数据库中的图片路径
                $sql = $pdo->prepare('UPDATE product SET name=?, price=?, image=? WHERE id=?');
                $image_path = basename($_FILES["image"]["name"]);
                if ($sql->execute([$name, $price, $image_path, $id])) {
                    $message = '更新成功。';
                } else {
                    $message = '更新失败。';
                }
            } else {
                $message = '上传失败。';
            }
        }
    } else {
        // 不处理图片上传的情况
        $sql = $pdo->prepare('UPDATE product SET name=?, price=? WHERE id=?');

        if (empty($name)) {
            $message = '请输入商品名。';
        } elseif (!preg_match('/^[0-9]+$/', $price)) {
            $message = '请输入整数形式的商品价格。';
        } elseif ($sql->execute([$name, $price, $id])) {
            $message = '更新成功。';
        } else {
            $message = '更新失败。';
        }
    }
}

// 检查搜索表单是否已提交
if (isset($_GET['search'])) {
    $search_query = htmlspecialchars($_GET['search']);
}

// 构建查询语句
$sql_query = "SELECT * FROM product";
if (!empty($search_query)) {
    $sql_query .= " WHERE name LIKE :search OR price LIKE :search";
}

// 执行查询
$stmt = $pdo->prepare($sql_query);
if (!empty($search_query)) {
    $stmt->bindValue(':search', "%{$search_query}%", PDO::PARAM_STR);
}
$stmt->execute();
$products = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>更新商品条目</title>
</head>
<body></body>
</html>

<!-- 搜索表单 -->
<form class="search-form" action="" method="get">
    <input type="text" name="search" placeholder="请输入商品名或价格" value="<?php echo $search_query; ?>">
    <input type="submit" value="搜索">
    <div class="search-result">搜索结果：<?php echo count($products); ?>个</div>
    <a href="update-product.php" >返回全部</a>
    <a href="admin-menu.php" >返回管理员菜单</a>
</form>

<!-- 商品信息表头 -->
<table class="product-table">
    <thead>
        <tr>
            <th class="th0">商品编号</th>
            <th class="th1">商品名</th>
            <th class="th1">图片</th>
            <th class="th1">价格</th>
            <th class="th1">操作</th>
        </tr>
    </thead>
    <tbody>
        <?php
        foreach ($products as $row) {
            echo '<tr>';
            
            // 添加隐藏字段，存储商品编号
            echo '<form class="customer-form" action="" method="post" enctype="multipart/form-data">';
            echo '<input type="hidden" name="id" value="', $row['id'], '">';
            
            // 显示商品编号
            echo '<td class="td0">', $row['id'], '</td>';
            
            // 显示商品名称输入框，预填充当前值
            echo '<td class="td1">';
            echo '<input type="text" name="name" value="', $row['name'], '">';
            echo '</td>';
            
            // 显示商品图片
            echo '<td class="td1">';
            echo '<p><img class="product-image" alt="image" src="image/', isset($row['image']) ? $row['image'] : '', '"></p>';
            echo '<input type="file" name="image" accept="image/*">';
            echo '</td>';
            
            // 显示商品价格输入框，预填充当前值
            echo '<td class="td1">';
            echo '<input type="text" name="price" value="', $row['price'], '">';
            echo '</td>';
            
            // 提交按钮，用于更新商品信息
            echo '<td class="td2">';
            echo '<input type="submit" value="更新">';
            echo '</td>';
            
            // 结束表单
            echo '</form>';
            echo '</tr>';
        }
        ?>
    </tbody>
</table>

<!-- 显示更新结果 -->
<?php if (!empty($message)): ?>
<script>
    alert('<?php echo addslashes($message); ?>');
</script>
<?php endif; ?>

<!-- 包含底部文件，通常包含版权信息、脚本链接等 -->
<?php require '../footer.php'; ?>