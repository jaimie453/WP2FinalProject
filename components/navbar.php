<?php

$home = "index.php";
$about = "about.php";
$advSearch = "search.php";

$browsePosts = "browsePosts.php";
$browseImages = "browseImages.php";
$browseUsers = "browseUsers.php";

$favorites = "favorites.php";
$account = "#";
$register = "#";
$login = "#";

?>
<div class="container-fluid">
  <div class="utility-bar  row px-3 py-1">
    <div class="container-fluid d-flex justify-content-end">
      <div class="text-light">
        <a class="utility-link" href="<?php echo $favorites; ?>">
          <span class="fas fa-star"></span> View Favorites List&nbsp;
        </a>
        <a class="utility-link" href="<?php echo $account; ?>">
          <span class="fas fa-user-circle"></span> My Account&nbsp;
        </a>
        <a class="utility-link" href="<?php echo $register; ?>">
          <span class="fas fa-user-plus"></span> Register&nbsp;
        </a>
        <a class="utility-link" href="<?php echo $login; ?>">
          <span class="fas fa-sign-in-alt"></span> Login
        </a>
      </div>
    </div>
  </div>

  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <a class="navbar-brand" href="<?php echo $home; ?>">Everyone Travels</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
            <li class="nav-item dropdown">
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
                <!--li><hr class="dropdown-divider"></li-->
                <li><a class="dropdown-item" href="<?php echo $browseUsers; ?>">
                    Users
                  </a></li>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>

  <div class="row">
    <nav class="navbar navbar-expand-lg navbar-dark">

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Dropdown
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="#">Action</a>
              <a class="dropdown-item" href="#">Another action</a>
              <div class="dropdown-divider"></div>
              <a class="dropdown-item" href="#">Something else here</a>
            </div>
          </li>
          <li class="nav-item">
            <a class="nav-link disabled" href="#">Disabled</a>
          </li>
        </ul>
        <form class="form-inline my-2 my-lg-0">
          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
          <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
        </form>
      </div>
    </nav>
  </div>
</div>