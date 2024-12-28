<?php require '../header.php'; ?>
<link rel="stylesheet" href="./admin.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="container">
    <div class="card">
        <div class="card-header">
            商品列表
        </div>
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>商品编号</th>
                        <th>商品名</th>
                        <th>价格</th>
                        <th>操作</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($pdo->query('select * from product') as $row) {
                        echo '<tr>';
                        echo '<td>', htmlspecialchars($row['id']), '</td>';
                        echo '<td>', htmlspecialchars($row['name']), '</td>';
                        echo '<td>', htmlspecialchars($row['price']), '</td>';
                        echo '<td>';
                        echo '<a href="#" class="btn btn-primary delete-btn" data-id="', htmlspecialchars($row['id']), '">删除</a>';
                        echo '</td>';
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.delete-btn').click(function(event) {
        event.preventDefault();
        var id = $(this).data('id');
        var url = '?action=delete&id=' + id;

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // 显示删除成功的弹窗
                alert('删除成功');
                // 刷新页面
                location.reload();
            },
            error: function() {
                // 显示删除失败的弹窗
                alert('删除失败，请稍后再试。');
                // 刷新页面
                location.reload();
            }
        });
    });
});
</script>
<a href="admin-menu.php" >返回管理员菜单</a>
<?php require '../footer.php'; ?>

<?php
if (isset($_GET['action']) && $_GET['action'] === 'delete') {
    if (isset($_GET['id'])) {
        $id = intval($_GET['id']);
        
        try {
            // 删除商品
            $stmt = $pdo->prepare('DELETE FROM product WHERE id = :id');
            $stmt->execute([':id' => $id]);
            
            if ($stmt->rowCount() > 0) {
                // 删除成功
                // 重新排序商品ID
                $pdo->exec('SET @count = 0; UPDATE product SET id = @count:=@count+1;');
                
                // 重置自增ID
                $pdo->exec('ALTER TABLE product AUTO_INCREMENT = 1;');
                
                // 返回成功响应
                echo "删除成功并重新排序。";
                exit;
            } else {
                // 没有找到对应的记录
                http_response_code(404);
                echo "没有找到对应的记录";
                exit;
            }
        } catch (PDOException $e) {
            // 数据库错误
            http_response_code(500);
            echo "数据库错误: " . $e->getMessage();
            exit;
        }
    } else {
        // 缺少商品编号
        http_response_code(400);
        echo "缺少商品编号";
        exit;
    }
}
?>