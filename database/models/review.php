<?php

class Rating
{
    public $imageRatingId;
    public $imageId;
    public $rating;
    public $uId;
    public $review;
    public $reviewTime;

    public function __construct($imageRatingId, $imageId, $rating, $uId, $review, $reviewTime)
    {
        $this->imageRatingId = $imageRatingId;
        $this->imageId = $imageId;
        $this->rating = $rating;
        $this->uId = $uId;
        $this->review = $review;
        $this->reviewTime = $reviewTime;
    }

    public function getReviewDate() {
        return explode(" ", $this->reviewTime)[0];
    }
}
