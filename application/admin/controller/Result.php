<?php
namespace application\admin\controller;

use think\Controller;
	
class Result extends Controller
{
	public function index(){
		header("Content-Type: text/html;charset=utf-8");
		error_reporting(E_ALL^E_NOTICE); 
		session_start();
		if(isset($_SESSION['openid']) && !empty($_SESSION['openid'])){
			//获取前台提交的查询条件
			$content = $_POST['searchbox'];
			$startTime = $_POST['start_time'];
			$endTime = $_POST['end_time'];
			$con = connectMysql();
			if(!$con){
				die('Could not connect: ' . mysqli_error());
			}
			mysqli_query($con,"set names 'utf8'");
			$sqlstr="select * from customerinfo where clerkid='".$_SESSION['id']."'";
			//根据搜索条件判断执行哪条sql语句
			//input框不为空
			if(!empty($content)){
				$sqlstr="select * from customerinfo where username like '%%".$content."%%' and clerkid='".$_SESSION['id']."'";
				//起始时间、结束时间不为空
				if(!empty($startTime)&&!empty($endTime)){
					$sqlstr="select * from customerinfo where username like '%%".$content."%%' and date between '".$startTime."' and '".$endTime."' and clerkid='".$_SESSION['id']."'";
				}
				//结束时间为空，起始时间不为空
				else if(!empty($startTime)&&empty($endTime)){
					$sqlstr="select * from customerinfo where username like '%%".$content."%%' and date>='".$startTime."' and clerkid='".$_SESSION['id']."'";
				}
				//结束时间不为空，起始时间为空
				else if(empty($startTime)&&!empty($endTime)){
					$sqlstr="select * from customerinfo where username like '%%".$content."%%' and date<='".$endTime."' and clerkid='".$_SESSION['id']."'";
				}
        	}
        	//起始时间、结束时间不为空
        	else if(!empty($startTime)&&!empty($endTime)){
        		//时间需要转换格式
        		$sqlstr = "select * from customerinfo where date between '".$startTime."' and '".$endTime."' and clerkid='".$_SESSION['id']."'";
        	}
        	//结束时间为空，起始时间不为空
        	else if(!empty($startTime)&&empty($endTime)){
        		$sqlstr="select * from customerinfo where date>='".$startTime."' and clerkid='".$_SESSION['id']."'";
        	}
        	//结束时间不为空，起始时间为空
        	else if(empty($startTime)&&!empty($endTime)){
        		$sqlstr="select * from customerinfo where date<='".$endTime."' and clerkid='".$_SESSION['id']."'";
        	}
        	//获取当前页的页码
        	$nowPage = $_GET['page'];
        	//第一页时需要执行查询操作
        	if($nowPage == '1'){
	        	$result = mysqli_query($con,$sqlstr);
			    mysqli_close($con);
			    $count = $result->num_rows;
			    $_SESSION['count'] = $count;
			    $i = 0;
			    while($i<=$count){
			    	$group = $result->fetch_assoc();
            		$_SESSION['result'][$i] = $group;
            		$i++;
			    }
			}
			//每页显示条数
			$pageSize = 8;
			//计算数据在session中的位置
			$startList = ((int)$nowPage-1)*$pageSize;
			//显示查询结果
        	showTemplate($startList,$pageSize);
        	//分页（一页显示$pageSize条数据）
        	if($_SESSION['count'] != 0 &&$_SESSION['count']>$pageSize){
	        	$pageCount = ceil($_SESSION['count']/$pageSize);
	        	echo "<p style='text-align:center;'><b><a href='?page=1'>首页</a>&nbsp;|
	        		  <a href='?page=".($nowPage<=1?1:$nowPage-1)."'>上一页</a>&nbsp;|
	        		  <a href='?page=".(($nowPage+1)>$pageCount?$nowPage:$nowPage+1)."'>下一页</a>&nbsp;|
	        		  <a href='?page=".$pageCount."'>尾页</a></b></p>";
        	}
		}
		else{
			messageOutput("请登陆后操作！",2);
		}
	}
}
?>