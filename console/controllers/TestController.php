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
            $sql = "SELECT * FROM " . TableTitleRelation::tableName() . " WHERE status = :status ORDER BY id ASC LIMIT $offset, $limit";

            $offset += $limit;

            $data_reader = Yii::$app->db_console->createCommand($sql)->bindValues([
                ':status' => 1,
            ])->query();

            if ($data_reader->count() > 0) {
                while ($title = $data_reader->read()) {
                    if($title['expired_at'<time()]){
                        Yii::$app->db->createCommand("UPDATE " . TableTitleRelation::tableName() . " SET status=:status WHERE id=:id")->bindValues([
                            ':status' => 2,
                            ':id' => $title['id'],
                        ])->execute();
                        \Yii::$app->memberRemind->sendVerificationMessage($title['uid'], [
                            'title' => '称号变更',
                            'content' => '您的称号已到期'
                        ]);
                    }
                }
                sleep(10);
            } else {
                sleep(86400);
                $offset = 0;
            }
        }
    }
}