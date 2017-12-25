<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 13:30
 */

namespace wx\controllers;

use Yii;
class WxNewsController extends WxBaseController
{
    public function actionNews()
    {

        exit(Yii::$app->getRequest()->get('echostr'));

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
}