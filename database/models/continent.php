<?php

class Continent
{
    public $continentCode;
    public $continentName;
    public $geoNameId;

    public function __construct($continentCode, $continentName, $geoNameId)
    {
        $this->continentCode = $continentCode;
        $this->continentName = $continentName;
        $this->geoNameId = $geoNameId;
    }
}
