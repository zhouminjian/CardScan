<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:42:"../application/index/view/index/index1.php";i:1526087241;}*/ ?>
<?php
	$appid = 'wxb2a8cc0df3403d98';
	// $redirectUrl = urlencode("http://wx.yadongtextile.com/web/mingpian/public/Index.php/index/Redirurl/index");
	$redirectUrl = urlencode("http://wx.yadongtextile.com/web/mingpian/public/index.php");
	$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
	header("Location:" . $url);
?>