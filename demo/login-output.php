<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
unset($_SESSION['customer']);

// 检查是否存在 'name' 和 'password' 字段
if (isset($_POST['name']) && isset($_POST['password'])) {
    $sql = $pdo->prepare('SELECT * FROM customer WHERE name=? AND password=?');
    $sql->execute([$_POST['name'], $_POST['password']]);
    $row = $sql->fetch();

    if ($row) {
        $_SESSION['customer'] = [
            'id' => $row['id'], 
            'name' => $row['name'], 
            'address' => $row['address'], 
            'login' => $row['login'], 
            'password' => $row['password']
        ];
    }
}

if (isset($_SESSION['customer'])) {
    echo '欢迎您', $_SESSION['customer']['name'], '先生（女士）。';
    echo "<script>
        setInterval(function(){
            window.location.href = 'product-detail.php';
        },2000);
        </script>";
} else {
    echo '姓名或密码错误';
}
?>

<?php require '../footer.php'; ?>