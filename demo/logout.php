<?php
session_start();
require '../header.php';
require 'menu.php';

// 检查是否有确认注销的动作
if (isset($_GET['confirm']) && $_GET['confirm'] == 'yes') {
    if (isset($_SESSION['customer'])) {
        unset($_SESSION['customer']);
        // 删除 cookie
        setcookie('customer_name', '', time() - 3600*24*30, "/");
        setcookie('customer_id', '', time() - 3600*24*30, "/");
        echo '注销成功';
    } else {
        echo '已注销';
    }
} else {
    // 显示确认注销的提示
    ?>
    <p>确认注销？</p>
    <a href="logout.php?confirm=yes">注销</a>
    <?php
}
// 跳转到商品页
echo "<script>
        setInterval(function(){
            window.location.href = 'product-detail.php';
        },5000);
        </script>";
require '../footer.php';
require 'date.php';
?>