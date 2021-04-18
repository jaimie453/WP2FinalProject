<?php

$postId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $postId = $_GET['id'];
}

@include_once './utils/displayPosts.php';
@include_once './database/dao/postsDAO.php';
$posts = new postsDAO();
$post = $posts->getById($postId);

if (is_null($post))
    header('Location: error.php');

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

    <main class="pt-4">
        <div class="container small-container px-5 mb-4">
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
                            echo '<button class="btn btn-primary"><i class="fas fa-heart"></i> Unfavorite</button>';
                        } else {
                            echo '<input type="text" value="' . $postId . '" name="postId" hidden />';
                            echo '<button class="btn btn-primary"><i class="far fa-heart"></i> Favorite</button>';
                        }
                        ?>
                    </form>
                </div>
            </div>

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


            <div class="row justify-content-between">
                <?php
                $message = str_replace('<p>', '</p><p>', $post->message);
                $message = str_replace('</p>', '', $message);
                echo '<p>' . $message;
                ?>
            </div>

            <div class="row d-flex justify-content-start mb-4">
                <h3 class="mb-3">Post Images</h3>

                <?php
                @include_once './database/dao/imagesDAO.php';
                @include_once './utils/displayImage.php';

                $images = new imagesDAO();
                $userImages = $images->getImagesForPost($post->uId);

                @include_once './database/dao/usersDAO.php';
                $users = new usersDAO();

                $total = 0;
                foreach ($userImages as $userImage) {

                    echo '<div class="d-flex col-xl-4 col-sm-6 col-12 p-3">';

                    $photographer = $users->getById($userImage->uId);
                    createImageCard($userImage->imageId, $userImage->path, $userImage->title, $photographer->getName());
                    $total++;

                    echo '</div>';
                }

                if ($total == 0)
                    echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

                ?>

            </div>

            <div class="row d-flex justify-content-start mb-4">
                <h3 class="mb-3">Other Posts By User</h3>

                <?php
                $userPosts = $posts->getPostsForUser($author->uId);

                $total = 0;
                foreach ($userPosts as $userPost) {
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
                    echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No posts found.</h4></div>";

                ?>
            </div>
        </div>
    </main>
</body>

</html>