<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/image.php';

class imagesDAO extends baseDAO
{
    // get data for image and ratings and continent
    // also get average and total ratings for the images
    // also get the post this image is apart of
    protected $_tableName = '
                travelimage
            JOIN
                travelimagedetails
                    on travelimage.ImageID = travelimagedetails.ImageID
            LEFT JOIN
                (SELECT distinct ImageID,
                    (
                        SELECT AVG(rating)
                        FROM   travelimagerating as rating
                        WHERE rating.ImageID = travelimagerating.ImageID
                    ) avg,
                    (
                        SELECT count(rating)
                        FROM   travelimagerating as r
                        WHERE r.ImageID = travelimagerating.ImageID
                    ) total
                FROM travelimagerating) ratings
                    on travelimage.ImageID = ratings.ImageID
            join
                geocountries
                    on travelimagedetails.CountryCodeISO = geocountries.ISO
            join
                geocontinents
                    on geocountries.Continent = geocontinents.ContinentCode
            join
                travelpostimages
                    on travelimage.ImageID = travelpostimages.ImageID';


    protected $_primaryKey = 'travelimage.ImageId';

    protected function convertToObject($row) {
        $avgRating = number_format($row['avg'], 1);
        return new Image($row['ImageID'], $row['UID'], $row['Path'], $row['ImageContent'], $row['Title'],
            $row['Description'], $row['Latitude'], $row['Longitude'], $row['CityCode'], $row['CountryCodeISO'],
            $avgRating, $row['total'], $row['ContinentCode'], $row['PostID']);
    }

    public function getTopImages($numOfResults) {
        return $this->getAll(0, $numOfResults, "avg desc");
    }

    // newest images have the highest id I guess?
    public function getNewestImages($numOfResults) {
        return $this->getAll(0, $numOfResults, "travelImage.ImageId desc");
    }

    public function getImagesForCity($cityCode) {
        return $this->fetch($cityCode, 'CityCode');
    }

    public function getImagesForCountry($countryCode) {
        return $this->fetch($countryCode, 'CountryCodeISO');
    }

    public function getImagesForPost($postId) {
        return $this->fetch($postId, 'PostID');
    }

    public function getImagesForUser($uId) {
        return $this->fetch($uId, 'UID');
    }
}
