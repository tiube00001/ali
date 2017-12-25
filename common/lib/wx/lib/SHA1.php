<?php

namespace wx\lib;


/**
 * SHA1 class
 *
 * 计算公众平台的消息签名接口.
 */
class SHA1
{

    /**
     * 用SHA1算法生成安全签名
     * @param $token
     * @param $timestamp
     * @param $nonce
     * @param $encrypt_msg
     * @return array
     */
	public function getSHA1($token, $timestamp, $nonce, $encrypt_msg)
	{
		//排序
		try {
			$array = array($encrypt_msg, $token, $timestamp, $nonce);
			sort($array, SORT_STRING);
			$str = implode($array);
			return array(ErrorCode::$OK, sha1($str));
		} catch (Exception $e) {
			//print $e . "\n";
			return array(ErrorCode::$ComputeSignatureError, null);
		}
	}

}


?>