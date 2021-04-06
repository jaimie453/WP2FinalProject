<?php

@include_once dirname(__FILE__) . '/baseDAO.php';

class postsDAO extends baseDAO
{
    protected $_tableName = 'travelpost';
    protected $_primaryKey = 'PostID';
}
