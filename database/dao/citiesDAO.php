<?php

@include_once dirname(__FILE__) . '/baseDAO.php';

class citiesDAO extends baseDAO
{
    protected $_tableName = 'geocities';
    protected $_primaryKey = 'GeoNameID';
}
