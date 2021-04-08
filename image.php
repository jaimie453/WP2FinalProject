<?php

$imageId = -1;
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $imageId = $_GET['id'];
}


@include_once './database/dao/imagesDAO.php';
$images = new imagesDAO();
$image = $images->getById($imageId);


if (is_null($image))
    header('Location: error.php');

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

@include_once './utils/createCard.php';
$boxColumnWidths = "col-lg-2 col-md-3 col-sm-4 col-6";

@include_once './utils/ratingsToStars.php';

$fullWidthImageColumns = "col-xl-2 col-lg-3 col-md-4 col-6";

$mapContainerClasses = "col-lg-6 mb-5";
$otherImagePostsContainerClasses = "col-lg-6";
$otherImagePostsColumns = "col-xl-4 col-lg-6 col-md-4 col-6";
if(is_null($image->longitude) || is_null($image->latitude)) {
    $mapContainerClasses = "d-none";
    $otherImagePostsContainerClasses = "col";
    $otherImagePostsColumns = $fullWidthImageColumns;
}


?>


<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Image Details</title>

    <!-- equalize image and review box heights -->
    <script src='./static/js/image.js'></script>
    <script src="./static/js/map.js"></script>
</head>

<body class="fixed-mountain-bg">
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-3 mb-5 p-lg-5">
        <div class="row mb-5">
            <div class="col-lg-6 p-xl-5 mb-5">
                <!-- Image Card -->
                <div class="card" id="image-page-card">
                    <img src="<?= $largeImgPath ?>" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $image->title ?>
                            <span class="float-end text-muted">
                                <?php

                                if(!is_null($city))
                                    echo '<a href="city.php?id=' . $city->geoNameId . '">' . $city->asciiName . '</a>';
                                if(!is_null($city) && !is_null($country))
                                    echo ', ';
                                if(!is_null($country))
                                    echo '<a href="country.php?id=' . $country->iso . '">' . $country->countryName . '</a>';

                                ?>
                            </span>
                        </h5>

                        <a href="user.php?id=<?= $photographer->uId ?>">
                            <h6 class="card-subtitle mb-2 text-muted"><?= $photographer->getName() ?></h6>
                        </a>

                        <p class="card-text"><?= $image->description ?></p>

                        <button class="btn btn-primary">Add to favorites</button>

                        <a class="btn btn-secondary float-end" href="post.php?id=<?= $post->postId ?>">
                            View post
                        </a>
                    </div>
                </div>
            </div>

            <!-- Reviews card -->
            <div class="col-lg-6 p-xl-5">
                <div class="card" id="review-card">
                    <div class="card-header">
                        <?php

                        if($image->totalRatings > 0) {
                            echo '<h3 class="d-inline m-0">Reviews (' . $image->totalRatings . ')</h3>';
                            echo '<span>' . convertRatingToStars(round($image->avgRating * 2)) . '</span>';
                        } else {
                            echo '<h3 class="d-inline m-0">Reviews</h3>';
                            echo '<span class="text-muted">No ratings yet</span>';
                        }

                        ?>
                    </div>

                    <?php 

                    if($image->totalRatings > 0) {
                    echo '<div class="card-body">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris sit amet libero lorem. Vivamus placerat leo at eleifend venenatis. Mauris sed elit porttitor, auctor ligula ut, imperdiet felis. Morbi eu risus massa. Vivamus nisl tortor, scelerisque at elit malesuada, semper pellentesque nulla. Integer sit amet condimentum massa. Proin consectetur sed orci sed aliquam. Integer quis est pharetra erat ullamcorper condimentum eget a elit. Mauris euismod nunc ut diam porttitor, malesuada mattis ipsum condimentum. Interdum et malesuada fames ac ante ipsum primis in faucibus.

                            Aenean venenatis eleifend lacinia. Suspendisse et purus vitae elit tempus mattis. Donec at porta elit. Sed rutrum quam ut risus tincidunt congue. Suspendisse accumsan, nunc et sagittis blandit, enim leo commodo neque, eget blandit erat magna quis metus. Mauris molestie lacus ac risus pharetra, ac pharetra leo tristique. Curabitur non dolor et eros ultrices consectetur. Sed luctus lacinia tincidunt. Nulla et tellus a nisi semper feugiat ut et ligula. In eget venenatis ligula. Etiam sodales, libero id auctor iaculis, augue urna blandit felis, vel ultricies dui ligula vel orci. Cras mollis massa vitae diam elementum, ut molestie justo finibus. Phasellus rutrum hendrerit sem, nec faucibus lorem rutrum vitae. Nulla justo leo, facilisis sed interdum pretium, malesuada non odio. Etiam quis imperdiet quam. Donec vitae turpis ac nulla molestie aliquet.

                            Sed id leo nec arcu aliquam auctor vel non lorem. Nulla tincidunt quam eget porta auctor. Etiam imperdiet lacus sit amet ex bibendum iaculis. Sed suscipit lobortis risus, eu placerat eros accumsan quis. Etiam sit amet massa a mauris sodales porttitor vulputate porta turpis. In euismod risus placerat metus interdum suscipit at viverra lectus. Donec enim ligula, gravida ac mollis eget, consequat sit amet quam. Sed luctus maximus ligula. Nam dignissim velit a elit porta efficitur. Donec sapien tellus, tempus hendrerit aliquam sit amet, ultricies id justo. Fusce iaculis orci vitae arcu ultricies, vel dictum purus facilisis. Vivamus tristique, nunc nec fermentum fermentum, augue mauris pretium ipsum, non lobortis neque dui quis mi. Integer eget efficitur velit. Quisque fermentum venenatis risus, in maximus elit. Morbi pulvinar porta turpis sed lacinia.

                            Integer congue lectus quis hendrerit porta. Suspendisse vel lorem urna. Mauris id sapien odio. Praesent hendrerit orci quis felis mollis aliquam id id leo. Cras imperdiet ante ut tellus sagittis, id ultricies nisl viverra. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed vitae volutpat neque, vel eleifend libero.

                            Aenean tempor sapien mauris. Nunc sit amet dui efficitur, posuere massa eget, scelerisque purus. Suspendisse iaculis nunc et felis varius blandit. Pellentesque facilisis vehicula ex. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Pellentesque accumsan ultricies nulla a venenatis. Nam id urna at lorem posuere accumsan. Quisque lobortis fermentum erat eget dignissim. Duis eget consectetur magna. Sed vehicula massa turpis, vel lacinia orci dapibus ac. Etiam lacinia urna sapien, a feugiat justo auctor id. Donec sit amet commodo nisi, non condimentum erat. Nam sollicitudin et urna vitae convallis. Aenean eget gravida turpis, at aliquam lacus. Nullam tincidunt fringilla massa, nec auctor nibh sodales id.</p>
                    </div>';
                    }

                    ?>
                    <div class="card-footer">
                        <a href="#" class="btn btn-primary">Leave a review</a>
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
                                <i><?= $post->title ?></i>
                            </a>
                        </h3>
                    </div>

                    <div class="row justify-content-lg-end">
                        <?php

                        $postImages = $images->getImagesForPost($image->postId);
                        foreach ($postImages as $postImage) {
                            if ($postImage->imageId == $imageId)
                                continue;

                            echo '<div class="p-3 d-flex ' . $otherImagePostsColumns . '">';
                            $user = $users->getById($postImage->uId);
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

            $countryImages = $images->getImagesForCountry($image->countryCodeISO);
            foreach ($countryImages as $countryImage) {
                if ($countryImage->imageId == $imageId)
                    continue;

                echo '<div class="p-3 d-flex ' . $fullWidthImageColumns . '">';
                $user = $users->getById($countryImage->uId);
                createImageCard($countryImage->imageId, $countryImage->path, $countryImage->title, $user->getName());
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Google Maps -->
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOY5BOnwhmmXeVB6eQRUUJuOdHaNMFnug&callback=initMap&libraries=&v=weekly" async></script>
</body>

</html>