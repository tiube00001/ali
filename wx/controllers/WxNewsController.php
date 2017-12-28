<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 13:30
 */

namespace wx\controllers;

use common\models\Video;
use Yii;

use wx\WxAPI;

class WxNewsController extends WxBaseController
{

    public function actionNews()
    {

        //微信验证
        //exit(Yii::$app->getRequest()->get('echostr'));
        $config = Yii::$app->params['wx'];

        $wx = new WxAPI($config['token'], $config['encodingAesKey'], $config['appId']);

        $xml = file_get_contents('php://input');
        $nonce = Yii::$app->getRequest()->get('nonce');
        $timestamp = Yii::$app->getRequest()->get('timestamp');

        try {
            //$xml = $wx->decryptMsg($xml, $nonce, $timestamp);

            $xmlObj = simplexml_load_string($xml);

            if ((string)$xmlObj->MsgType == 'text') {
                $content = (string)$xmlObj->Content;

                $data = Video::find()
                    ->select('url')
                    ->where(['like', 'name', $content])->asArray()->column();

                if ($data) {
                    $returnText = str_replace('_|_', "", implode(",\n\n", $data));
                } else {
                    $returnText = '暂无此资源';
                }

                $fan = (string)$xmlObj->FromUserName;
                $public = (string)$xmlObj->ToUserName;
                $createTime = time();


                $temp = " <xml><ToUserName><![CDATA[%s]]></ToUserName><FromUserName><![CDATA[%s]]></FromUserName><CreateTime>%s</CreateTime><MsgType><![CDATA[text]]></MsgType><Content><![CDATA[%s]]></Content></xml>";


                $str =sprintf($temp, $fan, $public, time(), $returnText);

//                $str = $wx->encryptMsg($str, time(), $nonce);
                Yii::info($str, 'wxNews');

                echo $str;exit;

            }


        } catch (\Exception $exception) {
            Yii::info($exception->getMessage(), 'wxNews');
        }

    }

    private function checkSignature()
    {
        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];

        $token = Yii::$app->params['wx']['token'];

        $tmpArr = array($token, $timestamp, $nonce);

        $tmpStr = implode( $tmpArr );

        $tmpStr = sha1( $tmpStr );

        if( $tmpStr == $signature ){
            return true;
        }else{
            return false;
        }
    }

    public function actionTest()
    {
        $curl = curl_init();

        phpinfo();

        exit;
        var_dump($curl);

        exit;
        $config = Yii::$app->params['wx'];

        $wx = new WxAPI($config['token'], $config['encodingAesKey'], $config['appId']);

        $str = '123';
        $nonce = 'test';
        $aaa = $wx->encryptMsg($str, time(), $nonce);

        var_dump($aaa);
    }
}