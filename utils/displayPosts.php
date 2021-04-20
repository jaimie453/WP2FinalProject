<?php

// creates card for post with columns
function createPostListing($postId, $userName, $title, $message, $postTime,
                            $columns = "col-sm-12 col-md-6 col-lg-4 col-xl-3")
{
    @include_once './database/dao/imagesDAO.php';
    $images = new imagesDAO();

    // initialize vars
    $link = 'post.php?id=' . $postId;
    $photoPath = $images->getImagesForPost($postId)[0]->path;
    $time = date("M-d-Y", strtotime($postTime));
    // fix faulty messages from db
    $message = str_replace("<p>", "", $message);
    $message = str_replace("</p>", "<br>", $message);

    // check if favorited
    if(!isset($_SESSION['postFavs']))
        $isFavorited = false;
    else
        $isFavorited = in_array($postId, $_SESSION['postFavs']);

    echo '<div class="d-flex ' . $columns . ' my-3">';
    echo '<div class="card card-hover d-flex flex-column">';
    echo '<a class="link-no-color" href="' . $link . '">';

    echo '<img class="post-img card-img"
      src="./static/travel-images/small/' . $photoPath . '"
      alt="">';
    echo '<div class="card-img-overlay py-1">';

    echo '<div class="card-body d-flex flex-column">';

    echo '<h5 class="card-title text-truncate">' . $title . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">';
    echo '<span>By <strong>' . $userName . '</strong></span><br>';
    echo '<span>from ' . $time . '</span>';
    echo '</h6>';

    echo '<p class="card-text truncate">' . $message . '</p>';

    echo '</a>';

    echo '<div class="d-flex mt-auto pt-3">';
    echo '<a href="' . $link . '"class="btn btn-primary flex-grow-1">View Post</a>';
    echo '<form action="utils/modifyFavorites.php" method="post" class="d-flex">';
    // if favorited, show heart. else, dont
    if($isFavorited) {
        echo '<input type="text" value="' . $postId . '" name="postId" hidden />';
        echo '<button class="button-no-style ms-3"><i class="fas fa-heart fa-lg text-muted"></i></button>';
    } else {
        echo '<input type="text" value="' . $postId . '" name="postId" hidden />';
        echo '<button class="button-no-style ms-3"><i class="far fa-heart fa-lg text-muted"></i></button>';
    }
    echo '</form>';
    echo '</div>';

    echo '</div>';

    echo '</div>';
    echo '</div>';
    echo '</div>';
}
