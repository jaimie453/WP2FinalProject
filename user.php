<?php

// if user id isnt set, error. else, proceed
$imageId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $uId = $_GET['id'];
}


// get user
@include_once './database/dao/usersDAO.php';
$users = new usersDAO();
$user = $users->getById($uId);

// if not found, error
if (is_null($user))
    header('Location: error.php');

// if private, set to hidden. else, recall
if ($user->privacy == 2) {
    $address = "hidden";
    $postal = "hidden";
    $phone = "hidden";
}
else {
    $address = $user->address;
    $postal = $user->postal;
    $phone = $user->phone;
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>User Profile</title>

</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>

    <main class="col-8 mx-auto">
      <div class="container">
        <div class="row mb-4 justify-content-between">
          <!-- title -->
          <div class="col-xl-4 mb-2">
            <h1><?= $user->getName() ?></h1>
            <h4 class="mb-3"><?= $user->userName ?></h4>
            <h6><?= $user->email ?></h6>
            <h6><?= $phone ?></h6>
          </div>

          <!-- activity -->
          <div class="col-xl-4">
            <p>
              <h3>Activity</h3>
              Member since <?= date("M-d-Y", strtotime($user->dateJoined)) ?><br>
              Last seen on <?= date("M-d-Y", strtotime($user->dateLastModified)) ?>
            </p>
          </div>

          <!-- additional details -->
          <div class="col-xl-4">
            <table class="user-deets mt-3">
              <thead>
                <tr class=""><th colspan="2">
                  <h3 class="">User Details</h3>
                </th></tr>
              </thead>
              <tbody>
                <tr>
                  <td><strong>Address: </strong></td>
                  <td>
                    <?= $address ?>
                  </td>
                </tr>
                <tr>
                  <td><strong>City: </strong></td>
                  <td>
                    <?= $user->city ?>
                  </td>
                </tr>
                <tr>
                  <td><strong>Region: </strong></td>
                  <td>
                    <?php
                      if ($user->region == NULL)
                        echo "n/a";
                      else
                        echo $user->region;
                    ?>
                  </td>
                </tr>
                <tr>
                  <td><strong>Country: </strong></td>
                  <td>
                    <?= $user->country ?>
                  </td>
                </tr>
                <tr>
                  <td><strong>Postal: </strong></td>
                  <td>
                    <?= $postal ?>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>

        </div>

        <!-- user posts -->
        <div class="row d-flex justify-content-center mb-4">
          <h3 class="mb-3">Posts By User</h3>

          <?php
          @include_once './database/dao/postsDAO.php';
          @include_once './utils/displayPosts.php';

          // get posts
          $posts = new postsDAO();
          $userPosts = $posts->getPostsForUser($user->uId);

          $total = 0;
          foreach ($userPosts as $userPost) {
            createPostListing(
                $userPost->postId,
                $user->getName(),
                $userPost->title,
                $userPost->message,
                $userPost->postTime
              );
              $total++;
          }

          if($total == 0)
             echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No posts found.</h4></div>";

          ?>
        </div>

        <!-- user images -->
        <div class="row d-flex justify-content-center mb-4">
          <h3 class="mb-3">User Images</h3>

          <?php
          @include_once './database/dao/imagesDAO.php';
          @include_once './utils/displayImage.php';

          // get images
          $images = new imagesDAO();
          $userImages = $images->getImagesForUser($user->uId);

          $total = 0;
          foreach ($userImages as $userImage) {

            echo '<div class="d-flex col-xl-3 col-md-4 col-sm-6 col-12 p-3">';

            createImageCard($userImage->imageId, $userImage->path, $userImage->title, $user->getName());
            $total++;

            echo '</div>';
          }

          if($total == 0)
            echo "<div class='col d-flex justify-content-center align-items-center my-5'><h4>No images found.</h4></div>";

          ?>

        </div>
      </div>
    </main>

    <!-- for ads -->
    </div>

</body>

</html>
