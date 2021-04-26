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

    public function addUser ($userName, $pass, $firstName, $lastName,
        $address, $city, $region, $country, $postal, $phone,
        $email, $privacy) {

      $date = date("Y-m-d H:i:s");

      // user
      if(!($query = $this->__connection->prepare("
        insert
        into traveluser
        (`UserName`, `Pass`, `State`, `DateJoined`, `DateLastModified`)
        values
        (
            '{$userName}',
            '{$pass}',
            1,
            '{$date}',
            '{$date}'
        )
      "))) {
        //die('prepare()1 failed: ' . htmlspecialchars($mysqli->error));
        $query->close();
      }

      if ($query->execute()) {
        $result = $this->__connection->query("
          select `UID`
          from traveluser
          where `UserName` = '{$userName}'
        ")->fetch_assoc();
        if(!($result) || is_null($result)) {
          die('get ('. $result .') failed: ' . htmlspecialchars($mysqli->error));
        }
      }
      else {
        //die('execute1() failed: ' . htmlspecialchars($mysqli->error));
        $query->close();
        return NULL;
      }

      // details
      if(!($query = $this->__connection->prepare("
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
      "))) {
        //die('prepare()2 failed: ' . htmlspecialchars($mysqli->error));
        $query->close();
        return NULL;
      }

      if ($query->execute()) {
        $query->close();
        return $this->getById($result['UID']);
      }

      //die('execute()2 failed: ' . htmlspecialchars($mysqli->error));
      $query->close();
      return NULL;

    }

    public function getUser ($userName, $password) {
        $user = $this->fetch($userName, 'UserName')[0];
        if (!is_null($user) && ($user->pass == $password)) {
            return $user;
        }
        else {
            return NULL;
        }
    }

    public function logUserIn ($uid) {
        $date = date("Y-m-d H:i:s");

        if($query = $this->__connection->prepare("
          update
          `traveluser`
          set `DateLastModified` = '{$date}'
          where `UID` =  {$uid}
        ")) {
          $query->execute();
          $query->close();
        }
        // else
        //   die('update failed: ' . htmlspecialchars($mysqli->error));

        $query->close();
    }
}
