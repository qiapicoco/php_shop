<?php session_start(); ?>
<?php require '../header.php'; ?>
<?php require 'menu.php'; ?>
<?php

if (isset($_SESSION['customer'])) {
	$id=$_SESSION['customer']['id'];
	$sql=$pdo->prepare('select * from customer where id!=? and login=?');
	$sql->execute([$id, $_REQUEST['login']]);
} else {
	$sql=$pdo->prepare('select * from customer where login=?');
	$sql->execute([$_REQUEST['login']]);
}
if (empty($sql->fetchAll())) {
	if (isset($_SESSION['customer'])) {
		$sql=$pdo->prepare('update customer set name=?, address=?, '.
			'login=?, password=? where id=?');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'], 
			$_REQUEST['login'], $_REQUEST['password'], $id]);
		$_SESSION['customer']=[
			'id'=>$id, 
			'name'=>$_REQUEST['name'], 
			'address'=>$_REQUEST['address'], 
			'login'=>$_REQUEST['login'], 
			'password'=>$_REQUEST['password']
		];
		echo '客户信息已更新';
	} else {
		$sql=$pdo->prepare('insert into customer values(null,?,?,?,?)');
		$sql->execute([
			$_REQUEST['name'], $_REQUEST['address'], 
			$_REQUEST['login'], $_REQUEST['password']]);
		echo '客户信息注册成功！即将跳转至登录页面';
		echo "<script>
		setInterval(function(){
			window.location.href = 'login-input.php';
		},5000);
		</script>";
		
	}
} else {
	echo '此用户名已被注册，请更换！即将返回！';
	echo "<script>
		setInterval(function(){
			window.location.href = 'customer-input.php';
		},2000);
		</script>";
}
?>
<?php require 'date.php'; ?>
<?php require '../footer.php'; ?>
