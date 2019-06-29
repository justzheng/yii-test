<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/1/14
 * Time: 14:47
 */

namespace console\controllers;

use shmilyzxt\queue\Worker;
use common\modelsext\TableTitleRelation;
use Yii;
use console\Job\Test;

class TestController extends \yii\console\Controller
{
    public function actionListen($queueName='email',$attempt=10,$memeory=128,$sleep=3 ,$delay=0){
        Worker::listen(\Yii::$app->queue,$queueName,$attempt,$memeory,$sleep,$delay);
    }

    public function actionRemid()
    {
        $offset = 0;
        $limit = 1000;

        while (true) {
            sleep(1);
            Yii::$app->commonQueue->push(new Test());
//            if(time()>1561706000){
//                echo "123";
//            }else{
//                sleep(1);
//            }
//            $sql = "SELECT * FROM " . TableTitleRelation::tableName() . " WHERE status = :status ORDER BY id ASC LIMIT $offset, $limit";
//
//            $offset += $limit;
//
//            $data_reader = Yii::$app->db->createCommand($sql)->bindValues([
//                ':status' => 1,
//            ])->query();
//
//            if ($data_reader->count() > 0) {
//                while ($title = $data_reader->read()) {
//                    if($title['expired_at']<time()){
//                        Yii::$app->db->createCommand("UPDATE " . TableTitleRelation::tableName() . " SET status=:status WHERE id=:id")->bindValues([
//                            ':status' => 2,
//                            ':id' => $title['id'],
//                        ])->execute();
////                        \Yii::$app->memberRemind->sendVerificationMessage($title['uid'], [
////                            'title' => '称号变更',
////                            'content' => '您的称号已到期'
////                        ]);
//                    }
//                }
//                sleep(10);
//            } else {
//                sleep(10);
//                $offset = 0;
//            }
//            sleep(10);
        }
    }
}