<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/22/2015
 * Time: 12:40 AM
 */

namespace app\models;

include("Company.php");
class SoqiImpl extends Company
{

    /**
     * @param mixed $contactperson
     */
    public function setContactperson($contactperson)
    {
        $this->contactperson = $contactperson;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($item)
    {
        list($data) = $item->find("h3 a");

        $this->setUrl($data->href);
        $this->title = $data->plaintext;
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($desc)
    {
        list(, $desc) = explode(":", $desc->plaintext);
        $this->desc = $desc;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address)
    {
        $address = $address->plaintext;
        list(, $address) = explode(":", $address);

        $this->address = $address;
    }

    /**
     * @param mixed $money
     */
    public function setMoney($money)
    {
        $this->money = $money;
    }

    /**
     * @param mixed $tel
     */
    public function setTel($tel)
    {
        $this->tel = $tel;
    }

    /**
     * @param mixed $mobile
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

    /**
     * @param mixed $fax
     */
    public function setFax($fax)
    {
        $this->fax = $fax;
    }

    /**
     * @param mixed $lawperson
     */
    public function setLawperson($lawperson)
    {
        $this->lawperson = $lawperson;
    }

    /**
     * @param mixed $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

}