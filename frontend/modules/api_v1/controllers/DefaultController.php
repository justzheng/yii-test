<?php

namespace frontend\modules\api_v1\controllers;

use yii\web\Controller;
use yii\web\Response;
use Yii;
use frontend\controllers\ApiController;

/**
 * Default controller for the `v1` module
 */
class DefaultController extends ApiController
{
    //public $allow = ['index'];
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 1;
        $data ='12313';
//        return $this->success([
//            'data' => $data,
//        ]);
    }
}
