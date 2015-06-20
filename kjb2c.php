<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
include_once(ROOT_PATH .'includes/cls_json.php');
$json = new JSON();
$code = trim($_GET['code']);
if(empty($code) )
{
	show_message("code为空，返回错误");
}




$url = sprintf("http://trainer.kjb2c.com/oauth/oauth!gettoken.do?grant_type=authorization_code&client_id=%s&client_secret=%s&code=%s&state=test&format=json", $GLOBALS['_CFG']['kjb2c_id'], $GLOBALS['_CFG']['kjb2c_secret'], $code);
$str = curl_grab($url);



if(!empty($str) )
{
	$ckarr = $json->decode($str, 1);
	$uname = $_SESSION['user_name'];
	if('T' == $ckarr['result'])
	{
		$access_token = $ckarr['access_token'];
		$kjb2c_user_id = $ckarr['kjb2c_user_id'];
		$ts = local_date('Y-m-d H:i:s', gmtime() );
		$url_ts = urlencode($ts);
		$bind_url = sprintf("http://trainer.kjb2c.com/oauth/oauth!bind.do?kjb2c_user_id=%s&account=%s&userid=%s&timestamp=%s&sign=%s&format=json", $kjb2c_user_id, $uname, $GLOBALS['_CFG']['kjb2c_id'], $url_ts, md5($kjb2c_user_id.$uname.$GLOBALS['_CFG']['kjb2c_id'].$GLOBALS['_CFG']['kjb2c_secret'].$ts) );
		print($bind_url);
		die();
		$str = curl_grab($bind_url);
		$ckarr = $json->decode($str, 1);
		if('T' == $ckarr['result'])
		{
			//绑定成功
			$GLOBALS['db']->query("update ".$GLOBALS['ecs']->table("users")." set kjb2c_binded='1' where user_id='".$_SESSION['user_id']."'");
			show_message("成功绑定", "会员中心", "user.php", 'info', true);
		}
		else
		{
			show_message("请先登录再绑定", "会员登录", "user.php", 'info', true);
		}
	}
}