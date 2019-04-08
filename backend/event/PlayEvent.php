<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/2/22
 * Time: 9:20
 */
namespace backend\event;

use yii\base\Event;

class PlayEvent extends Event
{
    public $gameName;
}