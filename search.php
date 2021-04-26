<?php
// find if any fields are set, set defaults

$continentId = "%";
if (isset($_GET['continentId']) && $_GET['continentId'] != "NULL")
    $continentId = $_GET['continentId'];

$query = '%';
if (isset($_GET['query']) && $_GET['query'] != "NULL")
  $query = $_GET['query'];

$type = "both";
if (isset($_GET['type']) && $_GET['type'] != "NULL")
  $type = $_GET['type'];

$sortAsc = "true";
if (isset($_GET['sortAsc']) && $_GET['sortAsc'] != "NULL")
  $sortAsc = $_GET['sortAsc'];

$cityId = "%";
if (isset($_GET['cityId']) && $_GET['cityId'] != "NULL")
  $cityId = $_GET['cityId'];

$countryId = "%";
if (isset($_GET['countryId']) && $_GET['countryId'] != "NULL")
  $countryId = $_GET['countryId'];

// get users for author names
@include_once './database/dao/usersDAO.php';
$users = new usersDAO();

?>

<!doctype html>
<html lang="en">

<head>
  <?php include 'components/head.php'; ?>

  <title>Search Results</title>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>

    <main class="col-7 col-sm pe-4">
      <div class="container">
        <div class="row mb-4">
          <h3 class="results-header mb-2">Results</h3>

          <!-- sorter -->
          <div class="dropdown sorter">
            <button class="btn btn-secondary btn-sm sort dropdown-toggle" href="#" id="sortDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              Sort
            </button>
            <form class="dropdown-menu" aria-labelledby="sortDropdown">
              <li><a class="dropdown-item"
                    href="<?php
                      echo $search . '?';
                      echo 'continentId=' . $continentId;
                      echo '&query=' . $query;
                      echo '&type=' . $type;
                      echo '&city=' . $cityId;
                      echo '&country=' . $countryId;
                    ?>&sortAsc=true">
                  Ascending
                </a></li>
              <li><a class="dropdown-item"
                    href="<?php
                      echo $search . '?';
                      echo 'continentId=' . $continentId;
                      echo '&query=' . $query;
                      echo '&type=' . $type;
                      echo '&city=' . $cityId;
                      echo '&country=' . $countryId;
                    ?>&sortAsc=false">
                  Descending
                </a></li>
            </form>
          </div>

        </div>

        <!-- results -->

        <!-- post results (if selected) -->
        <?php
        if ($type == "both" || $type == "post") {
          echo '<div class="row d-flex justify-content-center mb-4">
            <h3 class="mb-3">Posts</h3>';

          // find posts
          @include_once './database/dao/postsDAO.php';
          $posts = new postsDAO();
          $resultPosts = $posts->searchPostTitles($query, $sortAsc);

          // iterate through results
          $total = 0;
          if ($resultPosts) {
            @include_once './utils/displayPosts.php';
            foreach ($resultPosts as $post) {
                // find author
                $author = $users->getById($post->uId);

                createPostListing(
                  $post->postId,
                  $author->getName(),
                  $post->title,
                  $post->message,
                  $post->postTime
                );
                $total++;
            }
          }

          if($total == 0)
             echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No posts found.</h4></div>";

          echo '</div>';
        }
        ?>

        <!-- image results (if selected) -->
        <?php
        if ($type == "both" || $type == "image") {
          echo '<div class="row d-flex justify-content-center mb-4">
            <h3 class="mb-3">Images</h3>';

          // find images
          @include_once './database/dao/imagesDAO.php';
          $images = new imagesDAO();
          $resultImages = $images->searchImageTitles($query, $cityId, $countryId, $continentId, $sortAsc);

          // iterate through results
          $total = 0;
          if ($resultImages) {
            @include_once './utils/displayImage.php';
            foreach ($resultImages as $image) {
              echo '<div class="d-flex col-xl-3 col-md-4 col-sm-6 col-12 p-3">';

              // find author
              $author = $users->getById($image->uId);

              createImageCard(
                $image->imageId,
                $image->path,
                $image->title,
                $author->getName(),
                false
              );
              $total++;

              echo '</div>';
            }
          }

          if($total == 0)
            echo "<div class='col d-flex justify-content-center align-items-center my-5'><h4>No images found.</h4></div>";

          echo '</div>';
        }
        ?>

      </div>

  </main>

  <!-- for ads -->
  </div>

</body>

</html>
