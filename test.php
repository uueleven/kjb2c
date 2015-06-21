<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
include_once(ROOT_PATH."includes/lib_order.php");
//kjb2c_record_user('ecshop');
//kjb2c_send_order(22);
$txt = file_get_contents(ROOT_PATH."invoice.txt");
preg_match_all('/￥(\d+)/si', $txt, $matches);
print(array_sum($matches[1]) );
print('test');										 asdfasdfasfsadfasdf