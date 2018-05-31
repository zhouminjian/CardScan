<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"C:\yadongtextile\web\mingpian\public/../application/index\view\index\index.html";i:1526086118;}*/ ?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta name="keywords" content="亚东集团" /> 
	<meta name="description" content="亚东名片识别" />  
	<meta name="author" content="亚东(常州)科技有限公司" /> 
	<meta name="copyright" content="版权所有" />  
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/css.css">
	<link rel="shortcut icon" type="image/x-icon" href="images/Logo.ico" media="screen" />
	<?php include "../application/index/controller/Redirurl.php";?>
	<title>名片识别</title>
</head>
<body oncopy = "noCopy()" class="container">
	<!-- 标题 -->
	<div class="text-center row third-div">
		<div class="column">
			<img src="images/Logo.png"> 
			<span class="title-span">亚东名片识别</span>
		</div>
	</div>
	<!-- 文件上传区域 -->
	<div style="margin-top:30px;">
		<form role="form" action="Index.php/index/shibie/index" method="post" enctype="multipart/form-data">
   			<div class="form-group">
   				<!-- 可从微信客户端中打开相机 -->
		        <input type="file" name="imgfile" capture="camera" accept="image/*"/>
		        <!-- <input type="file" name="imgfile"/> -->
		        <p class="help-block"><em>仅支持jpg/png格式的照片</em></p>
		        <input type="submit" class="btn btn-default" value="提交"/>
		    </div>
		</form>
	</div>
	<div class="border-div third-div"></div>
	<div class="div4">
		<p class="text-p1">注：</p>
		<p class="text-p2">*照片模糊、光线不足，有阴影，皆会影响识别度；</p>
		<p class="text-p2">*图像像素需大于960*640，名片内容请尽量充满整张照片；</p>
		<p class="text-p2">*安卓微信无法使用相机拍摄可点击右上角选择在浏览器中打开。</p>
	</div>
<script language="JavaScript">
	//禁用鼠标右键、复制 
	document.oncontextmenu=new Function("event.returnValue=false;");
	function noCopy()
	{
		alert("禁止Ctrl+C进行复制操作!"); 
		event.returnValue = false; 
	} 
	//只允许在微信内置浏览器中打开网页
	// var useragent = navigator.userAgent;
	// if (useragent.match(/MicroMessenger/i) != 'MicroMessenger') {
	//     // 这里警告框会阻塞当前页面继续加载  
	//     alert('已禁止本次访问：您必须使用微信内置浏览器访问本页面！');
	//     // 以下代码是用javascript强行关闭当前页面  
	//     var opened = window.open('about:blank', '_self');
	//     opened.opener = null;
	//     opened.close();
	// }
</script>
</body>
</html>