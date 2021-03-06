<?php

@include_once './database/dao/imagesDAO.php';
@include_once './utils/ratingsToStars.php';

$images = new imagesDAO();

// find images for dropdown boxes
$topImages = $images->getTopImages(5);
$newImages = $images->getNewestImages(5);

// creates image item given params
function createImageListItem($title, $avgRating, $totalRatings, $id)
{
    echo '<li class="list-group-item d-flex justify-content-between">';
    echo '<a href="image.php?id=' . $id . '">' . $title . '</a>';
    if ($totalRatings == 0)
        echo '<span class="align-self-center flex-shrink-0 ms-3">No ratings yet.</span>';
    else
        echo '<span class="align-self-center flex-shrink-0 ms-3">' . convertRatingToStars(round($avgRating * 2)) . '</span>';
    echo '</li>';
}

@include_once './database/dao/reviewsDAO.php';
$reviews = new reviewsDAO();
$recentReviews = $reviews->getMostRecentReviews();

// for latest reviews, shows review given params
function createReviewListItem($imgTitle, $imageId, $rating, $review, $authorName, $reviewTime, $userId)
{
    echo '<li class="list-group-item">';

    echo '<div class="d-flex justify-content-between mb-2">';
    echo '<a href="image.php?id=' . $imageId . '">' . $imgTitle . '</a>';
    echo '<span class="align-self-center flex-shrink-0 ms-3">' . convertRatingToStars(round($rating * 2)) . '</span>';
    echo '</div>';

    echo '<p class="recent-review-text">' . $review . '</p>';

    echo '<div class="text-muted">';
    echo '<a class="link-no-color" href="user.php?id=' . $userId . '">By ' . $authorName . '</a>';
    echo '<span class="float-end">' . $reviewTime . '</span>';
    echo '</div>';

    echo '</li>';
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Home</title>

    <script src="./static/js/home.js"></script>
</head>

<body>
    <?php include_once 'components/navbar.php'; ?>

    <div>
    <!-- dropdown boxes -->
    <div class="container-fluid mt-2 position-relative" style="z-index: 1;">
        <div class="row">
            <div class="col d-flex justify-content-end">
                <button class="btn btn-primary me-1" id="recent-reviews-button" type="button">
                    Recent Reviews
                </button>
                <button class="btn btn-primary me-1" id="top-images-button" type="button">
                    Top Images
                </button>
                <button class="btn btn-primary" id="new-images-button" type="button">
                    New Images
                </button>
            </div>
        </div>
        <div class="row mt-3 justify-content-end" id="images-container" style="display: none;">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card card-body" id="top-images-list" style="display: none;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="d-inline">Top Images</h5>
                            <button class="images-group-close">Close</button>
                        </li>

                        <?php

                        foreach ($topImages as $image)
                            createImageListItem($image->title, $image->avgRating, $image->totalRatings, $image->imageId);

                        ?>
                    </ul>
                </div>
                <div class="card card-body" id="new-images-list" style="display: none;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="d-inline">New Images</h5>
                            <button class="images-group-close">Close</button>
                        </li>
                        <?php

                        foreach ($newImages as $image)
                            createImageListItem($image->title, $image->avgRating, $image->totalRatings, $image->imageId);

                        ?>
                    </ul>
                </div>
                <div class="card card-body" id="recent-reviews-list" style="display: none;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <h5 class="d-inline">Recent Reviews</h5>
                            <button class="images-group-close">Close</button>
                        </li>

                        <?php

                        @include_once './database/dao/usersDAO.php';

                        $users = new usersDAO();

                        foreach ($recentReviews as $review) {
                            $image = $images->getById($review->imageId);
                            $author = $users->getById($review->uId);

                            createReviewListItem($image->title, $image->imageId, $review->rating,
                                $review->review, $author->getName(), $review->getReviewDate(), $author->uId);
                        }


                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- carousel -->
    <div id="home-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#home-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#home-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#home-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="static/travel-images/carousel/city.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <a>
                        <a href="country.php?id=IT">
                            <h5>Browse Countries</h5>
                        </a>
                    </a>
                    <p>Image courtesy of <a href="https://www.pexels.com/photo/reflection-of-buildings-on-body-of-water-1121782/">Pawel L.</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="static/travel-images/carousel/road.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <a>
                        <a href="browse-posts.php">
                            <h5>Browse Posts</h5>
                        </a>
                    </a>
                    <p>Image courtesy of <a href="https://www.pexels.com/photo/empty-road-along-the-mountain-2739013/">Mads Thomsen.</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="static/travel-images/carousel/mountain.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <a>
                        <a href="browse-images.php">
                            <h5>Browse Images</h5>
                        </a>
                    </a>
                    <p>Image courtesy of <a href="https://www.pexels.com/photo/white-and-brown-mountain-under-gray-clouds-5409751/">Brady Knoll.</a></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#home-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- left ad -->
    <img id="carousel-left-ad"
      src="./static/ads/travel guide cropped.jpg" alt="ad here">

  </div>

  <!-- bottom ad script -->
  <script type="text/javascript" src="./static/js/homeBottomAd.js"></script>

</body>

</html>
