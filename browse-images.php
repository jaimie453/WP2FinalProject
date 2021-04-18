<?php

@include_once './database/dao/imagesDAO.php';
@include_once './utils/displayImage.php';

$images = new imagesDAO();
$allImages = $images->getAll();

function createSelectOption($value, $name) {
    echo '<option value="' . $value . '">' . $name . '</option>';
}

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Browse Images</title>

    <script type="module" src='./static/js/image.js'></script>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/toast.php'; ?>

    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="my-5 mx-4">
        <div class="container">
          <div class="row">
            <div class="col-12 col-lg-6">
                <h1 class="mb-0">All Images</h1>
            </div>
            <div class="col-12 col-lg-6 d-flex mt-3 mt-xl-0 align-items-center justify-content-lg-end">
                <form action="browse-images.php" method="post" class="d-flex text-end">
                    <select class="form-select d-inline" aria-label="Default select example" name="continentCode">
                        <option selected value="All">All Continents</option>
                        <?php

                        @include_once './database/dao/continentsDAO.php';
                        $continents = new continentsDAO();

                        $allContinents = $continents->getAll();
                        foreach($allContinents as $continent)
                            createSelectOption($continent->continentCode, $continent->continentName);

                        ?>
                    </select>
                    <select class="form-select d-inline ms-2" aria-label="Default select example" name="countryCode">
                        <option selected value="All">All Countries</option>
                        <?php

                        @include_once './database/dao/countriesDAO.php';
                        $countries = new countriesDAO();

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
            <div class="row justify-content-center">
                <?php

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
                    if(!is_null($continentCode) && $image->continentCode != $continentCode)
                        continue;

                    if(!is_null($countryCode) && $image->countryCodeISO != $countryCode)
                        continue;

                    echo '<div class="d-flex col-xl-2 col-md-3 col-sm-4 col-6 p-3">';

                    $photographer = $users->getById($image->uId);
                    createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());
                    $total++;

                    echo '</div>';
                }

                if($total == 0)
                    echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

                ?>
            </div>
            <hr class="text-secondary my-4">
        </div>
        <div class="row justify-content-center">
            <?php

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
                if(!is_null($continentCode) && $image->continentCode != $continentCode)
                    continue;
                    
                if(!is_null($countryCode) && $image->countryCodeISO != $countryCode)
                    continue;
                
                echo '<div class="d-flex col-xl-3 col-md-4 col-6 p-3">';

                $photographer = $users->getById($image->uId);
                createImageCard($image->imageId, $image->path, $image->title, $photographer->getName());
                $total++;

                echo '</div>';
            }

            if($total == 0)
                echo "<div class='col d-flex justify-content-center align-items-center mt-5'><h4>No images found.</h4></div>";

            ?>
        </div>
    </div>
</body>

</html>
