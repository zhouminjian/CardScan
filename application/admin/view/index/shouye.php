<html>
<head>
	<meta http-equiv="Content-Type" content="text/html" charset="utf-8">
	<meta name="keywords" content="亚东集团" /> 
	<meta name="author" content="亚东(常州)科技有限公司" /> 
	<meta name="copyright" content="版权所有" /> 
	<meta name="viewport" content="width=device-width, initial-scale=1"> 
	<link rel="stylesheet" href="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="//apps.bdimg.com/libs/jqueryui/1.10.4/css/jquery-ui.min.css">
	<link rel="stylesheet" type="text/css" href="/web/mingpian/public/css/css.css">
	<script src="http://cdn.static.runoob.com/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="http://cdn.static.runoob.com/libs/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="//apps.bdimg.com/libs/jqueryui/1.10.4/jquery-ui.min.js"></script>
	<link rel="shortcut icon" type="image/x-icon" href="/web/mingpian/public/images/Logo.ico" media="screen" />
	<title>客户信息管理系统</title>
	<style type="text/css">
		p{
			text-align:center;
		}
	</style>
</head>
<?php
echo "
	<body class='container'>
		<div class='third-div'>
			<div class='dropdown text-right''>
				<span class='dropdown-toggle' data-toggle='dropdown'>欢迎:".$_SESSION['nickname']."
			</div>
		</div>
		<div class='third-div'>
		  <div>
		  	<h2 class='text-center'>客户名片信息查询系统</h2>
		  </div>
		  <div style='margin-top:20px;'>
			<form class='form-inline' action='/web/mingpian/public/admin/Result/index?page=1' target='result-iframe' method='post'>
				<div class='form-group'>
					<input class='form-control input-time' type='text' name='searchbox' placeholder='请输入查询内容'/>
					<input class='form-control input-time' id='from' type='text' name='start_time' placeholder='起始日期'/>
					<input class='form-control input-time' id='to' type='text' name='end_time' placeholder='结束日期'/>
					<input class='form-control' class='input-submit' type='submit' name='submit' value='查询'/>
				</div>
			</form>
		  </div>
		</div>
		<div style='margin-top:20px;'>
			<iframe name='result-iframe' id='iframediv' frameborder='0' onload='changeFrameHeight()' scrolling='no' width='100%' height='100%'>
			</iframe>
		</div>
		<script>
			$(function() {
		    	$('#from').datepicker({
		    		dateFormat:'yy/mm/dd',
		    		maxDate: 0,
		    	});
		  	});
		  	$('#from').datepicker('disable').attr('readonly','readonly');
		  	$(function() {
		    	$('#to').datepicker({
		    		dateFormat:'yy/mm/dd',
		    		maxDate: 0,
		    	});
		  	});
		  	$('#to').datepicker('disable').attr('readonly','readonly');
			var o = document.getElementById('starttime');
			o.onfocus = function(){
			    this.removeAttribute('placeholder');
			}; 
			o.onblur = function(){
		    	if(this.value == '') this.setAttribute('placeholder','起始日期');
			};
			var p = document.getElementById('endtime');
			p.onfocus = function(){
			    this.removeAttribute('placeholder');
			}; 
			p.onblur = function(){
		    	if(this.value == '') this.setAttribute('placeholder','结束日期');
			};
			function changeFrameHeight(){
			    document.getElementById('iframediv').height=0;  
				document.getElementById('iframediv').height=document.getElementById('iframediv').contentWindow.document.body.scrollHeight;
			}
			window.onresize=function(){  
			    changeFrameHeight();
			}
		</script>
	</body>
";
?>
</html>