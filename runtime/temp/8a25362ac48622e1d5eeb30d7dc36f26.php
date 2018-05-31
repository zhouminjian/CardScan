<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:41:"../application/admin/view/index/index.php";i:1526453268;}*/ ?>
<?php
//清除之前session中的内容
session_start();
session_destroy();
$appid = 'wxb2a8cc0df3403d98';
$redirectUrl = urlencode("http://wx.yadongtextile.com/web/mingpian/public/admin/Redirurl/index");
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
header("Location:" . $url);
?>