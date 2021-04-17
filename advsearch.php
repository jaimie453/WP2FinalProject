<?php

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

    <script src="./static/js/map.js"></script>
    <script src="./static/js/search.js"></script>
</head>

<body class="fixed-mountain-bg">
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <main class="container pt-4 px-5">
        <h2 class="row mb-4">Advanced Search</h2>
        <div class="row col-4 col-md-3 col-sm-4 ms-0 mb-4">
          <select id="form-select" class="form-select" aria-label="search-select"
              onchange="formSelect();" autocomplete="off">
            <option selected value="post">
              Post
            </option>
            <option value="image" >
              Image
            </option>
          </select>
        </div>

        <div class="row col-md-8 col-sm-12">
          <form id="post" action=<?= $search ?> method="get">
            <div class="container">
              <label for="postTitle" class="form-label">Title</label>
              <input id="postTitle" class="form-control" name="query">

              <input type="hidden" name="type" value="post">
              <button class="mt-5 btn btn-primary" type="submit">Submit</button>
            </div>
          </form>

          <form id="image" style="display: none;" action=<?= $search ?> method="get">
            <div class="container">
              <label class="form-label" for="imageTitle" >Title</label>
              <input id="imageTitle" class="form-control mb-4" name="query">

              <div class="row justify-content-start ms-1">
                <select class="col-sm-6 search-dropdown form-select mb-3 me-5"
                    name="cityId">
                  <option selected value="NULL">City</option>
                  <?php
                    foreach ($relevantCities as $city) {
                      echo '<option value="' . $city->geoNameId . '">';
                      echo $city->asciiName . '</option>';
                    }
                  ?>
                </select>

                <select class="col-sm-6 search-dropdown form-select mb-3"
                    name="countryId">
                  <option selected value="NULL">Country</option>
                  <?php
                    foreach ($relevantCountries as $country) {
                      echo '<option value="' . $country->iso . '">';
                      echo $country->countryName . '</option>';
                    }
                  ?>
                </select>
              </div>

              <input type="hidden" name="type" value="image">
              <button class="mt-5 btn btn-primary" type="submit">Submit</button>
            </div>
          </form>
        </div>
    </main>

</body>

</html>
