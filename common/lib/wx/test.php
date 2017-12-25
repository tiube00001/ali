<?php
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2017/12/25
 * Time: 22:00
 */


require 'WxAPI.php';

// 第三方发送消息给公众平台
$encodingAesKey = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFG";
$token = "pamtest";
$timeStamp = "1409304348";
$nonce = "xxxxxx";
$appId = "wxb11529c136998cb6";


$text = "<xml><ToUserName><![CDATA[oia2Tj我是中文jewbmiOUlr6X-1crbLOvLw]]></ToUserName><FromUserName><![CDATA[gh_7f083739789a]]></FromUserName><CreateTime>1407743423</CreateTime><MsgType><![CDATA[video]]></MsgType><Video><MediaId><![CDATA[eYJ1MbwPRJtOvIEabaxHs7TX2D-HV71s79GUxqdUkjm6Gs2Ed1KF3ulAOA9H1xG0]]></MediaId><Title><![CDATA[testCallBackReplyVideo]]></Title><Description><![CDATA[testCallBackReplyVideo]]></Description></Video></xml>";


$wx = new \wx\WxAPI($token, $encodingAesKey, $appId);

//微信加密
$str = $wx->encryptMsg($text, $timeStamp, $nonce);

//微信解密
$now = $wx->decryptMsg($str, $timeStamp, $nonce);