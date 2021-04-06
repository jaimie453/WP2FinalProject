<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/city.php';
class citiesDAO extends baseDAO
{
    protected $_tableName = 'geocities';
    protected $_primaryKey = 'GeoNameID';

    protected function convertToObject($row) {
        return new City($row['GeoNameID'], $row['AsciiName'], $row['CountryCodeISO'], $row['Latitude'], $row['Longitude'], 
            $row['FeatureCode'], $row['Admin1Code'], $row['Admin2Code'], $row['Population'], $row['Elevation'], $row['TimeZone']);
    }
}
