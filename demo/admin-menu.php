<!DOCTYPE html>
<html lang="zh-CN">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>管理员页面</title>
    <link href="./bootstrap.min.css" rel="stylesheet">
    <link href="./admin.css" rel="stylesheet">
    <link rel="icon" href="./image/logo.png">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">管理员页面</h1>
        <div class="d-flex flex-column align-items-center">
            <ul class="list-group w-100">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="insert-product.php?page=1" class="nav-link">添加商品</a>
                    <i class="fas fa-plus"></i>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="delete-product.php?page=1" class="nav-link">删除商品</a>
                    <i class="fas fa-trash-alt"></i>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a href="update-product.php?page=1" class="nav-link">更新商品条目</a>
                    <i class="fas fa-edit"></i>
                </li>
            </ul>
        </div>
        <div class="d-flex justify-content-center mt-3">
            <a href="logout.php" class="btn btn-danger nav-link logout">退出账号</a>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js" crossorigin="anonymous"></script>
    <script src="./bootstrap.bundle.min.js"></script>
</body>
</html>