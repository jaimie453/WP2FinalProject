<?php

// if country isnt set, error. else, proceed
$countryId = "";
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $countryId = $_GET['id'];
}

@include_once './database/dao/countriesDAO.php';

// get country
$countries = new countriesDAO();
$country = $countries->getById($countryId);

// if not found, error
if (is_null($country))
    header('Location: error.php');

// find flag image if exists
$fileName = './static/travel-images/flags/' . $countryId . '.png';
$flagPath = null;
if (file_exists($fileName))
    $flagPath = $fileName;

// find country's continent
@include_once './database/dao/continentsDAO.php';
$continents = new continentsDAO();
$continent = $continents->getById($country->continent);

// find country images
@include_once './database/dao/imagesDAO.php';
$images = new imagesDAO();
$countryImages = $images->getImagesForCountry($countryId);

?>


<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Country Details</title>

</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>

    <div class="col container small-container mb-5 pe-4">
        <!-- title -->
        <div class="row mb-3">
            <div class="col d-flex align-items-end">
                <?php

                if (!is_null($flagPath))
                    echo '<img class="flag-img" src="' . $flagPath . '"/>';

                ?>
                <h1 class="d-inline m-0"><?= $country->countryName ?></h1>

            </div>
            <div class="w-100 d-block d-sm-none"></div>
            <div class="col-4 d-flex justify-content-end align-items-end ms-4 mt-3">
                <h3 class="text-muted m-0"><?= $continent->continentName ?></h3>
            </div>
            <hr class="text-secondary my-4">
        </div>

        <!-- info -->
        <div class="row mb-5">
            <?php

            $description = $country->countryDescription;
            if(is_null($description))
                $description = "This country has no description.";

            echo '<div class="col-sm-8 col-12 pe-5">';
            echo '<p class="line-height-2">' . $description . '</p>';
            echo '</div>';

            ?>

            <div class="col-sm-4 col-12 country-info-container">
                <?php
                // print info if exists

                if (!is_null($country->area))
                    echo '<h6>Area:</h6><span>' . number_format($country->area) . ' km<sup>2</sup></span><br>';

                if (!is_null($country->population))
                    echo '<h6>Population:</h6><span>' . number_format($country->population) . '</span><br>';

                if (!is_null($country->capital))
                    echo '<h6>Capital:</h6><span>' . $country->capital . '</span><br>';

                if (!is_null($country->currencyName))
                    echo '<h6>Currency:</h6> <span>' . $country->currencyName . '</span>';

                ?>
            </div>
        </div>

        <!-- images -->
        <?php

        /// if images exist, format and print the images
        if (!is_null($countryImages)) {
            echo '<div class="row justify-content-end">';

            @include_once './utils/displayImage.php';
            @include_once './database/dao/usersDAO.php';
            $users = new usersDAO();

            foreach ($countryImages as $image) {
                echo '<div class="d-flex col-md-4 col-sm-6 col-12 p-3">';

                // get author
                $photographer = $users->getById($image->uId);

                createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());

                echo '</div>';
            }

            echo '</div>';
        }
        ?>
    </div>

    <!-- for ads -->
    </div>

</body>

</html>
