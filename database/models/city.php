<?php

class City
{
    public $geoNameId;
    public $asciiName;
    public $countryCodeISO;
    public $latitude;
    public $longitude;
    public $featureCode;
    public $admin1Code;
    public $admin2Code;
    public $population;
    public $elevation;
    public $timeZone;

    public function __construct($geoNameId, $asciiName, $countryCodeISO, $latitude, $longitude, 
        $featureCode, $admin1Code, $admin2Code, $population, $elevation, $timeZone)
    {
        $this->geoNameId = $geoNameId;
        $this->asciiName = $asciiName;
        $this->countryCodeISO = $countryCodeISO;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->featureCode = $featureCode;
        $this->admin1Code = $admin1Code;
        $this->admin2Code = $admin2Code;
        $this->population = $population;
        $this->elevation = $elevation;
        $this->timeZone = $timeZone;
    }
}
