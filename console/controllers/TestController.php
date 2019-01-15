<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/1/14
 * Time: 14:47
 */

namespace console\controllers;

use shmilyzxt\queue\Worker;

class TestController extends \yii\console\Controller
{
    public function actionListen($queueName='default',$attempt=10,$memeory=128,$sleep=3 ,$delay=0){
        Worker::listen(\Yii::$app->queue,$queueName,$attempt,$memeory,$sleep,$delay);
    }
}