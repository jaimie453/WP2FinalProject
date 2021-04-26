<?php

@include_once './database/dao/imagesDAO.php';
@include_once './utils/displayImage.php';

// get images
$images = new imagesDAO();
$allImages = $images->getAll();

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Browse Images</title>

    <script type="module" src='./static/js/image.js'></script>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/navbar.php'; ?>
    <?php include_once 'components/ads.php'; ?>

    <div class="col mb-5 mx-4">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="mb-0">All Images</h1>
            </div>

            <!-- filters -->
            <div class="col-12 col-lg-6 d-flex mt-3 mt-xl-0 align-items-center justify-content-lg-end">
                <form action="browse-images.php" method="post" class="d-flex text-end">
                    <?php @include_once './utils/general.php'; ?>

                    <!-- continents -->
                    <select class="form-select d-inline" aria-label="Default select example" name="continentCode">
                        <option selected value="All">All Continents</option>
                        <?php

                        @include_once './database/dao/continentsDAO.php';
                        $continents = new continentsDAO();

                        // print continents
                        $allContinents = $continents->getAll();
                        foreach($allContinents as $continent)
                            createSelectOption($continent->continentCode, $continent->continentName);

                        ?>
                    </select>

                    <!-- countries -->
                    <select class="form-select d-inline ms-2" aria-label="Default select example" name="countryCode">
                        <option selected value="All">All Countries</option>
                        <?php

                        @include_once './database/dao/countriesDAO.php';
                        $countries = new countriesDAO();

                        // print countries
                        $allCountries = $countries->getAll();
                        foreach($allCountries as $country)
                            createSelectOption($country->iso, $country->countryName);

                        ?>
                    </select>

                    <button id="image-filter-button" type="submit" class="btn btn-primary ms-2">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
              </div>
              <hr class="text-secondary my-4">
            </div>

            <!-- images -->
            <div class="row justify-content-center">
                <?php

                // get filter if set
                $continentCode = null;
                $countryCode = null;
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    if($_POST['continentCode'] != "All")
                        $continentCode = $_POST['continentCode'];
                    if($_POST['countryCode'] != "All")
                        $countryCode = $_POST['countryCode'];
                }

                @include_once './database/dao/usersDAO.php';
                $users = new usersDAO();

                $total = 0;
                foreach ($allImages as $image) {
                    // if not according to filter, skip
                    if(!is_null($continentCode) && $image->continentCode != $continentCode)
                        continue;
                    if(!is_null($countryCode) && $image->countryCodeISO != $countryCode)
                        continue;

                    echo '<div class="d-flex col-xl-3 col-lg-4 col-md-6 col-12 p-3">';

                    // get author
                    $photographer = $users->getById($image->uId);

                    createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());
                    $total++;

                    echo '</div>';
                }

                if($total == 0)
                    echo "<div class='col d-flex justify-content-center align-items-center my-5'><h4>No images found.</h4></div>";

                ?>
            </div>
            <hr class="text-secondary my-4">
        </div>
    </div>

    <!-- for ads -->
    </div>
</body>

</html>
