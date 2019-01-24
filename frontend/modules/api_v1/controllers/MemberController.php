<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2018/9/13
 * Time: 13:56
 */

namespace frontend\modules\api_v1\controllers;

use common\models\User;
use yii\web\Response;
use frontend\controllers\ApiController;
use Yii;
use Alipay\AopClient;
use Yansongda\Pay\Pay;
use console\Job\Send;

class MemberController extends ApiController
{
    public $allow = ['login','user','miss','weixinpay','sendfile','test'];
    public $modelClass = 'common\models\User';
    protected $config = [
        'wechat' => [
            'appid' => 'wx6c1624ae953dbc08',
            'mch_id' => '1500930281',
            'notify_url' => 'http://yansongda.cn/wechat_notify.php',
            'key'=> 'enfbnbgwbwasbxoiwhyopjanizyhrwjl',
        ],
    ];

    public function behaviors() {
        $behaviors = parent::behaviors();
        //$behaviors['contentNegotiator']['formats']['text/html'] = Response::FORMAT_JSON;
        return $behaviors;
    }

    public function actionTest(){
//        var_dump(Yii::$app->request->getHeaders()->get('Authorization'));
//        var_dump($_COOKIE['Authorization']);
//        exit;
        $model = User::findOne(['uid'=>'1']);
        //return Yii::$app->getUser()->getId()?$model:0;
        return $model;
    }

    public function actionLogin(){
        $user = User::findOne(['uid'=>1]);
        //$user->refreshToken();
        $jwt = $user->getJWT();
        setcookie('Authorization', 'Bearer ' . $jwt, time() + 86400 * 365, '/', Yii::$app->request->serverName);
        //var_dump($_COOKIE);
        return $jwt;
    }

    public function actionUser(){
        var_dump(Yii::$app->request);
        return 1;
    }

    public function actionMiss(){
        $keyPair = \Alipay\Key\AlipayKeyPair::create(
            Yii::$app->params['alisecret'] ,
            Yii::$app->params['alipublic']
);
        $aop = new AopClient(Yii::$app->params['appid'],$keyPair);
        $appRequest = (new \Alipay\AlipayRequestFactory)->create('AlipayTradeAppPayRequest', [
        ]);
        $appRequest->setNotifyUrl('qwe');
    }

    public function actionWeixinpay(){
        $config_biz = [
            'out_trade_no' => 'e2',
            'total_fee' => '1',
            'body' => 'test body',
            'spbill_create_ip' => '8.8.8.8',
        ];
        $pay = new Pay($this->config);
        return $pay->driver('wechat')->gateway('app')->pay($config_biz);
    }

    public function actionSendfile(){
        \Yii::$app->queue->pushOn(new Send(),['email'=>'49783121@qq.com','title'=>'test','content'=>'email test'],'email');
    }
}