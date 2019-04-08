<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/2/21
 * Time: 16:59
 */
namespace backend\extensions;

class Common{

    public static function game($event){
        echo $event->gameName;
    }
}
?>
