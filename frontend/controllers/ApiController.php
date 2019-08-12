<?php
/**
 * Created by PhpStorm.
 * User: cyr
 * Date: 2018/9/13
 * Time: 11:03
 */

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\Response;
use yii\web\UnauthorizedHttpException;
use yii\web\HttpException;


class ApiController extends \yii\rest\ActiveController
{
    public $allow = [];
    public function beforeAction($action)
    {
        if (parent::beforeAction($action)) {
            $authHeader = Yii::$app->request->getHeaders()->get('Authorization');
            if (empty($authHeader)) {
                $authHeader = ArrayHelper::getValue($_COOKIE,'Authorization','');
            }
            if ($authHeader !== null && preg_match('/^Bearer\s+(.*?)$/', $authHeader, $matches)) {
                $identity = Yii::$app->user->loginByAccessToken($matches[1]);
                if ($identity === null && !in_array($action->id, $this->allow)) {
//                    echo json_encode([
//                        'status' => 401,
//                        'data' => null,
//                        'error' => '',
//                    ]);
//
//                    return false;
                    throw new UnauthorizedHttpException('You are requesting with an invalid credential.');
                } elseif ($identity !== null && $identity->is_frozen == 2) {
                    echo json_encode([
                        'status' => 400,
                        'data' => null,
                        'error' => '您的账号已经被管理员冻结。',
                    ]);

                    return false;
                }
            } else {
                if (!in_array($action->id, $this->allow)) {
//                    echo json_encode([
//                        'status' => 401,
//                        'data' => null,
//                        'error' => '',
//                    ]);
//
//                    return false;
                    throw new UnauthorizedHttpException('You are requesting with an invalid credential.');
                }
            }
        } else {
            return false;
        }

        return true;
    }

    public function success($data = null)
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        return [
            'status' => true,
            'code' => 200,
            'msg' => '',
            'data' => $data
        ];
    }

    public function fail($errorMessage, $errorCode = 9999)
    {
        Yii::$app->response->format = yii\web\Response::FORMAT_JSON;
        return [
            'status' => false,
            'code' => $errorCode,
            'msg' => $errorMessage,
            'data' => null
        ];
    }
}