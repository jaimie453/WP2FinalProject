<?php

$query = '%';
if (isset($_GET['query']) && $_GET['query'] != "NULL")
  $query = $_GET['query'];

$type = "both";
if (isset($_GET['type']) && $_GET['type'] != "NULL")
  $type = $_GET['type'];

$sortAsc = "true";
if (isset($_GET['sortAsc']) && $_GET['sortAsc'] != "NULL")
  $sortAsc = $_GET['sortAsc'];

@include_once './database/dao/usersDAO.php';
$users = new usersDAO();


$cityId = "%";
if (isset($_GET['cityId']) && $_GET['cityId'] != "NULL")
  $cityId = $_GET['cityId'];

$countryId = "%";
if (isset($_GET['countryId']) && $_GET['countryId'] != "NULL")
  $countryId = $_GET['countryId'];
?>

<!doctype html>
<html lang="en">

<head>
  <?php include 'components/head.php'; ?>

  <title>Search Results</title>

  <script src="./static/js/map.js"></script>
</head>

<body class="fixed-mountain-bg">
  <?php include_once 'components/toast.php'; ?>

  <header>
    <?php include_once 'components/navbar.php'; ?>
  </header>

  <main class="pt-4 px-5">
    <div class="row mb-4">
      <h3 class="col-2">Results</h3>
      <div class="col-1 dropdown sorter">
        <button class="btn btn-secondary btn-sm sort dropdown-toggle" href="#" id="sortDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          Sort
        </button>
        <form class="dropdown-menu" aria-labelledby="sortDropdown">
          <li><a class="dropdown-item" href="<?= $search ?>?query=calgary&sortAsc=true&type=<?= $type ?>">
              Ascending
            </a></li>
          <li><a class="dropdown-item" href="<?= $search ?>?query=calgary&sortAsc=false&type=<?= $type ?>">
              Descending
            </a></li>
        </form>
      </div>
    </div>

    <?php
    if ($type == "both" || $type == "post") {
      echo '<div class="row d-flex justify-content-start mb-4">
          <h3 class="mb-3">Posts</h3>';

      @include_once './database/dao/postsDAO.php';
      $posts = new postsDAO();
      $resultPosts = $posts->searchPostTitles($query, $sortAsc);

      $total = 0;
      if ($resultPosts) {
        @include_once './utils/displayPosts.php';
        foreach ($resultPosts as $post) {
          $author = $users->getById($post->uId);
          otherUserPost(
            $post->postId,
            $author->getName(),
            $post->title,
            $post->message,
            $post->postTime
          );
          $total++;
        }
      }

      if ($total == 0)
        echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No posts found.</h4></div>";

      echo '</div>';
    }
    ?>

    <?php
    if ($type == "both" || $type == "image") {
      echo '<div class="row d-flex justify-content-start mb-4">
          <h3 class="mb-3">Images</h3>';

      @include_once './database/dao/imagesDAO.php';
      $images = new imagesDAO();
      $resultImages = $images->searchImageTitles($query, $cityId, $countryId, $sortAsc);

      $total = 0;
      if ($resultImages) {
        @include_once './utils/displayImage.php';
        foreach ($resultImages as $image) {
          echo '<div class="d-flex col-xl-2 col-md-3 col-sm-4 col-6 p-3">';

          $author = $users->getById($image->uId);
          createImageCard(
            $image->imageId,
            $image->path,
            $image->title,
            $author->getName()
          );
          $total++;

          echo '</div>';
        }
      }

      if ($total == 0)
        echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

      echo '</div>';
    }
    ?>



  </main>

</body>

</html>