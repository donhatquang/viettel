<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/17/2015
 * Time: 3:01 AM
 */

namespace app\models;


class Cam extends Source
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
        return $this->getUrl() . "/search/?q=" . $this->getKeywords();
        //return $this->getUrl();
    }


    /*SOQI FORMAT*/
    public function format($html)
    {

        $data = [];
		echo "test";
        //echo $html;
        //var_dump($html->find(".vcard"));
		//echo "count: ".var_dump(count($html->find(".itemblocks")));
		
        /*CHECK IF NULL*/
              
        /*Company list*/
        $companylist = [];
		
		echo count($html->find(".vcard"));

        foreach ($html->find(".vcard") as $item) {

            /*IMPLEMENT SOQI WEB*/
            $company = new CamImpl();
            

            $company->setTitle($item);

            //var_dump($company->getTitle());
            //echo($item->plaintext);
            
            //FIND DESCRIPTION
            
            $company->setDesc($item);

            $company->setTel($item);
            $company->setAddress($item);
            //$company->setAddress($address);
            

				
				//var_dump($company);
                // convert from object to array
                //var_dump($company);
                $companylist[] = $company->jsonSerialize();

                /*ADD COMPANY OBJECT TO LIST*/
                //$companylist[] = $company;
            
        }
        //END LIST
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