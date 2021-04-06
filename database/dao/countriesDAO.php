<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/country.php';

class countriesDAO extends baseDAO
{
    protected $_tableName = 'geocountries';
    protected $_primaryKey = 'ISO';

    protected function convertToObject($row) {
        return new Country($row['ISO'], $row['fipsCountryCode'], $row['ISO3'], $row['ISONumeric'], $row['CountryName'], 
            $row['Capital'], $row['GeoNameID'], $row['Area'], $row['Population'], $row['Continent'], $row['TopLevelDomain'], 
            $row['CurrencyCode'], $row['CurrencyName'], $row['PhoneCountryCode'], $row['Languages'], $row['PostalCodeFormat'], 
            $row['PostalCodeRegex'], $row['Neighbours'], $row['CountryDescription']);
    }
}
