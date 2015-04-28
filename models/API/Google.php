<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/28/2015
 * Time: 11:48 AM
 */

namespace app\models;
include("Langcode.php");

class Google
{

    private $apikey = null;
    private $response = null;
    private $Langcode;

    /**
     * @return mixed
     */
    public function getLangcode()
    {
        return $this->Langcode;
    }

    /**
     * @param mixed $Langcode
     */
    public function setLangcode($Langcode)
    {
        $this->Langcode = $Langcode;
    }

    /**
     * @return null
     */
    public function getApikey()
    {
        return $this->apikey;
    }

    /**
     * @param null $apikey
     */
    public function setApikey($apikey)
    {
        $this->apikey = $apikey;
    }

    /**
     * @return null
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * @param null $response
     */
    public function setResponse($response)
    {
        $this->response = $response;
    }
    private $curl = null;

    function __construct($curl)
    {
        $this->curl = $curl;
    }


    /**
     * cURL POST example with post body params.
     */
    public function translate($q, $param = false)
    {

        $defaultParma = [

            "client" => "t",
            "sl" => "auto",
            "tl" => "zh-CN",
            //"hl" => "en",
            "dt" => "t",
            "ie" => "UTF-8",
            "oe" => "UTF-8"
        ];
        if ($param == false) {

            $param = $defaultParma;
        }

        $param = http_build_query($param);

        //Init curl
        $curl = $this->curl;

        $response = $curl->setOption(
            CURLOPT_POSTFIELDS,
            http_build_query(array(
                    'q' => $q
                )
            )

        )->post('http://translate.google.com/translate_a/single?' . $param);

        $json = $response;

        while (strpos($json, ",,"))
            $json = str_replace(",,", ",", $json);

        //d($json);
        $json = (json_decode($json));

        //var_dump($response->response);
        $this->response = $json;

        return $this;
    }

    function getResult($pos = 0)
    {
        //d($this->response);
        /*LIST COUNTRY*/
        d($Langcode);

        return $this->response[0][$pos][0];
    }

}

