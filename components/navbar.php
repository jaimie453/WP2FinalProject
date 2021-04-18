<?php

$home = "index.php";
$about = "about.php";
$search = "search.php";
$advSearch = "advsearch.php";

$browsePosts = "browse-posts.php";
$browseImages = "browse-images.php";
$browseUsers = "browse-users.php";

$favorites = "favorites.php";
$account = "#";
$register = "#";
$login = "#";

@include_once './database/dao/continentsDAO.php';
$navContinents = new continentsDAO();
$navContinents = $navContinents->getAll();

@include_once './database/dao/countriesDAO.php';
$navCountries = new countriesDAO();
$relevantCountries = $navCountries->getCountriesWithImages();

@include_once './database/dao/citiesDAO.php';
$navCities = new citiesDAO();
$relevantCities = $navCities->getCitiesWithImages();

?>

<script src="./static/js/nav.js"></script>

<div class="container-fluid">
  <div class="utility-bar row px-2 py-1">
    <div class="container-fluid d-flex justify-content-end text-light">
      <a class="utility-link" href="<?php echo $favorites; ?>">
        <span class="fas fa-star"></span> View Favorites List&nbsp;&nbsp;
      </a>
      <a class="utility-link" href="<?php echo $account; ?>">
        <span class="fas fa-user-circle"></span> My Account&nbsp;&nbsp;
      </a>
      <a class="utility-link" href="<?php echo $register; ?>">
        <span class="fas fa-user-plus"></span> Register&nbsp;&nbsp;
      </a>
      <a class="utility-link" href="<?php echo $login; ?>">
        <span class="fas fa-sign-in-alt"></span> Login
      </a>
    </div>
  </div>

  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $home; ?>">Everyone Travels</a>
        <button class="navbar-toggler" type="button"
            data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="<?php echo $home; ?>">
                Home Page
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $about; ?>">
                About Us
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="<?php echo $advSearch; ?>">
                Advanced Search
              </a>
            </li>
            <li id="browseMenu" class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown1" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Browse
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown1">
                <li><a class="dropdown-item" href="<?php echo $browsePosts; ?>">
                    Posts
                  </a></li>
                <li><a class="dropdown-item" href="<?php echo $browseImages; ?>">
                    Images
                  </a></li>
                <li><a class="dropdown-item" href="<?php echo $browseUsers; ?>">
                    Users
                  </a></li>
              </ul>
            </li>
          </ul>

          <form class="nav-search d-flex" action="<?= $search ?>" method="get">
            <input class="form-control" name="query" type="search" placeholder="Search" aria-label="Search">
            <input type="hidden" name="type" value="image">
            <button type="submit">
              <i class="fas fa-search text-muted"></i>
            </button>
          </form>
        </div>
      </div>
    </nav>
  </div>

  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-dark pt-0">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Continents
              </a>
              <ul id="continentsMenu" class="dropdown-menu" aria-labelledby="navbarDropdown2">
                <?php
                  foreach ($navContinents as $navContinent) {
                    echo '<li><a class="dropdown-item"
                      href="search.php?type=image&continentId='
                      . $navContinent->continentCode . '">';
                    echo $navContinent->continentName . '</a></li>';
                  }
                ?>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Countries
              </a>
              <ul id="countriesMenu" class="dropdown-menu" aria-labelledby="navbarDropdown3">
                <?php
                  foreach ($relevantCountries as $navCountry) {
                    echo '<li><a class="dropdown-item"
                      href="country.php?id='
                      . $navCountry->iso . '">';
                    echo $navCountry->countryName . '</a></li>';
                  }
                ?>
              </ul>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Cities
              </a>
              <ul id="citiesMenu" class="dropdown-menu dropdown-columns" aria-labelledby="navbarDropdown4">
                <?php
                  $item = 0;
                  foreach ($relevantCities as $navCity) {


                    echo '<li><a class="dropdown-item" href="city.php?id='
                      . $navCity->geoNameId . '">';
                    echo $navCity->asciiName . '</a></li>';

                    $item = $item + 1;
                  }
                ?>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</div>
