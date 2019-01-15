<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/1/14
 * Time: 15:45
 */

namespace console\Job;

use shmilyzxt\queue\base\JobHandler;
use Yii;

class Send extends JobHandler
{

    /**
     * 从队列中拿到任务和相关数据后，需要对任务进行处理
     * @param  $job
     */
    public function handle($job, $data)
    {
        Yii::warning('error','rpcerror');
        // TODO: Implement handle() method.
    }

    public function failed($job,$data)
    {
        Yii::warning('error','rpcerror');
        die("发了3次都失败了，算了");
    }

}