<?php

// get rid of previous search

unset($_GET['query']);
unset($_GET['type']);
unset($_GET['sortAsc']);
unset($_GET['cityId']);
unset($_GET['countryId']);

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Advanced Search</title>

    <script src="./static/js/search.js"></script>

    <?php include_once 'utils/general.php'; ?>
</head>

<body class="fixed-mountain-bg">
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>
    <?php include_once 'components/ads.php'; ?>

    <main class="col container pt-5 px-5">
        <h2 class="row mb-4">Advanced Search</h2>

        <!-- search selection -->
        <div class="row mb-4">
          <select id="form-select" class="search-dropdown form-select" aria-label="search-select"
              onchange="formSelect();" autocomplete="off">
            <option selected value="post">
              Post
            </option>
            <option value="image" >
              Image
            </option>
          </select>
        </div>

        <div class="row">
          <!-- post search -->
          <form id="post" action=<?= $search ?> method="get">
              <!-- keyword -->
              <label for="postTitle" class="form-label">Title</label>
              <input id="postTitle" class="form-control" name="query">

              <!-- make post search and send -->
              <input type="hidden" name="type" value="post">
              <button class="mt-5 btn btn-primary" type="submit">Submit</button>
          </form>

          <!-- image search -->
          <form id="image" style="display: none;" action=<?= $search ?> method="get">
              <!-- keyword -->
              <label class="form-label" for="imageTitle" >Title</label>
              <input id="imageTitle" class="form-control mb-4" name="query">

              <!-- dropdowns -->
              <div class="row justify-content-start ms-1">
                <!-- city -->
                <select class="col-sm-6 search-dropdown form-select mb-3 me-5"
                    name="cityId">
                  <option selected value="NULL">City</option>
                  <?php
                    // for each city, present option
                    foreach ($relevantCities as $city)
                      createSelectOption($city->geoNameId, $city->asciiName);
                  ?>
                </select>

                <!-- country -->
                <select class="col-sm-6 search-dropdown form-select mb-3"
                    name="countryId">
                  <option selected value="NULL">Country</option>
                  <?php
                    // for each country, present option
                    foreach ($relevantCountries as $country)
                      createSelectOption($country->iso, $country->countryName);
                  ?>
                </select>
              </div>

              <!-- make image search and send -->
              <input type="hidden" name="type" value="image">
              <button class="mt-5 btn btn-primary" type="submit">Submit</button>
          </form>

        </div>
    </main>

    <!-- for ads -->
    </div>

</body>

</html>
