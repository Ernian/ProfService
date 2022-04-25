<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Response;
use app\models\Clients;
use app\models\Content;
use app\models\Products;
use app\models\LoginForm;

class SiteController extends AppController
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->setMetaTags('ProfService');
        $homePage = Content::getPageContent('home');
        $hitProducts = Products::find()->asArray()->where(['hit' => 1])->all();
        $newProducts = Products::find()->asArray()->where(['new' => 1])->limit(3)->all();
        $saleProducts = Products::find()->asArray()->where(['sale' => 1])->limit(3)->all();
        $clients = Clients::find()->asArray()->all();
        return $this->render('index', compact('homePage', 'hitProducts', 'newProducts', 'saleProducts', 'clients'));
    }

    public function actionContacts()
    {
        $this->setMetaTags('ProfService | Contacts');
        return $this->render('contacts');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        $model->password = '';
        $this->layout = false;
        return json_encode($this->render('login', ['model' => $model]));
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
        return $this->goHome();
    }

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post', 'get'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
}
