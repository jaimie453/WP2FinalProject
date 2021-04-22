<?php

// displays image given its id, the associated file, title, and author name
function createImageCard($id, $fileName, $title, $photographerName)
{
    // initialize vars
    $path = './static/travel-images/medium/' . $fileName;
    $link = 'image.php?id=' . $id;
    // see if favorited
    if(!isset($_SESSION['imageFavs']))
        $isFavorited = false;
    else
        $isFavorited = in_array($id, $_SESSION['imageFavs']);

    echo '<div class="card card-hover flex-grow-1">';
    echo '<a class="link-no-color d-flex flex-column flex-grow-1" href="' . $link . '">';
    echo '<img src="' . $path . '" class="card-img-top travel-card-img" alt="' . $title . '">';
    echo '</a>';
    echo '<div class="card-body d-flex flex-column">';
    echo '<h5 class="card-title">' . $title . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">By ' . $photographerName . '</h6>';

    echo '<div class="d-flex mt-auto">';
    echo '<a href="' . $link . '"class="btn btn-primary flex-grow-1">View Image</a>';
    echo '<form action="utils/modifyFavorites.php" method="post" class="d-flex">';

    // if favoried, show heart. else, dont
    if($isFavorited) {
        echo '<input type="text" value="' . $id . '" name="imageId" hidden />';
        echo '<button type="submit" class="button-no-style ms-3"><i class="fas fa-heart fa-lg text-muted"></i></button>';
    } else {
        echo '<input type="text" value="' . $id . '" name="imageId" hidden />';
        echo '<button type="submit" class="button-no-style ms-3"><i class="far fa-heart fa-lg text-muted"></i></button>';
    }
    echo '</form>';
    echo '</div>';

    echo '</div>';
    echo '</div>';
}

?>
