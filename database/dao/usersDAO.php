<?php

@include_once dirname(__FILE__) . '/baseDAO.php';

class usersDAO extends baseDAO
{
    // get data from traveluser and traveluserdetails since they have a 1-1 relationship
    protected $_tableName = 'traveluser join traveluserdetails on traveluser.UID = traveluserdetails.UID';
    protected $_primaryKey = 'traveluser.UID';
}
