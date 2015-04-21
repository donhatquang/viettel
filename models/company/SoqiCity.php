<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/22/2015
 * Time: 1:04 AM
 */

namespace app\models;


class SoqiCity {

    private $city;
    private $cityName;

    function __construct($city, $cityName)
    {
        $this->city = $city;
        $this->cityName = $cityName;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getCityName()
    {
        return $this->cityName;
    }

    /**
     * @param mixed $cityName
     */
    public function setCityName($cityName)
    {
        $this->cityName = $cityName;
    }
}