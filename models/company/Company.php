<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/17/2015
 * Time: 2:55 AM
 */

namespace app\models;


abstract class Company {

    protected $title;
    protected $desc;
    protected $address;
    protected $money;
    protected $tel;
    protected $mobile;
    protected $fax;
    protected $lawperson;
    protected $contactperson;
    protected $url;

    /**
     * @return mixed
     */
    public function getContactperson()
    {
        return $this->contactperson;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return mixed
     */
    public function getDesc()
    {
        return $this->desc;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @return mixed
     */
    public function getMoney()
    {
        return $this->money;
    }

    /**
     * @return mixed
     */
    public function getTel()
    {
        return $this->tel;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * @return mixed
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * @return mixed
     */
    public function getLawperson()
    {
        return $this->lawperson;
    }

    /**
     * @return mixed
     */
    public function getUrl()
    {
        return $this->url;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}