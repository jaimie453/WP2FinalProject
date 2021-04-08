<?php

// needed for ajax request on favorites.php
if (isset($_GET['favImages'])) {
    $favImages = $_GET['favImages'];

    // empty array contains [""] in ajax request
    if($favImages[0] == "") {
        echo '<h3>You haven\'t favorited any images yet.</h3>';
    } else {
        @include_once __DIR__ . '/../database/dao/usersDAO.php';
        @include_once __DIR__ . '/../database/dao/imagesDAO.php';
        $users = new usersDAO();
        $images = new imagesDAO();

        foreach($favImages as $imageId) {
            $favImage = $images->getById($imageId);
            echo '<div class="d-flex p-3 col-xxl-4 col-lg-6 col-md-4 col-sm-6 col-12">';

            $photographer = $users->getById($favImage->uId);
            createImageCard($favImage->imageId, $favImage->path, $favImage->title, $photographer->getName(), true);

            echo '</div>';
        }
    }
}

function createImageCard($id, $fileName, $title, $photographerName, $showUnfavoriteButton = false)
{
    $path = './static/travel-images/square-medium/' . $fileName;
    $link = 'image.php?id=' . $id;

    echo '<div class="card image-card flex-grow-1">';
    echo '<a class="link-no-color d-flex flex-column flex-grow-1" href="' . $link . '">';
    echo '<img src="' . $path . '" class="card-img-top" alt="' . $title . '">';
    echo '</a>';
    echo '<div class="card-body d-flex flex-column">';
    echo '<h5 class="card-title">' . $title . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">By ' . $photographerName . '</h6>';
    if($showUnfavoriteButton) {  
        echo '<button class="btn btn-secondary mt-auto unfavorite-img">Unfavorite</button>';
        echo '<input type="" value="' . $id . '" hidden />';
    } else
        echo '<a href="' . $link . '"class="btn btn-primary mt-auto">View Post</a>';
    echo '</div>';
    echo '</div>';
}