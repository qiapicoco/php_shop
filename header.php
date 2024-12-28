<<<<<<< HEAD
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<!-- <title>稻草人购物网站</title> -->
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
<link rel="icon" href="./image/logo.png">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "shop";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "MySQL数据库连接成功";
} catch (PDOException $e) {
    echo "MySQL数据库连接失败: " . $e->getMessage();
}
=======
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<!-- <title>稻草人购物网站</title> -->
<link rel="stylesheet" href="../style.css">
<link rel="stylesheet" href="style.css">
<link rel="icon" href="./image/logo.png">
</head>
<body>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "shop";

try {
    $pdo = new PDO("mysql:host=$servername;dbname=$database;charset=utf8", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "MySQL数据库连接成功";
} catch (PDOException $e) {
    echo "MySQL数据库连接失败: " . $e->getMessage();
}
>>>>>>> 90f4bbe (message)
?>