<?php

@include_once dirname(__FILE__) . '/baseDAO.php';

class imagesDAO extends baseDAO
{
    // get data from traveluser and traveluserdetails since they have a 1-1 relationship
    protected $_tableName = 'travelimage join travelimagedetails on travelimage.ImageId = travelimagedetails.ImageId';
    protected $_primaryKey = 'travelimage.ImageId';
}
