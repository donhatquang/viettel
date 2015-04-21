<?php

namespace app\controllers;

use app\models\Service;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Company;

class CompanyController extends Controller
{
    //public  $layout = false;
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
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

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionFinding()
    {

       $model = new Service();

       if (isset(Yii::$app->request->get()["keyword"])) {
            
            $keyword = Yii::$app->request->get()["keyword"];
            $page =  Yii::$app->request->get()["page"];
        }
        else {

            // $keyword = ($keyword == null) ? "互联网":$keyword;
            $keyword =  "互联网";
            $page = 1;                
        }

        
        $source = "soqi";
        $param = [
            "keywords" => $keyword,
            "page" => $page,
            "r" => Yii::$app->request->get()["r"]
        ];

        /*SEARCH*/
        $data = $model->finding($source, $param);

       // d($data);

        return $this->render('finding', [
            'data' => ($data),
            'param'=>  $param
        ]);
    }
}
