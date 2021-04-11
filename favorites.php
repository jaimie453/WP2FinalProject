<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Favorites</title>

    <script type="module" src="./static/js/favorites.js"></script>
</head>

<body class="fixed-mountain-bg">
    <?php include_once 'components/toast.php'; ?>

    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row mb-5">
            <h1>My Favorites</h1>
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="container-fluid mb-5 mb-lg-0">
                    <div class="row" id="fav-image-container">

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
                <div class="container-fluid mb-5 mb-lg-0">
                    <div class="row" id="fav-posts-container">

                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>