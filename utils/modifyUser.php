<?php
// attempts to modify user with given vars

@include_once '../database/dao/usersDAO.php';
$users = new usersDAO();

// check if proper request
$user = NULL;
if (isset($_POST['uid'])) {
  $user = $users->getById($_POST['uid']);
}
if (!$user) {
  header('Location: ../error.php');
}

// input checks

// regex
$emailTemplate = '/^[\-0-9a-zA-Z\.\+_]+@[\-0-9a-zA-Z\.\+_]+\.[a-zA-Z\.]{2,5}$/';

// email
if (!empty($_POST['email'])
    && preg_match($emailTemplate, $_POST['email'])) {
  $user->userName = $_POST['email'];
  $user->email = $_POST['email'];
}

// password
if (!empty($_POST['password'])) {
  $user->pass = $_POST['password'];
}

// firstname
if (!empty($_POST['firstname'])) {
  $user->firstName = $_POST['firstname'];
}

// lastname
if (!empty($_POST['lastname'])) {
  $user->lastName = $_POST['lastname'];
}

// address
if (!empty($_POST['address'])) {
  $user->address = $_POST['address'];
}

// city
if (!empty($_POST['city'])) {
  $user->city = $_POST['city'];
}

// region
if (!empty($_POST['region'])) {
  $user->region = $_POST['region'];
}

// country
if (!empty($_POST['country'])) {
  $user->country = $_POST['country'];
}

// postal
if (!empty($_POST['postal'])) {
  $user->postal = $_POST['postal'];
}

// phone
if (!empty($_POST['phone'])) {
  $user->phone = $_POST['phone'];
}

// privacy
if (!empty($_POST['privacy']) && $_POST['privacy'] == "true") {
  $user->privacy = 2;
}
else {
  $user->privacy = 1;
}

// state
if (!empty($_POST['state']) && $_POST['state'] == "true") {
  $user->state = 1;
}
else {
  $user->state = 2;
}

// commit
$users->updateUser($user);

// go back
header('Location: ../modify-users.php');

?>
