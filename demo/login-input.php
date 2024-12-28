<?php
require '../header.php';

// 处理用户登录
if (isset($_POST['login'])) {
    $userName = $_POST['name'];
    $passWord = $_POST['password'];
    
    // 查询数据库中的用户信息
    $sql = "SELECT * FROM customer WHERE name='" . $userName . "' AND password='" . $passWord . "' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // 设置 session
        $_SESSION['customer'] = [
            'id' => $result->fetch_assoc()['id'],
            'name' => $userName,
            'address' => $result->fetch_assoc()['address'],
            'login' => $result->fetch_assoc()['login'],
            'password' => $result->fetch_assoc()['password']
        ];

        // 设置 cookie
        setcookie('customer_name', $userName, time() + (3600* 24 * 30), "/"); // 3600s=1h，3600*24=1天。cookie设置为30天
        setcookie('customer_id', $result->fetch_assoc()['id'], time() + (3600 * 24 * 30), "/");

        echo "登录成功！";
    } else {
        echo "用户名或密码错误！";
    }
}

// 处理管理员登录
if (isset($_POST['adminLogin'])) {
    $adminUsername = $_POST['adminUsername'];
    $adminPassword = $_POST['adminPassword'];
    
    // 查询数据库中的管理员信息
    $sql = "SELECT * FROM admins WHERE adminUsername='" . $adminUsername . "' AND adminPassword='" . $adminPassword . "' LIMIT 1";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // 设置 session
        $_SESSION['admin'] = [
            'id' => $result->fetch_assoc()['id'],
            'name' => $adminUsername
        ];

        echo "管理员登录成功！";
    } else {
        echo "管理员用户名或密码错误！";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>登录</title>
    <link rel="icon" href="./image/logo.jpg">
    <link rel="stylesheet" href="style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            width: 80%;
            max-width: 600px;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
        }
        .login-module {
            margin-bottom: 20px;
        }
        .login-module h2 {
            text-align: center;
            margin-bottom: 10px;
        }
        .login-module form {
            display: flex;
            flex-direction: column;
        }
        .login-module label {
            margin-bottom: 5px;
        }
        .login-module input[type="text"],
        .login-module input[type="password"] {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        .login-module input[type="submit"] {
            padding: 10px;
            background: #007BFF;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }
        .login-module input[type="submit"]:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php require '../header.php'; ?>
        <?php require 'menu.php'; ?>

        <div class="login-module">
            <h2>用户登录</h2>
            <form action="login-output.php" method="post">
                <label for="name">昵称</label>
                <input type="text" id="name" name="name" required>
                <label for="password">密码</label>
                <input type="password" id="password" name="password" required>
                <input type="submit" value="登录" name="login">
            </form>
        </div>

        <div class="login-module">
            <h2>管理员登录</h2>
            <form action="admin-menu.php" method="post">
                <label for="adminUsername">管理员用户名</label>
                <input type="text" id="adminUsername" name="adminUsername" required>
                <label for="adminPassword">管理员密码</label>
                <input type="password" id="adminPassword" name="adminPassword" required>
                <input type="submit" value="管理员登录" name="adminLogin">
            </form>
        </div>

        <?php require '../footer.php'; ?>
    </div>
</body>
</html>