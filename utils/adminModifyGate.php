<?php
// allow access to modify-users.php if admin

@include_once '../database/dao/usersDAO.php';

session_start();

// allow admins through
if($_SESSION['user']->isAdmin()) {
    header('Location: ../modify-users.php');
}
// redirect others to home
else {
    header('Location: ../index.php');
}

?>
