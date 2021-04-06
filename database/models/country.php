<?php

class Country
{
    public $iso;
    public $fipsCountryCode;
    public $iso3;
    public $isoNumeric;
    public $countryName;
    public $capital;
    public $geoNameId;
    public $area;
    public $population;
    public $continent;
    public $topLevelDomain;
    public $currencyCode;
    public $currencyName;
    public $phoneCountryCode;
    public $languages;
    public $postalCodeFormat;
    public $postalCodeRegex;
    public $neighbors;
    public $countryDescription;


    public function __construct($iso, $fipsCountryCode, $iso3, $isoNumeric, $countryName, $capital, 
        $geoNameId, $area, $population, $continent, $topLevelDomain, $currencyCode, $currencyName, 
        $phoneCountryCode, $languages, $postalCodeFormat, $postalCodeRegex, $neighbors, $countryDescription)
    {
        $this->iso = $iso;
        $this->fipsCountryCode = $fipsCountryCode;
        $this->iso3 = $iso3;
        $this->isoNumeric = $isoNumeric;
        $this->countryName = $countryName;
        $this->capital = $capital;
        $this->geoNameId = $geoNameId;
        $this->area = $area;
        $this->population = $population;
        $this->continent = $continent;
        $this->topLevelDomain = $topLevelDomain;
        $this->currencyCode = $currencyCode;
        $this->currencyName = $currencyName;
        $this->phoneCountryCode = $phoneCountryCode;
        $this->phoneCountryCode = $phoneCountryCode;
        $this->languages = $languages;
        $this->postalCodeFormat = $postalCodeFormat;
        $this->postalCodeRegex = $postalCodeRegex;
        $this->neighbors = $neighbors;
        $this->countryDescription = $countryDescription;
    }
}
