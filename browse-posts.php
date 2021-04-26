<?php

@include_once './database/dao/postsDAO.php';
@include_once './utils/displayPosts.php';

// get posts
$posts = new postsDAO();
$allPosts = $posts->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'components/head.php'; ?>

  <title>Browse Posts</title>

  <script type="module" src='./static/js/post.js'></script>
</head>

<body class="fixed-mountain-bg">
  <?php include_once 'components/navbar.php'; ?>
  <?php include_once 'components/ads.php'; ?>

  <!-- Page Content -->
  <div class="w-100 d-block d-sm-none"></div>
  <main class="col mx-4">
    <div class="container">
      <div class="row">
        <h1>All Posts</h1>

        <hr class="text-secondary my-4">
      </div>

      <!-- posts -->
      <div class="row d-flex justify-content-center">
        <?php
        @include_once './database/dao/usersDAO.php';
        $users = new usersDAO();

        $total = 0;
        foreach ($allPosts as $post) {
          // get author
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
