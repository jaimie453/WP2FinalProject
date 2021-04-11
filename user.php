<?php

$imageId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $uId = $_GET['id'];
}


@include_once './database/dao/usersDAO.php';
$users = new usersDAO();
$user = $users->getById($uId);


if (is_null($user))
    header('Location: error.php');

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
    <?php include_once 'components/toast.php'; ?>

    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <main class="pt-4">
      <div class="row px-5 mb-4 justify-content-between">
        <div class="col-xl-4 mb-2">
          <h1><?= $user->getName() ?></h1>
          <h4 class="mb-3"><?= $user->userName ?></h4>
          <h6><?= $user->email ?></h6>
          <h6><?= $phone ?></h6>
        </div>

        <div class="col-xl-4">
          <p>
            <h3>Activity</h3>
            Member since <?= date("M-d-Y", strtotime($user->dateJoined)) ?><br>
            Last seen on <?= date("M-d-Y", strtotime($user->dateLastModified)) ?>
          </p>
        </div>

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

      <div class="row d-flex justify-content-start mb-4 px-5">
        <h3 class="mb-3">Other Posts By User</h3>

        <?php
        @include_once './database/dao/postsDAO.php';
        @include_once './utils/displayPosts.php';

        $posts = new postsDAO();
        $userPosts = $posts->getPostsForUser($user->uId);

        $total = 0;
        foreach ($userPosts as $userPost) {
            otherUserPost(
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

      <div class="row d-flex justify-content-start mb-4 px-5">
        <h3 class="mb-3">User Images</h3>

        <?php
        @include_once './database/dao/imagesDAO.php';
        @include_once './utils/createCard.php';

        $images = new imagesDAO();
        $userImages = $images->getImagesForUser($user->uId);

        $total = 0;
        foreach ($userImages as $userImage) {

          echo '<div class="d-flex col-xl-2 col-md-3 col-sm-4 col-6 p-3">';

          createImageCard($userImage->imageId, $userImage->path, $userImage->title, $user->getName());
          $total++;

          echo '</div>';
        }

        if($total == 0)
          echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

        ?>

      </div>

    </main>

</body>

</html>