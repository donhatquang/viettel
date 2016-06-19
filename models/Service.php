<?php

namespace app\models;


use linslin\yii2\curl;
use Yii;
use yii\base\Model;

//use yii\base\Object;

// example of how to use viettel selector to retrieve HTML contents
include('simplehtmldom_1_5/simple_html_dom.php');

// source
//include("company/Company.php");
include("company/Source.php");

/*SOQI*/
include('company/Soqi.php');
include('company/SoqiImpl.php');

include('company/Cam.php');
include('company/CamImpl.php');

include('API/Google.php');


/**
 * ContactForm is the model behind the contact form.
 */
class Service extends Model
{
    public $searchData;
    private $source = [

        "soqi" => [

            "url" => "http://www.soqi.cn",
            "param" => [
                "keywords" => "服装",
                "search_type" => 3,
                "city" => 100000,
                "cityName" => ""
            ]
        ],

        "cam" => [

            "url" => "http://yp.com.kh",
            "param" => [
                "q" => "internet"                
            ]
        ]
    ];


    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        /*return [
            // name, email, subject and body are required
            [['name', 'email', 'subject', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
            // verifyCode needs to be entered correctly
            ['verifyCode', 'captcha'],
        ];*/
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'verifyCode' => 'Verification Code',
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * @param  string $email the target email address
     * @return boolean whether the model passes validation
     */
    public function finding($source = false, $param = array())
    {

        //var_dump($source);

        // get DOM from URL or file
        $data = null;
        $company = null;

        /*CHECK IF EXIST*/
        if ($source && is_array($this->source[$source])) {

            $url = $this->source[$source]["url"];
            //$sourceParam = $this->source[$source]["param"];

            switch ($source) {

                case "soqi":

                    /*TRANSLATE KEYWORD*/
<<<<<<< HEAD
                    /*$curl = new curl\Curl();
                    $google = new Google($curl);
=======
                    $curl = new curl\Curl();
                    //$google = new Google($curl);

                    //$translate = $google->translate($param["keywords"])->getResponse();
                    //$keyword = $translate[0][0][0];
                    $keyword = $param["keywords"];
>>>>>>> origin/master

                    //d($translate);
<<<<<<< HEAD

                    $lang = $translate["lang"];
=======
                    //$lang = $translate["lang"];
>>>>>>> origin/master
 //                   d($translate);
*/


                    /*------------------*/
                    $company = new Soqi();

                    /*PARAM*/
                    $company->setCity($param["city"]);
                    $company->setCityName($param['cityName']);
                    $company->setSearchType($param["search_type"]);

                    /*BASIC*/
                    $company->setUrl($url);
                    $company->setKeywords($param["keywords"]);
                    $company->setPage($param["page"]);

                    break;

                case "cam": 

                    $company = new Cam();

                    $company->setUrl($url);
                    $company->setKeywords($param["q"]);

                break;

                default:
                    return;
            };


            //var_dump($data);
            //exit();

<<<<<<< HEAD
            //var_dump($source);

            $url = $company->url($company);

            //var_dump($url);
            
            $html = file_get_html($url);
            
			
			//var_dump($url);
			//echo $html;
=======
            echo $url = $company->url($company);
            $html = file_get_html($url);
            //exit();
>>>>>>> origin/master

            //d($keyword->getResponse());
            //echo $company->getKeywords();

            $data = array(
                "company" => $company->format($html)
                //"lang" => $lang
            );
        }
        //var_dump($data);
        return $data;
    }


    /*DETAIL INFO*/
    /**
     * @param bool $source
     * @param array $param
     */
    public
    function detall($source = false, $param = array())
    {

        $company = new Soqi();


        $url = $param["url"];
        $html = file_get_html($url);

        $data = $company->formatDetail($html);

    }

}
