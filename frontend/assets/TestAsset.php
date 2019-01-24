<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/1/23
 * Time: 14:59
 */

namespace frontend\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/test.css',
    ];

    public $js = [
    ];
}