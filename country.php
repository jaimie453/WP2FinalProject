<?php

$countryId = "";
if (!isset($_GET['id']) || $_GET['id'] == null) {
    header('Location: error.php');
} else {
    $countryId = $_GET['id'];
}

@include_once './database/dao/countriesDAO.php';

$countries = new countriesDAO();
$country = $countries->fetch($countryId)[0];

$fileName = './static/travel-images/flags/' . $countryId . '.png';
$flagPath = null;
if (file_exists($fileName))
    $flagPath = $fileName;

if (is_null($country))
    header('Location: error.php');

@include_once './database/dao/continentsDAO.php';
$continents = new continentsDAO();
$continent = $continents->fetch($country->continent)[0];

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
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container small-container mt-5 mb-5">
        <div class="row mb-5">
            <div class="col-8 d-flex align-items-end">
                <?php

                if (!is_null($flagPath))
                    echo '<img class="flag-img" src="' . $flagPath . '"/>';

                ?>
                <h1 class="d-inline m-0"><?= $country->countryName ?></h1>

            </div>
            <div class="col-4 d-flex justify-content-end align-items-end">
                <h3 class="text-muted m-0"><?= $continent->continentName ?></h3>
            </div>
        </div>
        <div class="row mb-5">

            <?php

            $description = $country->countryDescription;
            if(is_null($description))
                $description = "This country has no description.";

            echo '<div class="col-sm-8 col-12 pe-5">';
            echo '<p>' . $description . '</p>';
            echo '</div>';

            ?>
            <div class="col-sm-4 col-12 country-info-container">
                <?php

                if (!is_null($country->area))
                    echo '<h6>Area:</h6><span>' . $country->area . '</span><br>';

                if (!is_null($country->population))
                    echo '<h6>Population:</h6><span>' . $country->population . '</span><br>';

                if (!is_null($country->capital))
                    echo '<h6>Capital:</h6><span>' . $country->capital . '</span><br>';

                if (!is_null($country->currencyName))
                    echo '<h6>Currency:</h6> <span>' . $country->currencyName . '</span>';

                ?>
            </div>
        </div>

        <?php

        if (!is_null($countryImages)) {
            // echo '<div class="row">';
            // echo '<h3>Images from ' .  $country->countryName . '</h3>';
            // echo '</div>';

            echo '<div class="row justify-content-center">';

            @include_once './utils/createCard.php';
            @include_once './database/dao/usersDAO.php';
            $users = new usersDAO();

            foreach ($countryImages as $image) {
                echo '<div class="d-flex col-xl-3 col-sm-4 col-6 p-3">';

                $photographer = $users->fetch($image->uId)[0];
                createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());

                echo '</div>';
            }

            echo '</div>';
        }
        ?>
    </div>
</body>

</html>