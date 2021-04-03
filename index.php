<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Home</title>

    <script>
        $(document).ready(function() {
            var isTopImagesActive = false;
            var isNewImagesActive = false;
            var imagesContainer = $("#images-container");
            var topImagesList = $("#top-images-list");
            var newImagesList = $("#new-images-list")

            $("#top-images-button").click(function() {
                isTopImagesActive = !isTopImagesActive;
                isNewImagesActive = false;
                checkImagesListGroup();
                checkImagesContainer();
            });

            $("#new-images-button").click(function() {
                isNewImagesActive = !isNewImagesActive;
                isTopImagesActive = false;
                checkImagesListGroup();
                checkImagesContainer();
            });

            function checkImagesContainer() {
                if (isTopImagesActive || isNewImagesActive)
                    imagesContainer.slideDown();
                else
                    imagesContainer.slideUp();
            }

            $(".images-group-close").click(function() {
                isTopImagesActive = false;
                isNewImagesActive = false;
                imagesContainer.slideUp();
            });

            function checkImagesListGroup() {
                if (isTopImagesActive) {
                    newImagesList.hide();
                    topImagesList.show();
                } else if (isNewImagesActive) {
                    topImagesList.hide();
                    newImagesList.show();
                }
            }


        });
    </script>
</head>

<body>
    <header style="background-color: rgba(0, 0, 0, .75);">
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container-fluid mt-2 position-relative" style="z-index: 1;">
        <div class="row">
            <div class="col text-end">
                <button class="btn btn-primary me-1" id="top-images-button" type="button">
                    Top Images
                </button>
                <button class="btn btn-primary" id="new-images-button" type="button">
                    New Images
                </button>
            </div>
        </div>
        <div class="row mt-3 justify-content-end" id="images-container" style="display: none;">
            <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xl-4">
                <div class="card card-body" id="top-images-list" style="display: none;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="list-group-title">Top Images</span>
                            <button class="images-group-close">Close</button>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                    </ul>
                </div>
                <div class="card card-body" id="new-images-list" style="display: none;">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">
                            <span class="list-group-title">New Images</span>
                            <button class="images-group-close">Close</button>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                        <li class="list-group-item">
                            <a>Edworthy Park</a>
                            <span class="float-end">4.5 / 5</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div id="home-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#home-carousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#home-carousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#home-carousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="static/travel-images/carousel/city.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <a>
                        <h5>Browse Cities/Countries</h5>
                    </a>
                    <p>Image courtesy of <a href="https://www.pexels.com/photo/reflection-of-buildings-on-body-of-water-1121782/">Pawel L.</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="static/travel-images/carousel/road.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <a>
                        <h5>Browse Posts</h5>
                    </a>
                    <p>Image courtesy of <a href="https://www.pexels.com/photo/empty-road-along-the-mountain-2739013/">Mads Thomsen.</a></p>
                </div>
            </div>
            <div class="carousel-item">
                <img src="static/travel-images/carousel/mountain.jpg" class="d-block w-100" alt="...">
                <div class="carousel-caption d-block">
                    <a>
                        <h5>Browse Images</h5>
                    </a>
                    <p>Image courtesy of <a href="https://www.pexels.com/photo/white-and-brown-mountain-under-gray-clouds-5409751/">Brady Knoll.</a></p>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#home-carousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#home-carousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</body>

</html>