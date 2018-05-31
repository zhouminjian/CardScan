<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:48:"../application/admin_backup/view/index/index.php";i:1511747620;}*/ ?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="keywords" content="亚东集团" /> 
	<meta name="author" content="亚东(常州)科技有限公司" /> 
	<meta name="copyright" content="版权所有" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/web/mingpian/public/css/css.css">
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="/web/mingpian/public/images/Logo.ico" media="screen" />
	<title>客户信息管理系统</title>
	<style type="text/css">
		p{
			text-align:center;
		}
	</style>
</head>
<?php
session_start(); 
if(empty($_SESSION['account'])){
	echo "<body class='container'>
			<h3 class='text-center'>管理员登陆</h3>
			<div class='third-div'>
				<form class='form-horizontal' action='admin/Login/index' method='post'>
					<div class='form-group'>
						<label class='col-sm-5 control-label'>帐号</label>
						<div class='col-sm-2'>
							<input class='form-control' type='text' name='account'>
						</div>
					</div>
					<div class='form-group'>
						<label class='col-sm-5 control-label'>密码</label>
						<div class='col-sm-2'>
							<input class='form-control' type='password' name='password'>
						</div>
					</div>
					<div class='text-center'>
						<input class='btn btn-default' type='submit' value='登陆' />
					</div>
				</form>
			</div>
		  </body>";
}
else{
	echo "
		<body class='container'>
			<div class='third-div'>
				<div class='dropdown text-right''>
					<span class='dropdown-toggle' data-toggle='dropdown'>".$_SESSION['user_group']."
					<b class='caret'></b></span>
					<ul class='dropdown-menu pull-right' style='min-width:100px;'>
				  		<li>
				  			<a href='/web/mingpian/public/admin/Info/index'>密码修改</a>
				  		</li>
				  		<li>
				  			<a href='/web/mingpian/public/admin/Logout/index'>退出</a>
				  		</li>
					</ul>
				</div>
			</div>
			<div class='third-div'>
			  <div>
			  	<h2 class='text-center'>客户名片信息查询系统</h2>
			  </div>
			  <div style='margin-top:20px;'>
				<form class='form-inline' action='/web/mingpian/public/admin/Result/index?page=1' target='result-iframe' method='post'>
					<div class='form-group'>
						<input class='form-control' type='text' name='searchbox' placeholder='请输入查询内容'/>
						<input class='form-control' type='date' name='start_time' placeholder='起始日期'/>
						<input class='form-control' type='date' name='end_time' placeholder='结束日期'/>
						<input class='form-control' class='input-submit' type='submit' name='submit' value='查询'/>
					</div>
				</form>
			  </div>
			</div>
			<div style='margin-top:20px;'>
				<iframe name='result-iframe' frameborder='0' width='100%' height='100%'>
				</iframe>
			</div>
		</body>
	";
}
?>
</html>