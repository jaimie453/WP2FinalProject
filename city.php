<?php

// if city isnt set, error. else, proceed
$cityId = "";
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $cityId = $_GET['id'];
}

@include_once './database/dao/citiesDAO.php';

// get city
$cities = new citiesDAO();
$city = $cities->getById($cityId);

// if not found, error
if (is_null($city))
    header('Location: error.php');

// get city's country
@include_once './database/dao/countriesDAO.php';
$countries = new countriesDAO();
$country = $countries->getById($city->countryCodeISO);

// get city images
@include_once './database/dao/imagesDAO.php';
$images = new imagesDAO();
$cityImages = $images->getImagesForCity($cityId);

// adjust columns based on city image results
$cityDescriptionColumns = "col-12 col-lg-6";
if(is_null($cityImages))
    $cityDescriptionColumns = "col-8";

// print images according to columns
function listImages($images, $columns)
{
    echo '<div class="row justify-content-center">';

    @include_once './utils/displayImage.php';
    @include_once './database/dao/usersDAO.php';
    $users = new usersDAO();

    foreach ($images as $image) {
        echo '<div class="d-flex ' . $columns . ' p-3">';

        // get author
        $photographer = $users->getById($image->uId);

        createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());

        echo '</div>';
    }

    echo '</div>';
}

?>


<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>City Details</title>

    <script src="./static/js/map.js"></script>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>


    <div class="col container mb-5 pe-4">
        <div class="row justify-content-center">
            <!-- info -->
            <div class="<?= $cityDescriptionColumns ?>">
                <div class="container-fluid">
                    <!-- title -->
                    <div class="row mb-3">
                        <div class="col d-flex align-items-end">
                            <h1 class="d-inline m-0"><?= $city->asciiName ?></h1>
                        </div>
                        <div class="w-100 d-block d-sm-none"></div>
                        <div class="col-4 d-flex justify-content-end align-items-end ms-5">
                            <a href="country.php?id=<?= $country->iso ?>" class="text-end">
                                <h3 class="m-0"><?= $country->countryName ?></h3>
                            </a>
                        </div>
                    </div>

                    <!-- subtitle -->
                    <div class="row mb-3">
                        <div class="col text-muted">
                            <?php

                            // if not null, print info
                            if (!is_null($city->population))
                                echo '<b>Population: </b>' . number_format($city->population);
                            echo '<div class="w-100 d-block d-sm-none"></div>';
                            if (!is_null($city->elevation))
                                echo '<span class="float-sm-end"><b>Elevation: </b>' . number_format($city->elevation) . ' m</span>';

                            ?>
                        </div>
                    </div>

                    <!-- Container for Google Maps -->
                    <!-- data-map attributes are needed to pass data from PHP to JS -->
                    <!-- In the DB, no longitude/latitudes for cities are null, so the values are assumed to be valid -->
                    <div class="row mb-3 p-3 p-md-5">
                        <div id="map" data-map-longitude="<?= $city->longitude ?>" data-map-latitude="<?= $city->latitude ?>"></div>
                    </div>
                </div>
            </div>

            <?php

            // if images exist, format and print the images
            if (!is_null($cityImages)) {
                echo '<div class="col-lg-6 col-12">';
                echo '<div class="container-fluid px-md-5">';

                $columns = "col-xl-6 col-lg-12 col-md-6 col-12";
                listImages($cityImages, $columns);

                echo '</div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <!-- Google Maps -->
    <!-- Async script executes immediately and must be after any DOM elements used in callback. -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAOY5BOnwhmmXeVB6eQRUUJuOdHaNMFnug&callback=initMap&libraries=&v=weekly" async></script>

    <!-- for ads -->
    </div>
    </div>

</body>

</html>
