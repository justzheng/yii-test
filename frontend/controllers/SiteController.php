<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\base\UserException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use yii\rest\ActiveController;
use yii\web\HttpException;
use common\service\UserService;
use Hprose\Socket\Server;
use Hprose\Socket\Client;
use Hprose\InvokeSettings;
use Hprose\ResultMode;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends Controller
{
    public $enableCsrfValidation = false;
//public $layout = false;
    /**
     * {@inheritdoc}
     */
//    public function behaviors()
//    {
//        return [
//            'access' => [
//                'class' => AccessControl::className(),
//                //'only' => ['logout', 'signup','index'],
//                'rules' => [
//                    [
//                        'actions' => ['signup','error','index'],
//                        'allow' => true,
//                        'roles' => ['?'],
//                    ],
//                    [
//                        'actions' => ['logout'],
//                        'allow' => true,
//                        'roles' => ['@'],
//                    ],
//                ],
//            ],
//            'verbs' => [
//                'class' => VerbFilter::className(),
//                'actions' => [
//                    'logout' => ['post'],
//                ],
//            ],
//        ];
//    }


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index',['status' => '123', 'error' => '', 'data' => '123']);
    }

    public function actionTest()
    {
        return $this->render('test');
    }

    public function actionError()
    {
//        return false;
//        echo "123";
//        $this->layout = false;
//        Yii::warning('error','rpcerror');
        if (($exception = Yii::$app->getErrorHandler()->exception) === null) {
            // action has been invoked not from error handler, but by direct route, so we display '404 Not Found'
            $exception = new HttpException(404, Yii::t('yii', 'Page not found.'));
        }

        if ($exception instanceof HttpException) {
            $status = $exception->statusCode;
            $error = $exception->getName();
        } else {
            $status = $exception->getCode();
            $error = $exception->getMessage();
        }
        $contenttype = Yii::$app->request->getAcceptableContentTypes();
        if ($contenttype != 'text/html') {
//        }
//        if(stripos($contenttype,"application")!==false){
            Yii::$app->response->format = Response::FORMAT_JSON;
            $data = ['status' => $status, 'data' => '', 'error' => $error];
            return $data;
//            return $this->render('error',['status'=>$status,'error'=>$error,'data' => '']);
        }else{
            if($status==401){
                return $this->render("error");
            }

            return $this->render('error',['status'=>$status,'error'=>$error]);
        }
    }

    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
        if ($model->load(Yii::$app->request->post())) {
            if ($user = $model->signup()) {
                if (Yii::$app->getUser()->login($user)) {
                    return $this->goHome();
                }
            }
        }

        return $this->render('signup', [
            'model' => $model,
        ]);
    }

    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail()) {
                Yii::$app->session->setFlash('success', 'Check your email for further instructions.');

                return $this->goHome();
            } else {
                Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
            }
        }

        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }

    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }

        if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');

            return $this->goHome();
        }

        return $this->render('resetPassword', [
            'model' => $model,
        ]);
    }

    /**
     * 用户服务
     * @return mixed
     */
    public function actionUser() {
            /**
             * @desc http
             */
//        $service = new UserService();
//        $server = new Server();
////        var_dump($server);
//        $server->addInstanceMethods($service);
//
//        return $server->start();
        /**
         * @desc tcp
         */
        $service = new UserService();
        $server = new Server("tcp://0.0.0.0:8081");
        $server->addInstanceMethods($service);
        $server->start();
    }

    public function actionDaw(){
//        $client = Client::create('http://wmb.2plus1.cn:8080/site/user',false);
//        $res = $client->testSum(111);
//        echo $res;
        /**
         * @desc tcp
         */
        $client = new Client('tcp://127.0.0.1:8081', false);
        $res = $client->testSum(111);
        echo $res;
    }

    function hello(){
            return "Hello!";
    }

    public function actionWsdl(){
        libxml_disable_entity_loader(false);
        $client = new \mongosoft\soapclient\Client([
            'url' => 'http://wmb.2plus1.cn:8080/xml/hello',
            'options' => [
                'cache_wsdl' => WSDL_CACHE_NONE,
    //                'stream_context'    => $streamContext
            ]
        ]);
        var_dump($client->getGoodby('121'));exit;
//        //var_dump($client);
//        var_dump($client->getHello('Alex'));
        exit;
        //echo $client->getHello('Alex');
    }


}
