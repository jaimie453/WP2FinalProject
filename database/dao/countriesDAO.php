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

    // select all from table where they have images
    public function getCountriesWithImages() {
      // select all from table where the id is in the images table
      $query = $this->__connection->prepare("
        select *
        from {$this->_tableName}
        where ISO in (
          select CountryCodeISO
          from travelimagedetails
          group by CountryCodeISO
        )
      ");

      $query->execute();

      $result = $query->get_result();

      // if query failed, generally due to null value
      if($result == false){
          $query->close();
          return null;
      }

      $rows = array();
      foreach($result as $row)
          $rows[] = $this->convertToObject($row);

      $query->close();

      if(count($rows) == 0)
          return null;

      return $rows;
    }
}
