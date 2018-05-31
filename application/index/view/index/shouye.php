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
	<link rel="stylesheet" type="text/css" href="../../../css/css.css">
	<link rel="shortcut icon" type="image/x-icon" href="../../../images/Logo.ico" media="screen" />
	<title>名片识别</title>
</head>
<body oncopy = "noCopy()" class="container">
	<!-- 标题 -->
	<div class="text-center row third-div">
		<div class="column">
			<img class="logo" src="../../../images/Logo.png"> 
			<span class="title-span">亚东名片识别</span>
		</div>
	</div>
	<!-- 文件上传区域 -->
	<div style="margin-top:30px;">
		<form role="form" action="../../../Index.php/index/shibie/index" method="post" onsubmit="return checkfile();" enctype="multipart/form-data">
   			<div class="form-group">
   				<div class="bwimg">
	   				<!-- 上传图片预览 -->
	   				<img id="scanImg"/>
	   				<div id="scanDiv"></div>
   				</div>
   				<div class="dealImg">
	   				<!-- 从微信客户端中打开相机 -->
	   				<span class="fileinput-button btn btn-default">
	   					<span>拍照</span>
		        		<input type="file"  onchange="UploadImg(this);" id="fileID" name="imgfile" accept="image/png, image/jpeg"/>
		        		<!-- <input type="file"  onchange="UploadImg(this);" id="fileID" name="imgfile" capture="camera" accept="image/*"/> -->
		        	</span>
		        	<input type="submit" class="btn btn-default" value="识别"/>
		    	</div>
		    </div>
		</form>
	</div>
	<div class="border-div third-div"></div>
	<div class="div4">
		<p class="text-p1">注：</p>
		<p class="text-p2">*仅支持jpeg/png格式的照片；</p>
		<p class="text-p2">*请先拍摄名片，预览后再进行识别；</p>
		<p class="text-p2">*照片模糊、光线不足，有阴影，皆会影响识别度，图像像素需大于960*640，名片内容请尽量充满整张照片；</p>
		<p class="text-p2">*如有其他问题请与公众号"亚东集团"联系。</p>
	</div>
<script language="JavaScript">
	//禁用鼠标右键、复制 
	document.oncontextmenu=new Function("event.returnValue=false;");
	function noCopy()
	{
		alert("禁止Ctrl+C进行复制操作!"); 
		event.returnValue = false; 
	} 
	function checkfile(){
	   	if(document.getElementById("fileID").value==""){
	        alert("请先拍照或上传照片!");
	        return false;
	    }
	    return true;
   	}
   	//判断浏览器是否支持FileReader接口
    if (typeof FileReader == 'undefined') {
        document.getElementById("scanDiv").InnerHTML = "<h1>当前浏览器不支持预览上传图片功能！</h1>";
        //使选择控件不可操作
        document.getElementById("fileID").setAttribute("disabled", "disabled");
    }
    //选择图片，马上预览
    function UploadImg(obj) {
        var file = obj.files[0];
        
        console.log(obj);console.log(file);
        console.log("file.size = " + file.size);  //file.size 单位为byte

        var reader = new FileReader();

        //读取文件过程方法
        reader.onloadstart = function (e) {
            console.log("开始读取....");
        }
        reader.onprogress = function (e) {
            console.log("正在读取中....");
        }
        reader.onabort = function (e) {
            console.log("中断读取....");
        }
        reader.onerror = function (e) {
            console.log("读取异常....");
        }
        reader.onload = function (e) {
            console.log("成功读取....");
            var img = document.getElementById("scanImg");
            img.src = e.target.result;
            //或者 img.src = this.result;  //e.target == this
        }
        reader.readAsDataURL(file);
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