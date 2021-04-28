<?php
  // link variables (allow for easy edit and recall)

  $home = "index.php";
  $about = "about.php";
  $search = "search.php";
  $advSearch = "advsearch.php";

  $browsePosts = "browse-posts.php";
  $browseImages = "browse-images.php";
  $browseUsers = "browse-users.php";

  $favorites = "favorites.php";
  $account = "#";

  $modifyUsers = "utils/adminModifyGate.php";


  // get continents, countries, and cities for nav

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

<header>
  <div class="container-fluid">
    <!-- Utilities, 1st Row -->
    <div class="utility-bar row px-2 py-1 text-nowrap">
      <!-- Logged in User -->
      <div class="col">
        <span><?php
          if(isset($_SESSION['user']))
            echo 'User: <strong>' . $_SESSION['user']->userName . '</strong>';
        ?>&nbsp;&nbsp;</span>
        <!-- Admin Modify Users -->
        <?php
          if (isset($_SESSION['user'])
              && $_SESSION['user']->isAdmin()) {
            echo  '<a class="utility-link" href="' . $modifyUsers . '">
                    <span class="fas fa-cog"></span> Modify Users&nbsp;&nbsp;
                  </a>';
          }
        ?>
      </div>
      <!-- main utilities -->
      <div class="col d-flex justify-content-end">
        <a class="utility-link" href="<?= $favorites ?>">
          <span class="fas fa-star"></span> View Favorites List&nbsp;&nbsp;
        </a>
        <!-- account if logged in -->
        <?php
          if(isset($_SESSION['user']))
            echo  '<a class="utility-link" href="' . $account . '">
                    <span class="fas fa-user-circle"></span> My Account&nbsp;&nbsp;
                  </a>';
        ?>
        <!-- register if logged out -->
        <?php
          if(!isset($_SESSION['user']))
            echo  '<a class="utility-link" href="" type="button"
                      data-bs-toggle="modal" data-bs-target="#registerPortal">
                    <span class="fas fa-user-plus"></span> Register&nbsp;&nbsp;
                  </a>';
        ?>
        <a class="utility-link" type="button"
          <?php
          // logout
          if (isset($_SESSION['user'])) {
            echo '
            href="./utils/logout.php">
              <span class="fas fa-sign-out-alt"></span> Logout
            </a>
            ';
          }
          // login
          else {
            echo '
            href="" data-bs-toggle="modal" data-bs-target="#loginPortal">
              <span class="fas fa-sign-in-alt"></span> Login
            </a>
            ';
          }
          ?>
      </div>
    </div>

    <!-- Main Nav, 2nd Row -->
    <div class="row">
      <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
          <a class="navbar-brand" href="<?php echo $home; ?>">Everyone Travels</a>
          <!-- toggles 2nd and 3rd rows -->
          <button class="navbar-toggler" type="button"
              data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <!-- items -->
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
            <!-- search -->
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

    <!-- Location Pages Sub Nav, 3rd Row -->
    <div class="row">
      <nav class="navbar navbar-expand-lg navbar-dark pt-0">
        <div class="container-fluid">
          <!-- will collapse from 2nd row nav toggle -->
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
              <!-- items -->
              <!-- continents -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown2" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Continents
                </a>
                <ul id="continentsMenu" class="dropdown-menu" aria-labelledby="navbarDropdown2">
                  <?php
                    // for each continent, print search link
                    foreach ($navContinents as $navContinent) {
                      echo '<li><a class="dropdown-item"
                        href="search.php?type=image&continentId='
                        . $navContinent->continentCode . '">';
                      echo $navContinent->continentName . '</a></li>';
                    }
                  ?>
                </ul>
              </li>

              <!-- countries -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown3" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Countries
                </a>
                <ul id="countriesMenu" class="dropdown-menu" aria-labelledby="navbarDropdown3">
                  <?php
                    // for each country, print link
                    foreach ($relevantCountries as $navCountry) {
                      echo '<li><a class="dropdown-item"
                        href="country.php?id='
                        . $navCountry->iso . '">';
                      echo $navCountry->countryName . '</a></li>';
                    }
                  ?>
                </ul>
              </li>

              <!-- cities -->
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown4" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  Cities
                </a>
                <ul id="citiesMenu" class="dropdown-menu dropdown-columns" aria-labelledby="navbarDropdown4">
                  <?php
                    // for each city, print link
                    foreach ($relevantCities as $navCity) {
                      echo '<li><a class="dropdown-item" href="city.php?id='
                        . $navCity->geoNameId . '">';
                      echo $navCity->asciiName . '</a></li>';
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
</header>
