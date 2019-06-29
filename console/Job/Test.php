<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/6/29
 * Time: 10:50
 */

namespace console\Job;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

class Test extends BaseObject implements \yii\queue\JobInterface
{

    public function execute($queue)
    {
        file_put_contents('/var/www/html/1.log', 'asd',FILE_APPEND);
    }
}