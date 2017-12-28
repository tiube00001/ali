<?php
/**
 * Created by PhpStorm.
 * User: yanghailong
 * Date: 2017/12/25
 * Time: 21:35
 */

namespace wx;

use wx\lib\WXBizMsgCrypt;

class WxAPI
{
    protected $token;
    protected $encodingAesKey;
    protected $appId;

    protected $_wxBizMsgCrypt;

    public function getWxBizMsgCrypt()
    {
        if ($this->_wxBizMsgCrypt == null) {
            $this->_wxBizMsgCrypt = new WXBizMsgCrypt($this->token, $this->encodingAesKey, $this->appId);
        }

        return $this->_wxBizMsgCrypt;
    }

    public function __construct($token, $encodingAesKey, $appId)
    {
        $this->token = $token;
        $this->encodingAesKey = $encodingAesKey;
        $this->appId = $appId;


        //注册自动加载函数
        spl_autoload_register(function($class) {
            $dir = dirname(dirname(__FILE__));

            $file = $dir.'/'.str_replace('\\', '/', $class).'.php';

            if (is_file($file)) {
                require $file;
            } else {
                throw new \Exception('class missing:'.$class);
            }

        });

    }

    public function decryptMsg($xml, $timestamp, $nonce)
    {
        $xml_tree = new \DOMDocument();
        $xml_tree->loadXML($xml);

        $array_e = $xml_tree->getElementsByTagName('Encrypt');
        $array_s = $xml_tree->getElementsByTagName('MsgSignature');

        $encrypt = $array_e->item(0)->nodeValue;
        $msgSign = $array_s->item(0)->nodeValue;

        $format = "<xml><ToUserName><![CDATA[toUser]]></ToUserName><Encrypt><![CDATA[%s]]></Encrypt></xml>";
        $from_xml = sprintf($format, $encrypt);

        // 第三方收到公众号平台发送的消息
        $msg = '';
        $pc = $this->getWxBizMsgCrypt();

        $errCode = $pc->decryptMsg($msgSign, $timestamp, $nonce, $from_xml, $msg);

        if ($errCode == 0) {
            return $msg;
        } else {
            throw new \Exception('wx decrypt error code :'.$errCode);
        }
    }

    public function encryptMsg($text, $timestamp, $nonce)
    {
        $pc = $this->getWxBizMsgCrypt();

        $encryptMsg = '';
        $errCode = $pc->encryptMsg($text, $timestamp, $nonce, $encryptMsg);
        if ($errCode == 0) {
            return $encryptMsg;
        } else {
            throw new \Exception('wx encrypt error code:'.$errCode);
        }
    }

}