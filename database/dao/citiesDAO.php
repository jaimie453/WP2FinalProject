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

    // finds only cities with associated images
    public function getCitiesWithImages() {
      // find from table all where GeoNameID is found in all CityCodes
      $query = $this->__connection->prepare("
        select *
        from {$this->_tableName}
        where GeoNameID in (
          select CityCode
          from travelimagedetails
          group by CityCode
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
