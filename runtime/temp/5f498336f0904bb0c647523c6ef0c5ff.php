<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:41:"../application/index/view/index/index.php";i:1526376925;}*/ ?>
<?php
//清除之前session中的内容
session_start();
session_destroy();
$appid = 'wxb2a8cc0df3403d98';
$redirectUrl = urlencode("http://wx.yadongtextile.com/web/mingpian/public/Index.php/index/Redirurl/index");
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
header("Location:" . $url);
?>