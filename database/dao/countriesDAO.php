<?php

@include_once dirname(__FILE__) . '/baseDAO.php';

class countriesDAO extends baseDAO
{
    protected $_tableName = 'geocountries';
    protected $_primaryKey = 'ISO';
}
