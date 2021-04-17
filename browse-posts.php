<?php

@include_once './database/dao/postsDAO.php';
@include_once './utils/displayPosts.php';

$posts = new postsDAO();
$allPosts = $posts->getAll();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include 'components/head.php'; ?>

  <title>Browse Posts</title>

</head>

<body class="fixed-mountain-bg">
  <?php include_once 'components/toast.php'; ?>

  <header>
    <?php include_once 'components/navbar.php'; ?>
  </header>

  <!-- Page Content -->
  <main>
    <div class="container">
      <div class="row pt-5 mx-5">
        <h1>All Posts</h1>

        <hr class="text-secondary my-4">
      </div>

      <div class="row d-flex justify-content-center px-5">
        <?php
        @include_once './database/dao/usersDAO.php';
        $users = new usersDAO();

        $total = 0;
        foreach ($allPosts as $post) {
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
          echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No posts found.</h4></div>";
        ?>
      </div>

    </div>
  </main>

</body>

</html>
