<?php
namespace application\admin\controller;
use think\Controller;

class Redirurl extends controller
{
	public function index()
	{
		//公众号的appid和secret
		$appid  = '你的appid';
		$secret = '你的secret';
		session_start();
		//是否已经接收过code flase则未接收过
		if(empty($_SESSION['code'])&&!isset($_SESSION['code'])){
			if(isset($_GET['code'])){
				$_SESSION['code'] = $_GET["code"];
			}
			else{
				messageOutput("请从亚东集团公众号底部菜单进入!",2);
				exit();
			}
		}
		//第一步:取全局access_token
		if(empty($_SESSION['token'])&&!isset($_SESSION['token'])){
			$url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=$appid&secret=$secret";
			$token = getJson($url);
			$_SESSION['token'] = $token["access_token"];
		}
		//第二步:取得openid
		if(empty($_SESSION['oauth2'])&&!isset($_SESSION['oauth2'])){
			$oauth2Url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=".$_SESSION['code']."&grant_type=authorization_code";
			$oauth2 = getJson($oauth2Url);
			$_SESSION['oauth2'] = $oauth2['openid'];
		}
		//第三步:根据全局access_token和openid查询用户信息  
		$access_token = $_SESSION['token'];  
		//判断session中是否存在openid，存在则表示已登陆过
		if(empty($_SESSION['openid'])){
			$openid = $_SESSION['oauth2'];  
			$get_user_info_url = "https://api.weixin.qq.com/cgi-bin/user/info?access_token=$access_token&openid=$openid&lang=zh_CN";
			$userinfo = getJson($get_user_info_url);
			$openid = (string)$userinfo['openid'];
			$sqlstr = "select * from administrator where openid='".$openid."';";
			//查询是否存在
			$result = doForSql($sqlstr);			
			//取id
			if($result->num_rows){
				$group = $result->fetch_assoc();
				$_SESSION['id'] = $group['id'];
			}
			else{
				//先将openid写入数据库
				$sqlstr = "insert into administrator(openid) values('".$openid."'); ";
				doForSql($sqlstr);	
				$sqlstr = "select id from administrator where openid='".$openid."';"; 
				$result = doForSql($sqlstr);			
				//取该openid在数据库中对应的id
				if($result->num_rows){
					$group = $result->fetch_assoc();
					$_SESSION['id'] = $group['id'];
				}
			}
			//用户信息存入session中
			$_SESSION['openid'] = $userinfo['openid'];
			$_SESSION['nickname'] = $userinfo['nickname'];
		}
		include "../application/admin/view/index/shouye.php";
	}
}
?>