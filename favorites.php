<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Favorites</title>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/toast.php'; ?>

    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row mb-5">
            <h1>My Favorites</h1>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="container-fluid mb-5 mb-lg-0">
                    <div class="row">
                        <?php

                        if (!isset($_SESSION['imageFavs']) || count($_SESSION['imageFavs']) == 0)
                            echo "<h5>You haven't favorited any images yet.</h5>";
                        else {
                            @include_once './database/dao/imagesDAO.php';
                            @include_once './database/dao/usersDAO.php';
                            @include_once './utils/displayImage.php';

                            $users = new usersDAO();
                            $images = new imagesDAO();

                            $imageIds = $_SESSION['imageFavs'];

                            foreach ($imageIds as $imageId) {
                                $image = $images->getById($imageId);

                                echo '<div class="p-3 d-flex col-lg-6 col-12">';
                                $photographer = $users->getById($image->uId);
                                createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());
                                echo '</div>';
                            }
                        }


                        ?>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="container-fluid mb-5 mb-lg-0">
                    <div class="row">
                        <?php

                        if (!isset($_SESSION['postFavs']) || count($_SESSION['postFavs']) == 0)
                            echo "<h5>You haven't favorited any posts yet.</h5>";
                        else {
                            @include_once './database/dao/postsDAO.php';
                            @include_once './database/dao/usersDAO.php';
                            @include_once './utils/displayPosts.php';

                            $users = new usersDAO();
                            $posts = new postsDAO();

                            $postIds = $_SESSION['postFavs'];

                            foreach ($postIds as $postId) {
                                $post = $posts->getById($postId);
                                $author = $users->getById($post->uId);

                                createPostListing(
                                    $post->postId,
                                    $author->getName(),
                                    $post->title,
                                    $post->message,
                                    $post->postTime,
                                    $columns = "col-lg-6 col-md-4 col-sm-6 col-12"
                                );
                            }
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>