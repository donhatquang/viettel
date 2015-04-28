<?php

namespace app\models;


use linslin\yii2\curl;
use Yii;
use yii\base\Model;

//use yii\base\Object;

// example of how to use viettel selector to retrieve HTML contents
include('simplehtmldom_1_5/simple_html_dom.php');

/*SOQI*/
include('company/Soqi.php');
include('company/SoqiImpl.php');
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
                    $curl = new curl\Curl();
                    $google = new Google($curl);

                    $keyword = $google->translate($param["keywords"]);

                    /*------------------*/
                    $company = new Soqi();

                    /*PARAM*/
                    $company->setCity($param["city"]);
                    $company->setCityName($param['cityName']);
                    $company->setSearchType($param["search_type"]);

                    /*BASIC*/
                    $company->setUrl($url);
                    $company->setKeywords($keyword->getResult(0));
                    $company->setPage($param["page"]);



                    break;

                default:
                    return;
            };


            //var_dump($data);
            //exit();

            $url = $company->url($company);
            $html = file_get_html($url);

            d($keyword->getResponse());
            echo $company->getKeywords();

            $data = array(
                "company" => $company->format($html),
                "keyword" => $keyword->getResponse()
            );
        }
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


        return $data;
    }

}
