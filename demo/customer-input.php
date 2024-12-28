<!-- 注册/修改用户页面 -->
<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php
$name = $address = $login = $password = '';
if (isset($_SESSION['customer'])) {
    $name = $_SESSION['customer']['name'];
    $address = $_SESSION['customer']['address'];
    $login = $_SESSION['customer']['login'];
    $password = $_SESSION['customer']['password'];
}
?>
<?php if (isset($_SESSION['customer'])): ?>
    <p>欢迎您，<?php echo htmlspecialchars($_SESSION['customer']['name']); ?> 先生（女士）。</p>
<?php else: ?>
    <p>请先登录。</p>
<?php endif; ?>

<link rel="stylesheet" href="./style.css">
<script>
function validateForm() {
    var name = document.forms["customerForm"]["name"].value;
    var login = document.forms["customerForm"]["login"].value;
    var password = document.forms["customerForm"]["password"].value;

    if (name === '' || login === '' || password === '') {
        alert("账号昵称或收件人或密码不能为空");
        return false;
    }

    if (password.length < 6) {
        alert("密码不能少于6位");
        return false;
    }

    return true;
}
</script>
<form action="customer-output.php" method="post" class="customer-form" onsubmit="return validateForm()" name="customerForm">
    <table>
        <tr>
            <th>账号昵称</th>
            <td>
                <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>">
                <span id="nameError" style="color: red;"></span>
            </td>
        </tr>
        <tr>
            <th>收件地址</th>
            <td>
                <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
            </td>
        </tr>
        <tr>
            <th>收件人</th>
            <td>
                <input type="text" name="login" value="<?php echo htmlspecialchars($login); ?>">
                <span id="loginError" style="color: red;"></span>
            </td>
        </tr>
        <tr>
            <th>密码</th>
            <td>
                <input type="password" name="password" value="<?php echo htmlspecialchars($password); ?>">
                <span id="passwordError" style="color: red;"></span>
            </td>
        </tr>
    </table>
    <input type="submit" value="确 定">
</form>
<?php require '../footer.php'; ?>