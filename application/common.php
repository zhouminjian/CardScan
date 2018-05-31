<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
 
//返回消息并跳转
function messageOutput($message,$num=1){
    echo "<script language=\"JavaScript\">alert(\"".$message."\");</script>";
    switch ($num) {
    	case 1:
        //名片识别首页（已登陆过）
    		$url = "http://wx.yadongtextile.com/web/mingpian/public/Index.php/index/Redirurl/index";  
    		break;
    	case 2:
        //后台管理首页（检测到未登陆）
    		$url = "http://wx.yadongtextile.com/web/mingpian/public/admin";  
    		break;
        // case 3:
        // //管理员信息页面
        //     $url = "http://wx.yadongtextile.com/web/mingpian/public/admin/Info/index";
        //     break;
        case 4:
        //名片识别首页（检测未登陆）
            $url = "http://wx.yadongtextile.com/web/mingpian/public";  
            break;
    }
    echo "<script language='javascript' type='text/javascript'>";  
    echo "window.location.href='$url'";  
    echo "</script>";  
}

//连接数据库
function connectMysql(){
    //主机，数据库账号，密码，数据库名
	$con = mysqli_connect("127.0.0.1","root","root","yadongtextile");
    return $con;
}
//获取登陆json
function getJson($url){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE); 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
    return json_decode($output, true);
}
//执行数据库操作
function doForSql($sqlstr){
    //连接数据库
    $con = connectMysql();
    if(!$con){
        die('Could not connect: ' . mysqli_error());
    }
    mysqli_query($con,"set names 'utf8'");
    $result = mysqli_query($con,$sqlstr);
    mysqli_close($con);
    return $result;
}
//按钮
function buttonInfo(){
	$url = "http://wx.yadongtextile.com/web/mingpian/public/Index.php/index/Redirurl/index"; 
	//location.href=\"$url\" 返回首页链接
	echo "<p align='center'><input class=\"btn btn-default\" type='submit' name='Submit' value='确定'/>
	<input class=\"btn btn-default\" type='button' name='Submit' value='取消' onclick='location.href=\"$url\"'/></p>";
}

//数据存储
function judgeEmpty($sz){
	if(count($sz)===0)
		return '';
	else
		return $sz[0];
}

//显示搜索结果
function showTemplate($startList,$pageSize){
    echo "<meta name=\"viewport\" content=\"width=device-width, initial-scale=1\"> 
    <link rel=\"stylesheet\" type=\"text/css\" href=\"/web/mingpian/public/css/css.css\">
        <link rel=\"stylesheet\" href=\"http://cdn.static.runoob.com/libs/bootstrap/3.3.7/css/bootstrap.min.css\">
        <link rel=\"shortcut icon\" type=\"image/x-icon\" href=\"/web/mingpian/public/images/Logo.ico\" media=\"screen\" />
        <script src=\"/web/mingpian/public/js/jump.js\"></script>
        ";
    session_start();
    $count = $_SESSION['count'];
    //判断记录是否为0
    if($count==0){
        echo "<h3 class='text-center text-danger'>查询结果为空！╮(╯▽╰)╭</h3>";
    }else{
        echo " <div>
                <ul class='reul'>";
        $startListEnd = $startList+$pageSize;
        while($startList<$count&&$startList<$startListEnd){
            echo "
                <li>
                    姓名：".$_SESSION['result'][$startList]['username']."<br>
                    电话：".$_SESSION['result'][$startList]['telephone']."<br>
                    手机：".$_SESSION['result'][$startList]['mobile']."<br>
                    传真：".$_SESSION['result'][$startList]['fax']."<br>
                    邮箱：".$_SESSION['result'][$startList]['email']."<br>
                    公司：".$_SESSION['result'][$startList]['comp']."<br>
                    地址：".$_SESSION['result'][$startList]['addr']."<br>
                    <a href=\"javascript:void(0);\" onclick=\"showpicture('".$_SESSION['result'][$startList]['uri']."');\">查看图片</a>
                </li>
            ";
            $startList++;
        }
        echo "</ul>
          </div>";
    }
}
?>