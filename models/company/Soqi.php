<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/17/2015
 * Time: 3:01 AM
 */

namespace app\models;

include("Source.php");
include("SoqiDetail.php");

class Soqi extends Source
{

    public $search_type;
    public $city;
    public $cityName;
    public $keywords;
    public $page;

    /*URL*/
    public function url($self)
    {

        $param = http_build_query($self);

        return $this->getUrl() . "/search?" . $param;
    }

    /*SOQI CITY SOLUTION*/
    public function cityFormat($html) {

        $cities = [];
        //d(count($html->find("a")));
        /*LIST ALL CITY DISPLAY*/
        foreach ($html->find("a") as $item) {

            $cityName = $item->plaintext;
            $cityCode = $item->href;

            $city = new SoqiCity($cityName, $cityCode);
            $cities[] = $city;
        }

        return $cities;
    }

    /*SOQI FORMAT*/
    public function format($html)
    {

        $data = [];

        /*CHECK IF NULL*/
        if (count($html->find(".itemblocks")) == 0) {

            $company = new SoqiImpl();
            $data[] = $company->jsonSerialize();
            return $data;
        }

        //echo count($html->find(".itemblocks"));

        /*City list*/
        //d(count($html->find(".address_l")));
        $address = $html->find(".address_l")[0];
        $city = $this->cityFormat($address);

        /*Company list*/
        $companylist = [];

        foreach ($html->find(".itemblocks") as $item) {

            //echo $item;

            /*IMPLEMENT SOQI WEB*/
            $company = new SoqiImpl();



            $company->setTitle($item);
            //echo count($item->find("p"));

            if (count($item->find("p")) >= 3) {

                //list($desc, $contact, $address, $law) = $item->find("p");

                list($desc, $address, $law) = $item->find("p");


                $company->setDesc($desc);
                $company->setAddress($address);

                /*CONTACT*/
                /*$col = ['setContactperson','setTel','setMobile','setFax'];
                $contact = explode("&nbsp", $contact->plaintext);
                
                foreach ($contact as $key => $value) {

                    $item = explode(":", $value);
                    
                    if (count($item)>1) {
                        list(, $value) = $item;
                    }
                    // add value
                    $company->{$col[$key]}(trim($value));
                }*/

                /*LAW*/
                $law = explode("&nbsp;", $law->plaintext);
                $law = array_filter($law); //remove empty element


                $col = ['setMoney','setLawperson'];
                $count = 0;

                foreach ($law as $key => $value) {

                    list(,$value) = explode("：", $value);

                    $company->{$col[$count]}(trim($value));
                    $count++;
                }


                //var_dump($company);
                // convert from object to array
                $companylist[] = $company->jsonSerialize();

                /*ADD COMPANY OBJECT TO LIST*/
                //$companylist[] = $company;

                //var_dump($company);
            }
        }
        //END LIST
        //var_dump($companylist);
        //exit();
        return $companylist;
    }

    public function formatDetail($html) {

        /*IMPLEMENT SOQI WEB*/
        $company = new SoqiDetail();
        $company->setMap($html);

        $data = $company->jsonSerialize();

        return $data;
    }

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