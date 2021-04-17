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
        <div class="row px-5 mb-4">
            <h2 class="mb-3"><?= $post->title ?></h2>

            <div class="row justify-content-between">
                <div class="col-md-7 text-wrap lh-sm me-3">
                    <?php
                    $message = str_replace('<p>', '</p><p>', $post->message);
                    $message = str_replace('</p>', '', $message);
                    echo '<p>' . $message;
                    ?>
                </div>

                <div class="col-md-4">
                    <form action="./utils/modifyFavorites.php" method="post" class="d-inline">
                        <?php
                        if(!isset($_SESSION['postFavs']))
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

                    <table class="table table-borderless">
                        <thead>
                            <tr class="border">
                                <th colspan="2">
                                    <h6 class="p-2 pb-1">Post Details</h6>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border">
                                <td><strong>&nbsp;&nbsp;Date: </strong></td>
                                <td>
                                    <?= date("M-d-Y", strtotime($post->postTime)) ?>
                                </td>
                            </tr>
                            <tr class="border">
                                <td><strong>&nbsp;&nbsp;Posted By: </strong></td>
                                <td>
                                    <?php
                                    echo '<a href="user.php?id=' . $author->uId . '">';
                                    echo $author->getName() . '</a>';
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-start mb-4 px-5">
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

                echo '<div class="d-flex col-xl-2 col-md-3 col-sm-4 col-6 p-3">';

                $photographer = $users->getById($userImage->uId);
                createImageCard($userImage->imageId, $userImage->path, $userImage->title, $photographer->getName());
                $total++;

                echo '</div>';
            }

            if ($total == 0)
                echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

            ?>

        </div>

        <div class="row d-flex justify-content-start mb-4 px-5">
            <h3 class="mb-3">Other Posts By User</h3>

            <?php
            $userPosts = $posts->getPostsForUser($author->uId);

            $total = 0;
            foreach ($userPosts as $userPost) {
                otherUserPost(
                    $userPost->postId,
                    $author->getName(),
                    $userPost->title,
                    $userPost->message,
                    $userPost->postTime
                );
                $total++;
            }

            if ($total == 0)
                echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No posts found.</h4></div>";

            ?>
        </div>

    </main>
</body>

</html>