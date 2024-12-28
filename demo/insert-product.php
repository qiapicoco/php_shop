<?php require '../header.php'; ?>
<link href="./admin.css" rel="stylesheet">
<link rel="stylesheet" href="./all.min.css">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">添加商品</h3>
                </div>
                <div class="card-body">
                    <?php
                    $message = '';
                    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                        try {
                            // 设置 PDO 错误模式为异常
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            // 获取表单数据
                            $name = $_POST['name'];
                            $price = $_POST['price'];

                            // 检查价格是否为数字
                            if (!is_numeric($price)) {
                                $message = '价格必须是数字';
                            } else {
                                // 检查商品是否已存在
                                $stmt = $pdo->prepare('SELECT * FROM product WHERE name = ?');
                                $stmt->execute([$name]);
                                $product = $stmt->fetch();

                                if ($product) {
                                    $message = '商品已存在';
                                } else {
                                    // 插入新商品
                                    $sql = $pdo->prepare('INSERT INTO product (name, price) VALUES (?, ?)');
                                    if ($sql->execute([$name, $price])) {
                                        $message = '添加成功';
                                    } else {
                                        $message = '添加失败';
                                    }
                                }
                            }
                        } catch (PDOException $e) {
                            $message = '数据库错误: ' . $e->getMessage();
                        }
                    }
                    ?>
                    <script>
                        var message = "<?php echo $message; ?>";
                        if (message) {
                            alert(message);
                        }
                    </script>
                    <form action="" method="post" onsubmit="return validateForm()">
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="fas fa-tag"></i></span>
                            <input type="text" class="form-control" id="name" name="name" placeholder="商品名" required>
                        </div>
                        
                        <div class="mb-3 input-group">
                            <span class="input-group-text"><i class="fas fa-dollar-sign"></i></span>
                            <input type="text" class="form-control" id="price" name="price" placeholder="价格" required pattern="\d+(\.\d{1,2})?">
                        </div>
                        <button type="submit" class="btn btn-primary w-100">添加</button>
                    </form>
                    <a href="admin-menu.php" class="btn btn-secondary w-100 mt-3">返回管理员菜单</a>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require '../footer.php'; ?>

<script>
    function validateForm() {
        var price = document.getElementById('price').value;
        if (isNaN(price)) {
            alert('价格必须是数字');
            return false;
        }
        return true;
    }
</script>