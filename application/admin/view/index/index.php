<?php
//清除之前session中的内容
session_start();
session_destroy();
$appid = '公众号的appid';
$redirectUrl = urlencode("http://wx.yadongtextile.com/web/mingpian/public/admin/Redirurl/index");
$url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=' . $appid . '&redirect_uri=' . $redirectUrl . '&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect';
header("Location:" . $url);
?>