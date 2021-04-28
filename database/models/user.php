<?php

class User
{
    public $uId;
    public $userName;
    public $pass;
    public $state;
    public $dateJoined;
    public $dateLastModified;
    public $firstName;
    public $lastName;
    public $address;
    public $city;
    public $region;
    public $country;
    public $postal;
    public $phone;
    public $email;
    public $privacy;

    public function __construct($uId, $userName, $pass, $state, $dateJoined, $dateLastModified, $firstName,
        $lastName, $address, $city, $region, $country, $postal, $phone, $email, $privacy)
    {
        $this->uId = $uId;
        $this->userName = $userName;
        $this->pass = $pass;
        $this->state = $state;
        $this->dateJoined = $dateJoined;
        $this->dateLastModified = $dateLastModified;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->address = $address;
        $this->city = $city;
        $this->region = $region;
        $this->country = $country;
        $this->postal = $postal;
        $this->phone = $phone;
        $this->email = $email;
        $this->privacy = $privacy;
    }

    // formats full name
    public function getName() {
        return $this->firstName . ' ' . $this->lastName;
    }

    // returns if user is administrator
    public function isAdmin() {
        return $this->state==1;
    }

    // returns if user has privacy turned on
    public function isPrivate() {
        return $this->state==2;
    }
}
