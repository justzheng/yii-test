<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/7/17
 * Time: 15:32
 */

namespace console\Job;

use yii\base\BaseObject;
use yii\queue\JobInterface;
use Yii;

class Test2 extends BaseObject implements \yii\queue\JobInterface
{
    public function execute($queue)
    {
        file_put_contents('/var/www/html/2.log', 'zxc',FILE_APPEND);
    }
}