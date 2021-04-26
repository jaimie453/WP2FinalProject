<?php

@include_once './database/dao/usersDAO.php';
@include_once './utils/displayUsers.php';

// get users
$users = new usersDAO();
$allUsers = $users->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'components/head.php'; ?>

  <title>Browse Users</title>

</head>

<body class="fixed-mountain-bg">
  <?php include_once 'components/navbar.php'; ?>
  <?php include_once 'components/ads.php'; ?>

  <!-- Page Content -->
  <div class="w-100 d-block d-sm-none"></div>
  <main class="col mx-4">
    <div class="container">
      <div class="row">
        <h1>All Users</h1>

        <hr class="text-secondary my-4">
      </div>

      <!-- users -->
      <div class="row d-flex justify-content-center mb-5">
        <?php
        $total = 0;
        foreach ($allUsers as $user) {

          createUserListing(
            $user->uId,
            $user->userName,
            date("M-d-Y", strtotime($user->dateJoined)),
            date("M-d-Y", strtotime($user->dateLastModified)),
            $user->getName()
          );
          $total++;
        }
        if ($total == 0)
          echo "<div class='col d-flex justify-content-center align-items-center my-5'><h4>No posts found.</h4></div>";
        ?>
      </div>

    </div>
  </main>

  <!-- for ads -->
  </div>
  </div>

</body>

</html>
