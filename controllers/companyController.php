<?php

namespace app\controllers;

use app\models\Service;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\Company;

ini_set('user_agent','Mozilla/5.0 (Windows NT 10.0; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/51.0.2704.63 Safari/537.36'); 

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

    public function actionDetail() {

        //$this->layout = false;
        $model = new Service();


        if (isset(Yii::$app->request->get()["keywords"])) {

            $url = Yii::$app->request->get()["url"];
        }
        else {

            $url = "http://www.soqi.cn/detail/id_22819C328KJU.html";
        }

        $title = Yii::$app->request->get()["title"];

        /*------------*/
        $source = "soqi";
        $param = [
            "url" => $url,
            "title" => $title
        ];

        $data = $model->detall($source, $param);

        return $this->render('detail', [
            'data' => ($data),
            'param'=>  $param
        ]);
    }

    /*MAP*/
    public function actionMap() {

        //$this->layout = false;
        $model = new Service();

        if (isset(Yii::$app->request->get()["keywords"])) {

            $url = Yii::$app->request->get()["url"];
        }
        else {

            $url = "http://www.soqi.cn/detail/id_22819C328KJU.html";
        }

        /*------------*/
        $source = "soqi";
        $param = [
            "url" => $url
        ];

        $data = $model->detall($source, $param);

        return $this->render('map', [
            'data' => ($data),
            'param'=>  $param
        ]);
    }

    /*FINDING*/
    public function actionFinding()
    {

       $model = new Service();

        //$baseUrl = Yii::$app->basePath;
        //Yii::$app->assetManager->publish(        ]);

        //var_dump($cs);

       if (isset(Yii::$app->request->get()["keywords"])) {
            
            $keywords = Yii::$app->request->get()["keywords"];
            $page =  Yii::$app->request->get()["page"];
            $city =  Yii::$app->request->get()["city"];
            $cityName =  Yii::$app->request->get()["cityName"];
            $search_type = Yii::$app->request->get()["search_type"];

        }
        else {

            // $keyword = ($keyword == null) ? "互联网":$keyword;
            $keywords =  "互联网";
            $page = 1;
            $city = 100000;
            $cityName = "全国";
            $search_type = 1;
        }

        $source = "soqi";
        $param = [
            "q" => $keywords,
            "page" => $page,
            "city" => $city,
            "cityName" => $cityName,
            "r" => Yii::$app->request->get()["r"],
            "search_type" => $search_type
        ];

        if ($cityName == "cam") {

            $source = "cam";
            $param = [
                "q" => $keywords
            ];
        }

        /*SEARCH*/

        //d($param);
        $data = $model->finding($source, $param);
<<<<<<< HEAD
		//var_dump($data);
		//exit();
=======

        //var_dump($data);
        //return;

>>>>>>> origin/master
       // d($data);

        return $this->render('finding', [
            'data' => ($data),
            'param'=>  $param
        ]);
    }
}
