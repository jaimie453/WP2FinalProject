<?php

@include_once './database/dao/usersDAO.php';

// get users
$users = new usersDAO();
$allUsers = $users->getAll();

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <?php if (!isset($_SESSION['user'])) header('Location: error.php'); ?>

    <title>Modify Users</title>

    <script src="./static/js/search.js"></script>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>

    <!-- Page Content -->
    <div class="w-100 d-block d-sm-none"></div>
    <main class="col mx-4">
      <div class="container">
        <div class="row">
          <h1>Modify Users</h1>

          <hr class="text-secondary my-4">
        </div>

        <!-- users -->
        <div class="row d-flex justify-content-center mb-5">
          <?php
          echo '<table class="table">';

          echo '<thead><tr>';
          echo '<th scope="col">Username</th>';
          echo '<th scope="col">Admin</th>';
          echo '<th scope="col">Name</th>';
          echo '<th scope="col">Privacy</th>';
          echo '</thead></tr>';

          echo '<tbody>';
          $total = 0;
          foreach ($allUsers as $user) {
            echo '<tr>';
            echo '<td>' . $user->userName . '</td>';
            if ($user->state == 1) {
              echo '<td>yes</td>';
            }
            else {
              echo '<td>no</td>';
            }
            echo '<td>' . $user->getName() . '</td>';
            if ($user->privacy == 2) {
              echo '<td>yes</td>';
            }
            else {
              echo '<td>no</td>';
            }
            echo '</tr>';

            $total++;
          }
          echo '</tbody>';

          if ($total == 0)
            echo "<div class='col d-flex justify-content-center align-items-center my-5'><h4>No users found.</h4></div>";
          ?>
        </div>

      </div>
    </main>

    <!-- for ads -->
    </div>
    </div>

</body>

</html>
