<?php

namespace app\models;

use Yii;
use yii\base\Model;
//use yii\base\Object;

// example of how to use viettel selector to retrieve HTML contents
include('simplehtmldom_1_5/simple_html_dom.php');

/*SOQI*/
include('company/Soqi.php');
include('company/SoqiImpl.php');

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
        //$object = json_decode(json_encode($this->source), FALSE);

        //var_dump($object);

        /*CHECK IF EXIST*/
        if ($source && is_array($this->source[$source])) {

            $url = $this->source[$source]["url"];
            //$sourceParam = $this->source[$source]["param"];

            switch ($source) {

                case "soqi":
                    $company = new Soqi();
                    $company->setUrl($url);
                    $company->setCity($param["city"]);
                    $company->setCityName($param['cityName']);

                    /*KEYWORD*/
                    //d($param);
                    $company->setKeywords($param["keywords"]);
                    $company->setPage($param["page"]);

                    break;

                default:
                    return;
            }


            //d($company);

            $url = $company->url($company);
            $html = file_get_html($url);

            /*
             *  $data = array(
            "company" => $companylist,
            "city" => $city
             * */

            $data = $company->format($html);
        }

        // d($data);
        // echo json_encode($data);

        //   d($source);
        //  dd($kwd);

        return $data;
    }

}
