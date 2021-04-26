<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Favorites</title>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>

    <div class="col container mb-5">
        <div class="row mb-5">
            <h1 class="ms-4">My Favorites</h1>
        </div>
        <div class="row">
            <!-- images -->
            <div class="col-12 col-lg-6">
                <div class="container-fluid mb-5 mb-lg-0">
                    <div class="row justify-content-center">
                        <?php

                        // if none set, print error message
                        if (!isset($_SESSION['imageFavs']) || count($_SESSION['imageFavs']) == 0)
                            echo "<h5>You haven't favorited any images yet.</h5>";
                        else {
                            @include_once './database/dao/imagesDAO.php';
                            @include_once './database/dao/usersDAO.php';
                            @include_once './utils/displayImage.php';

                            $users = new usersDAO();
                            $images = new imagesDAO();

                            // get favorited images
                            $imageIds = $_SESSION['imageFavs'];

                            foreach ($imageIds as $imageId) {
                                // get image and author
                                $image = $images->getById($imageId);
                                $photographer = $users->getById($image->uId);

                                echo '<div class="p-3 d-flex col-xl-6 col-lg-12 col-md-6 col-12">';
                                createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());
                                echo '</div>';
                            }
                        }


                        ?>
                    </div>
                </div>
            </div>

            <!-- posts -->
            <div class="col-12 col-lg-6">
                <div class="container-fluid mb-5 mb-lg-0">
                    <div class="row justify-content-center">
                        <?php

                        // if none set, print error message
                        if (!isset($_SESSION['postFavs']) || count($_SESSION['postFavs']) == 0)
                            echo "<h5>You haven't favorited any posts yet.</h5>";
                        else {
                            @include_once './database/dao/postsDAO.php';
                            @include_once './database/dao/usersDAO.php';
                            @include_once './utils/displayPosts.php';

                            $users = new usersDAO();
                            $posts = new postsDAO();

                            // get favorited posts
                            $postIds = $_SESSION['postFavs'];

                            foreach ($postIds as $postId) {
                                // find post and author
                                $post = $posts->getById($postId);
                                $author = $users->getById($post->uId);

                                createPostListing(
                                    $post->postId,
                                    $author->getName(),
                                    $post->title,
                                    $post->message,
                                    $post->postTime,
                                    $columns = "col-xl-6 col-lg-12 col-md-6 col-12"
                                );
                            }
                        }


                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- for ads -->
    </div>
    </div>

</body>

</html>
