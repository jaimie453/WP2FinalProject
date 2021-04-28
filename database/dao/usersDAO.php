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

    // add user to db, return new user object
    public function addUser ($userName, $pass, $firstName, $lastName,
        $address, $city, $region, $country, $postal, $phone,
        $email, $privacy) {

      $date = date("Y-m-d H:i:s");

      // add to traveluser
      if(!($query = $this->_connection->prepare("
        insert
        into traveluser
        (`UserName`, `Pass`, `State`, `DateJoined`, `DateLastModified`)
        values
        (
            '{$userName}',
            '{$pass}',
            2,
            '{$date}',
            '{$date}'
        )
      "))) {  // not success
        return NULL;
      }
      // if execution successful
      if ($query->execute()) {  // get new UID
        $result = $this->_connection->query("
          select `UID`
          from traveluser
          where `UserName` = '{$userName}'
        ")->fetch_assoc();
        // if not found, error
        if(!($result) || is_null($result)) {
          $query->close();
          return NULL;
        }
      }
      else {  // not success
        $query->close();
        return NULL;
      }

      // add to traveluserdetails
      if(!($query = $this->_connection->prepare("
        insert
        into traveluserdetails
        (`UID`, `FirstName`, `LastName`, `Address`,
        `City`, `Region`, `Country`, `Postal`, `Phone`, `Email`, `Privacy`)
        values
        (
            {$result['UID']},
            '{$firstName}',
            '{$lastName}',
            '{$address}',
            '{$city}',
            '{$region}',
            '{$country}',
            '{$postal}',
            '{$phone}',
            '{$email}',
            '{$privacy}'
        )
      "))) {  // not success
        return NULL;
      }
      // if execution successful
      if ($query->execute()) {  // return new user
        $query->close();
        return $this->getById($result['UID']);
      }

      // not found, error
      $query->close();
      return NULL;

    }

    // check credentials and return user object if valid
    public function getUser ($userName, $password) {
        // get user
        $user = $this->fetch($userName, 'UserName')[0];

        // if user found and password matches
        if (!is_null($user) && ($user->pass == $password)) {  // return user
            return $user;
        }
        else {  // invalid credentials
            return NULL;
        }
    }

    // log user in by updating time stamp
    public function logUserIn ($uid) {
        $date = date("Y-m-d H:i:s");

        // update user's time stamp
        if($query = $this->_connection->prepare("
          update
          `traveluser`
          set `DateLastModified` = '{$date}'
          where `UID` =  {$uid}
        ")) { // success, commit
          $query->execute();
          $query->close();
        } else {
          // fail to update
          $query->close();
        }

        
    }

    // update user record with user object
    public function updateUser ($user) {
      // update user with new (and old) entries
      if(!($query = $this->_connection->prepare("
        update {$this->_tableName}
        set traveluser.UserName = '{$user->userName}',
        traveluser.Pass = '{$user->pass}',
        traveluser.State = '{$user->state}',
        traveluserdetails.FirstName = '{$user->firstName}',
        traveluserdetails.LastName = '{$user->lastName}',
        traveluserdetails.Address = '{$user->address}',
        traveluserdetails.City = '{$user->city}',
        traveluserdetails.Region = '{$user->region}',
        traveluserdetails.Country = '{$user->country}',
        traveluserdetails.Postal = '{$user->postal}',
        traveluserdetails.Email = '{$user->email}',
        traveluserdetails.Privacy = '{$user->privacy}'
        where {$this->_primaryKey} = '{$user->uId}'
      ")))
      { // not success
        return;
      }

      // if execution fails (can put temp error checking here)
      if(!$query->execute())
      {
        $query->close();
        return;
      }

      // execution successful
      $query->close();
      return;
    }

}
