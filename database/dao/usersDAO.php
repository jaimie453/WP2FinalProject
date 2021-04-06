<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/user.php';
class usersDAO extends baseDAO
{
    // get data from traveluser and traveluserdetails since they have a 1-1 relationship
    protected $_tableName = 'traveluser join traveluserdetails on traveluser.UID = traveluserdetails.UID';
    protected $_primaryKey = 'traveluser.UID';

    protected function convertToObject($row) {
        return new User($row['UID'], $row['UserName'], $row['Pass'], $row['State'], $row['DateJoined'], $row['DateLastModified'], 
            $row['FirstName'], $row['LastName'], $row['Address'], $row['City'], $row['Region'], $row['Country'], 
            $row['Postal'], $row['Phone'], $row['Email'], $row['Privacy']);
    }
}
