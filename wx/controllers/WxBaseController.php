<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/12/25 0025
 * Time: 13:15
 */
namespace wx\controllers;

use yii\web\Controller;

use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class WxBaseController extends Controller
{
    public function behaviors()
    {
        return [];
        /*return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];*/
    }

}