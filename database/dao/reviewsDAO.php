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

    public function getMostRecentReviews($results = 2)
    {
        return $this->getAll(0, $results, "ReviewTime desc");
    }

    public function hasUserReviewedImage($imageId, $userId) {
        $query = $this->_connection->prepare("select * from {$this->_tableName} where ImageID = ? and UID = ?");

        $query->bind_param("ii", $imageId, $userId);
        $query->execute();

        $result = $query->get_result();

        // if query failed, generally due to null value
        if($result == false){
            $query->close();
            return false;
        }

        $reviewExists = $result->num_rows > 0;
        $query->close();

        return $reviewExists;
    }

    public function addReview($imageId, $uId, $rating, $review)
    {
        $sql = "INSERT INTO {$this->_tableName} (ImageID, Rating, UID, Review, ReviewTime) VALUES (?,?,?,?,?)";
        $stmt = $this->_connection->prepare($sql);

        $now = new DateTime();
        $reviewTime = $now->format('Y-m-d H:i:s');

        $stmt->bind_param("iiiss", $imageId, $rating, $uId, $review, $reviewTime);
        $stmt->execute();
    }

    public function deleteReview($imageId, $uId)
    {
        $sql = "DELETE FROM {$this->_tableName} WHERE ImageID = ? and UID = ?";
        $stmt = $this->_connection->prepare($sql);

        $stmt->bind_param("ii", $imageId, $uId);
        $stmt->execute();
    }
}
