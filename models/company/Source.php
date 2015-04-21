<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/17/2015
 * Time: 3:04 AM
 */

namespace app\models;


abstract class Source {

    private $url;

    abstract public function url($param);
    abstract public function format($html);
    abstract public function cityFormat($html);

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }
}