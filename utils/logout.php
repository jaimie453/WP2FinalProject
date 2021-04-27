<?php
// log user out

session_start();

// unset user var
unset($_SESSION['user']);

// redirect to home
header('Location: ../index.php');

?>
