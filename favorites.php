<?php

@include_once './database/dao/imagesDAO.php';
@include_once './utils/createCard.php';

$images = new imagesDAO();
$allImages = $images->getAll();

?>

<!doctype html>
<html lang="en">

<head>
    <?php include 'components/head.php'; ?>

    <title>Favorites</title>

</head>

<body class="fixed-mountain-bg">
    <header>
        <?php include_once 'components/navbar.php'; ?>
    </header>

    <div class="container mt-5 mb-5">
        <div class="row mb-5">
            <h1>My Favorites</h1>  
        </div>
        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="container-fluid">
                    <div class="row">
                        <h3>Favorite Images</h3>    
                    </div>
                    <div class="row">

                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-6">
            <div class="container-fluid">
                    <div class="row">
                        <h3>Favorite Posts</h3>
                    </div>
                    <div class="row">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>