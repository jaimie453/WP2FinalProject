<?php

// if not set, error. else, proceed
$imageId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $imageId = $_GET['id'];
}

// get image
@include_once './database/dao/imagesDAO.php';
$images = new imagesDAO();
$image = $images->getById($imageId);

// if not found, error
if (is_null($image))
    header('Location: error.php');

// get image info

$largeImgPath = './static/travel-images/large/' . $image->path;

@include_once './database/dao/usersDAO.php';
$users = new usersDAO();
$photographer = $users->getById($image->uId);

@include_once './database/dao/countriesDAO.php';
$countries = new countriesDAO();
$country = $countries->getById($image->countryCodeISO);

@include_once './database/dao/citiesDAO.php';
$cities = new citiesDAO();
$city = $cities->getById($image->cityCode);

@include_once './database/dao/postsDAO.php';
$posts = new postsDAO();
$post = $posts->getById($image->postId);

@include_once './database/dao/reviewsDAO.php';
$reviews = new reviewsDAO();
$imageReviews = $reviews->getReviewsForImage($imageId);


@include_once './utils/displayImage.php';
@include_once './utils/ratingsToStars.php';

$fullWidthImageColumns = "col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12";

// modify column display depending on coords
$mapContainerClasses = "col-lg-6 mb-5";
$otherImagePostsContainerClasses = "col-lg-6";
$otherImagePostsColumns = "col-xl-6 col-lg-12 col-md-4 col-sm-6 col-12";
if (is_null($image->longitude) || is_null($image->latitude)) {
    $mapContainerClasses = "d-none";
    $otherImagePostsContainerClasses = "col";
    $otherImagePostsColumns = $fullWidthImageColumns;
}


function createReviewListing($review, $rating, $authorName, $userId)
{
    echo '<div class="review-listing">';

    echo '<div class="mb-2">';
    echo '<h6 class="d-inline">' . $authorName . '</h6>';

    // add administrator/current user check here
    echo '<button class="delete-review-btn button-no-style"><i class="far fa-trash-alt"></i></button>';
    echo '<input value="' . $userId . '" hidden>';

    echo '<span class="float-end">' . convertRatingToStars(round($rating * 2)) . '</span>';
    echo '</div>';

    echo '<p>' . $review . '</p>';

    echo '</div>';
}
 

?>


<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Image Details</title>

    <script src='./static/js/image.js'></script>
    <script src="./static/js/map.js"></script>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/toast.php'; ?>

    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-3 mb-5 px-lg-5">
        <div class="row mb-5">
            <div class="col-lg-6 p-xl-5 mb-5">
                <!-- Image Card -->
                <div class="card" id="image-page-card">
                    <button type="button" class="button-no-style button-no-animation" data-bs-toggle="modal" data-bs-target="#lightbox">
                        <img src="<?= $largeImgPath ?>" class="card-img-top" alt="...">
                    </button>

                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $image->title ?>
                            <span class="float-end text-muted">
                                <?php

                                // if info exists, print
                                if (!is_null($city))
                                    echo '<a href="city.php?id=' . $city->geoNameId . '">' . $city->asciiName . '</a>';
                                if (!is_null($city) && !is_null($country))
                                    echo ', ';
                                if (!is_null($country))
                                    echo '<a href="country.php?id=' . $country->iso . '">' . $country->countryName . '</a>';

                                ?>
                            </span>
                        </h5>

                        <a href="user.php?id=<?= $photographer->uId ?>">
                            <h6 class="card-subtitle mb-2 text-muted"><?= $photographer->getName() ?></h6>
                        </a>

                        <p class="card-text"><?= $image->description ?></p>

                        <form action="./utils/modifyFavorites.php" method="post" class="d-inline">
                            <?php

                            // check if image is favorited
                            if (!isset($_SESSION['imageFavs']))
                                $isFavorited = false;
                            else
                                $isFavorited = in_array($imageId, $_SESSION['imageFavs']);

                            if ($isFavorited) {
                                echo '<input type="text" value="' . $imageId . '" name="imageId" hidden />';
                                echo '<button class="btn btn-primary"><i class="fas fa-heart"></i> Unfavorite</button>';
                            } else {
                                echo '<input type="text" value="' . $imageId . '" name="imageId" hidden />';
                                echo '<button class="btn btn-primary"><i class="far fa-heart"></i> Favorite</button>';
                            }

                            ?>
                        </form>

                        <a class="btn btn-secondary float-end" href="post.php?id=<?= $post->postId ?>">
                            View Post
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reviews card -->
            <div class="col-lg-6 p-xl-5">
                <div class="card" id="review-card">
                    <div class="card-header">
                        <?php

                        // if ratings exist, show average. else, print error
                        if ($image->totalRatings > 0) {
                            echo '<h3 class="d-inline m-0">Reviews (' . $image->totalRatings . ')</h3>';
                            echo '<span>' . convertRatingToStars(round($image->avgRating * 2)) . '</span>';
                        } else {
                            echo '<h3 class="d-inline m-0">Reviews</h3>';
                            echo '<span class="text-muted">No ratings yet</span>';
                        }

                        ?>
                    </div>

                    <?php

                    if ($image->totalRatings > 0) {
                        echo '<div class="card-body">';

                        foreach ($imageReviews as $review) {
                            $author = $users->getById($review->uId);
                            createReviewListing($review->review, $review->rating, $author->getName(), $author->uId);
                        }

                        echo '</div>';
                    }

                    ?>
                    <!-- Add check if user has rated post or not -->
                    <div class="card-footer">
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#reviewModal">Leave a review</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mb-5">
            <!-- Google Maps -->
            <div class="<?= $mapContainerClasses ?>">
                <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                Show Map
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                <div id="map" data-map-longitude="<?= $image->longitude ?>" data-map-latitude="<?= $image->latitude ?>"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Other Images from Same Post -->
            <div class="<?= $otherImagePostsContainerClasses ?>">
                <div class="container-fluid p-0">
                    <div class="row text-lg-end">
                        <h3>Other Images from
                            <a href="post.php?id=<?= $post->postId ?>">
                                <i style="color: currentColor;"><?= $post->title ?></i>
                            </a>
                        </h3>
                    </div>

                    <div class="row justify-content-lg-end">
                        <?php

                        // get images from same post
                        $postImages = $images->getImagesForPost($image->postId);

                        foreach ($postImages as $postImage) {
                            // if same image that post was found from, skip
                            if ($postImage->imageId == $imageId)
                                continue;

                            // get author
                            $user = $users->getById($postImage->uId);

                            echo '<div class="p-3 d-flex ' . $otherImagePostsColumns . '">';
                            createImageCard($postImage->imageId, $postImage->path, $postImage->title, $user->getName());
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Other Images from Country -->
        <div class="row">
            <h3>
                More Images from
                <a href="country.php?id=<?= $country->iso ?>">
                    <?= $country->countryName ?>
                </a>
            </h3>
        </div>

        <div class="row">
            <?php

            // get images from same country
            $countryImages = $images->getImagesForCountry($image->countryCodeISO);

            foreach ($countryImages as $countryImage) {
                // if current image, skip
                if ($countryImage->imageId == $imageId)
                    continue;

                // get user
                $user = $users->getById($countryImage->uId);

                echo '<div class="p-3 d-flex ' . $fullWidthImageColumns . '">';
                createImageCard($countryImage->imageId, $countryImage->path, $countryImage->title, $user->getName());
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Add Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="utils/addReview.php" method="post">
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="ratingRange" class="form-label">Rating</label>
                            <span class="float-end" id="review-rating-stars"> <?= convertRatingToStars(6) ?> </span>
                            <input type="range" class="form-range" min="1" max="5" id="ratingRange" name="reviewRating">
                        </div>
                        <div class="mb-3">
                            <label for="reviewTextarea" class="form-label">Review</label>
                            <textarea class="form-control" id="reviewTextarea" rows="3" name="reviewText"></textarea>
                        </div>
                        <input name="imageId" value="<?= $imageId ?>" hidden>
                        <!-- add session id here -->
                        <input name="userId" value="1" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <!-- Delete Review Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="utils/deleteReview.php" method="post">
                    <div class="modal-body">
                        <p>Are you sure you want to delete this review?</p>
                        <input name="imageId" value="<?= $imageId ?>" hidden>
                        <!-- add session id here -->
                        <input id="deleteReviewUserId" name="userId" value="1" hidden>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Lightbox -->
    <div class="modal fade" id="lightbox" tabindex="-1" aria-labelledby="lightboxLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center mw-100">
            <div>
                <img src="<?= $largeImgPath ?>" id="lightbox-img" alt="...">
            </div>
        </div>
    </div>

    <!-- Google Maps -->
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOY5BOnwhmmXeVB6eQRUUJuOdHaNMFnug&callback=initMap&libraries=&v=weekly" async></script>
</body>

</html>