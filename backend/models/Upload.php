<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/5/9
 * Time: 9:29
 */

namespace backend\models;

use Yii;
use yii\base\Model;

class Upload extends Model
{
    public $file;
    public function rules(){
        return [
            [['file'], 'file', 'extensions' => 'xls'],
        ];
    }
    public function attributeLabels(){
        return [
            'file'=>'文件上传'
        ];
    }
}