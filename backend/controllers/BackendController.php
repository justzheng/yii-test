<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2019/7/12
 * Time: 16:05
 */

namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

class BackendController extends Controller
{
//    public function init()
//    {
//        parent::init(); // TODO: Change the autogenerated stub
//        if(Yii::$app->user->isGuest){
//            return $this->redirect('/site/login');
//        }
//    }
}