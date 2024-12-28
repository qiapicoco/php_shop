<!-- 
验证码. 
-->
<?php
session_start(); //启动 session
//1.创建图像
$img=imagecreate(60,20); //创建一个 60*20 的图像
$white=ImageColorAllocate($img,255,255,255); //设置图像的背景色为白色

//2.创建干扰色
 for($i=1;$i<200;$i++){//在画布上随机写200个-号和*号
     $color=imagecolorallocate($img,rand(15,255),rand(150,255),rand(150,255));
     imagechar($img,1,rand(-7,70),rand(-7,30),"-",$color);
     imagechar($img,1,rand(-7,70),rand(-7,30),"*",$color);//与使用imagestring()的作用相同
 }

//3.生成验证码，写入SESSION
/* 生成一个包含字母和数字 4 位随机数 */
 $str="abcdefghijkmnpqrstuvwxy3456789";
 $num='';
 for($i=0;$i<4;$i++){
     $num.=substr($str,rand(0,strlen($str)-1),1);//substr()截取字符串
 }
 $_SESSION['yzm']=$num; //将随机数保存到 session 中

 $blue=ImageColorAllocate($img,rand(0,0),rand(0,0),rand(255,255)); //设置图像中文本颜色为蓝色(0,0,255)
 /* 将 4 位随机数添加到图像中，添加的位置不固定 */
 for($i=0;$i<4;$i++){
     imagestring($img,5,rand($i*15,($i+1)*15-7),rand(2,5),substr($num,$i,1),$blue);
 }

//4.输出图像
header ("Content-type: image/gif"); //设置输出图像的格式
ob_clean();//清除缓冲区。
imagegif($img); //输出图像

?>