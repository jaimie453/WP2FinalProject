<?php

// if id isnt set, error. else proceed
$postId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $postId = $_GET['id'];
}

// find post
@include_once './utils/displayPosts.php';
@include_once './database/dao/postsDAO.php';
$posts = new postsDAO();
$post = $posts->getById($postId);

// if not found, error
if (is_null($post))
    header('Location: error.php');

// find author
@include_once './database/dao/usersDAO.php';
$users = new usersDAO();
$author = $users->getById($post->uId);

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Post Details</title>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/toast.php'; ?>

    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>
    <?php include_once 'components/ads.php'; ?>

    <main class="col-7">
        <div class="container small-container pe-5 mb-4">
          <!-- title -->
            <div class="row">
                <div class="col d-flex align-items-center">
                    <h2 class="mb-1 d-inline"><?= $post->title ?></h2>
                    <form action="./utils/modifyFavorites.php" method="post" class="d-inline ms-auto">
                        <?php
                        if (!isset($_SESSION['postFavs']))
                            $isFavorited = false;
                        else
                            $isFavorited = in_array($postId, $_SESSION['postFavs']);

                        if ($isFavorited) {
                            echo '<input type="text" value="' . $postId . '" name="postId" hidden />';
                            echo '<button class="btn btn-primary"><i class="fas fa-heart"></i><span class="d-sm-inline d-none"> Unfavorite</span></button>';
                        } else {
                            echo '<input type="text" value="' . $postId . '" name="postId" hidden />';
                            echo '<button class="btn btn-primary"><i class="far fa-heart"></i><span class="d-sm-inline d-none"> Favorite</span></button>';
                        }
                        ?>
                    </form>
                </div>
            </div>

            <!-- author tag -->
            <div class="row">
                <h6 class="text-muted mb-3">
                    By
                    <?php
                    echo '<a href="user.php?id=' . $author->uId . '">';
                    echo $author->getName() . '</a>';
                    ?>
                    on
                    <?= date("M-d-Y", strtotime($post->postTime)) ?>
                </h6>
            </div>

            <!-- post -->
            <div class="row justify-content-between mb-3">
                <?php
                $message = str_replace('<p>', '</p><p>', $post->message);
                $message = str_replace('</p>', '', $message);
                echo '<p>' . $message;
                ?>
            </div>

            <!-- post images -->
            <div class="row d-flex justify-content-center mb-4">
                <h3 class="mb-3">Post Images</h3>

                <?php
                @include_once './database/dao/imagesDAO.php';
                @include_once './utils/displayImage.php';

                // get post images
                $images = new imagesDAO();
                $userImages = $images->getImagesForPost($post->postId);

                $total = 0;
                foreach ($userImages as $userImage) {
                    echo '<div class="d-flex col-xl-4 col-sm-6 col-12 p-3">';

                    createImageCard($userImage->imageId, $userImage->path, $userImage->title, $author->getName());
                    $total++;

                    echo '</div>';
                }

                if ($total == 0)
                    echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

                ?>

            </div>

            <!-- user posts -->
            <div class="row d-flex justify-content-center mb-4">
                <h3 class="mb-3">Other Posts By User</h3>

                <?php
                $userPosts = $posts->getPostsForUser($author->uId);

                $total = 0;
                foreach ($userPosts as $userPost) {
                    // if current post, go to next
                    if ($post->postId == $userPost->postId)
                      continue;

                    createPostListing(
                        $userPost->postId,
                        $author->getName(),
                        $userPost->title,
                        $userPost->message,
                        $userPost->postTime,
                        "col-xl-4 col-sm-6 col-12"
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

</body>

</html>
