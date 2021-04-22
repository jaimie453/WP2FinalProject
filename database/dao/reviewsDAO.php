<?php

@include_once dirname(__FILE__) . '/baseDAO.php';
@include_once __DIR__ . '/../models/review.php';

class reviewsDAO extends baseDAO
{
    protected $_tableName = 'travelimagerating';
    protected $_primaryKey = 'ImageRatingID';

    protected function convertToObject($row)
    {
        return new Rating(
            $row['ImageRatingID'],
            $row['ImageID'],
            $row['Rating'],
            $row['UID'],
            $row['Review'],
            $row['ReviewTime']
        );
    }

    public function getReviewsForImage($imageId)
    {
        return $this->fetch($imageId, 'ImageID');
    }

    public function addReview($imageId, $uId, $rating, $review)
    {
        $sql = "INSERT INTO {$this->_tableName} (ImageID, Rating, UID, Review, ReviewTime) VALUES (?,?,?,?,?)";
        $stmt = $this->_connection->prepare($sql);

        $dateTime = new DateTime();
        $reviewTime = $dateTime->format('Y-m-d H:i:s'); 

        $stmt->bind_param("iiiss", $imageId, $rating, $uId, $review, $reviewTime);
        $stmt->execute();
    }
}
