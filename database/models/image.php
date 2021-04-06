<?php

class Image
{
    public $imageId;
    public $uId;
    public $path;
    public $imageContent;
    public $title;
    public $description;
    public $latitude;
    public $longitude;
    public $cityCode;
    public $countryCodeISO;
    public $avgRating;
    public $totalRatings;

    public function __construct($imageId, $uId, $path, $imageContent, $title, $description, $latitude, 
        $longitude, $cityCode, $countryCodeISO, $avgRating, $totalRatings)
    {
        $this->imageId = $imageId;
        $this->uId = $uId;
        $this->path = $path;
        $this->imageContent = $imageContent;
        $this->title = $title;
        $this->description = $description;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->cityCode = $cityCode;
        $this->countryCodeISO = $countryCodeISO;
        $this->avgRating = $avgRating;
        $this->totalRatings = $totalRatings;
    }
}
