<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/continent.php';

class continentsDAO extends baseDAO
{
    protected $_tableName = 'geocontinents';
    protected $_primaryKey = 'ContinentCode';

    protected function convertToObject($row) {
        return new Continent($row['ContinentCode'], $row['ContinentName'], $row['GeoNameId']);
    }
}
