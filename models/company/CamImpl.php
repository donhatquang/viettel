<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/22/2015
 * Time: 12:40 AM
 */

namespace app\models;

require_once("Company.php");
class CamImpl extends Company
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
        list($data) = $item->find("header");

        $this->setUrl($data->href);
        $this->title = trim($data->plaintext);
    }

    /**
     * @param mixed $desc
     */
    public function setDesc($item)
    {

        $desc = $item->find(".description");
        $cat = $item->find(".category");

        $this->desc = trim($desc[0]->plaintext);
        $this->desc .= " - ".trim($cat[0]->plaintext);
        //echo $this->desc;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($item)
    {
        $address = $item->find("address");
        $this->address = trim($address[0]->plaintext);     
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
    public function setTel($item)
    {
        
        $tel = $item->find(".tel");
        $this->tel = trim($tel[0]->plaintext);        
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