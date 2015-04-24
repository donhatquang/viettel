<?php
/**
 * Created by PhpStorm.
 * User: nhatquang
 * Date: 4/22/2015
 * Time: 1:04 AM
 */

namespace app\models;


class SoqiDetail {

    private $map;
    private $contact;
    private $link;
    private $moreInfo;
    private $description;

    /**
     * @return mixed
     */
    public function getMap()
    {
        return $this->map;
    }

    /**
     * @param mixed $map
     */
    public function setMap($map)
    {
        $script = $map->find("script");
        /*FIND NEED SCRIPT*/
        foreach ($script as $item) {

            if (strpos($item->innertext, "address")) $script = $item;
        }

        //echo d($script);
        //echo $script;
        $script = explode(";", $script);
        $map = "";
        foreach ($script as $item) {

            if (strpos($item, "var")) {

                $map .= $item.";";
            }
        }
        //d($map);

        $this->map = $map;
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * @param mixed $contact
     */
    public function setContact($contact)
    {
        $this->contact = $contact;
    }

    /**
     * @return mixed
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param mixed $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return mixed
     */
    public function getMoreInfo()
    {
        return $this->moreInfo;
    }

    /**
     * @param mixed $moreInfo
     */
    public function setMoreInfo($moreInfo)
    {
        $this->moreInfo = $moreInfo;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function jsonSerialize()
    {
        return get_object_vars($this);
    }
}