<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/17/2015
 * Time: 3:01 AM
 */

namespace app\models;
include("Source.php");
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

class Soqi extends Source
{

    public $search_type;
    public $city;
    public $cityName;
    public $keywords;
    public $page;

    /**
     * @return mixed
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * @param mixed $page
     */
    public function setPage($page)
    {
        $this->page = $page;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @param mixed $keywords
     */
    public function setKeywords($keywords)
    {
        $this->keywords = $keywords;
    }

    /*URL*/
    public function url($self)
    {

        //var_dump($self);

        $param = http_build_query($self);
        //d($param);

        return $this->getUrl() . "/search?" . $param;
    }

    /*SOQI FORMAT*/
    public function format($html)
    {

        $data = array();
        $text = "";

        foreach ($html->find(".itemblocks") as $item) {

            $company = new SoqiImpl();
            $company->setTitle($item);

            if (count($item->find("p")) >= 4) {

                list($desc, $contact, $address, $law) = $item->find("p");

                $company->setDesc($desc);
                $company->setAddress($address);

                /*CONTACT*/
                $col = ['setContactperson','setTel','setMobile','setFax'];
                $contact = explode("&nbsp", $contact->plaintext);
                
                foreach ($contact as $key => $value) {

                    $item = explode(":", $value);
                    
                    if (count($item)>1) {
                        
                        list(, $value) = $item;
                        $contact[$key] = trim($value);
                    }
                    // add value
                    $company->{$col[$key]}($contact[$key]);
                }
// 
                
                //var_dump($contact);
                /*list contact*/
                
                foreach ($contact as $key => $contact_value) {
                    # code...
                
                }
  
                /*LAW*/
                $law = explode("&nbsp;", $law->plaintext);


                $law = array_filter($law);

                foreach ($law as $key => $value) {

                    $item = explode(":", $value);
                    
                    if (count($item)>1) {

                       list(, $value) = $item;
                       $law[$key] = trim($value);
                    }

                    //d($value);
                    
                }
                //  d($law);
                list($money, , , $lawperson) = $law;

                $company->setMoney($money);
                $company->setLawperson($lawperson);

                /*EXPORT DATA*/
                // convert from object to array
                $data[] = $company->jsonSerialize();
                //var_dump($item);
                //$text .= $item;

            }

            //var_dump();
        }

        return $data;
    }

    /**
     * @return mixed
     */
    public function getSearchType()
    {
        return $this->search_type;
    }

    /**
     * @param mixed $search_type
     */
    public function setSearchType($search_type)
    {
        $this->search_type = $search_type;
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