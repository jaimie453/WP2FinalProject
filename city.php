<?php

$cityId = "";
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $cityId = $_GET['id'];
}

@include_once './database/dao/citiesDAO.php';

$cities = new citiesDAO();
$city = $cities->fetch($cityId);

if (is_null($city))
    header('Location: error.php');

@include_once './database/dao/countriesDAO.php';
$countries = new countriesDAO();
$country = $countries->fetch($city->countryCodeISO);

@include_once './database/dao/imagesDAO.php';
$images = new imagesDAO();
$cityImages = $images->fetch($city->geoNameId, 'CityCode');

$cityDescriptionColumns = "col-12 col-lg-6";
if(is_null($cityImages))
    $cityDescriptionColumns = "col-8";

function listImages($images, $columns)
{
    // echo '<div class="row">';
    // echo '<h3>Images from ' .  $city->asciiName . ', ' . $country->countryName . '</h3>';
    // echo '</div>';

    echo '<div class="row">';

    @include_once './utils/createCard.php';
    @include_once './database/dao/usersDAO.php';
    $users = new usersDAO();

    foreach ($images as $image) {
        echo '<div class="' . $columns . ' p-3">';

        $photographer = $users->fetch($image->uId);
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
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="<?= $cityDescriptionColumns ?>">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="col d-flex align-items-end">
                            <h1 class="d-inline m-0"><?= $city->asciiName ?></h1>
                        </div>
                        <div class="col d-flex justify-content-end align-items-end">
                            <a href="country.php?id=<?= $country->iso ?>">
                                <h3 class="text-muted m-0"><?= $country->countryName ?></h3>
                            </a>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col text-muted">
                            <?php

                            if (!is_null($city->population))
                                echo '<b>Population: </b>' . $city->population;
                            if (!is_null($city->elevation))
                                echo '<span class="float-end"><b>Elevation: </b>' . $city->elevation . ' m</span>';

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

            if (!is_null($cityImages)) {
                // column format for large screen sizes
                echo '<div class="d-none d-lg-block col-6">';
                echo '<div class="container-fluid">';

                $columns = "col-xl-4 col-lg-6";
                listImages($cityImages, $columns);

                echo '</div>';
                echo '</div>';

                // column format for small screen sizes
                echo '<div class="d-block d-lg-none col-12">';
                echo '<div class="container-fluid">';

                $columns = "col-6 col-md-4";
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
</body>

</html>