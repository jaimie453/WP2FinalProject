<?php

function createPostListing($postId, $userName, $title, $message, $postTime)
{
    $link = 'post.php?id=' . $postId;
    $message = str_replace("<p>", "", $message);
    $message = str_replace("</p>", "<br>", $message);

    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 my-3">';
    echo '<div class="card image-card">';
    echo '<a class="link-no-color" href="' . $link . '">';

    echo '<div class="card-body">';

    echo '<h5 class="card-title">' . $title . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">';
    echo '<span>By <strong>' . $userName . '</strong></span><br>';
    echo '<span>from ' . date("M-d-Y", strtotime($postTime)) . '</span>';
    echo '</h6>';
    echo '<p class="card-text truncate">' . $message . '</p>';

    echo '</div>';

    echo '</a>';
    echo '</div>';
    echo '</div>';
}

function otherUserPost($postId, $userName, $title, $message, $postTime)
{
    $message = str_replace("<p>", "", $message);
    $message = str_replace("</p>", "<br>", $message);

    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 my-3">';
    echo '<div class="card image-card">';

    echo '<div class="card-body">';

    echo '<h5 class="card-title">' . $title . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">';
    echo '<span>By <strong>' . $userName . '</strong></span><br>';
    echo '<span>from ' . date("M-d-Y", strtotime($postTime)) . '</span>';
    echo '</h6>';
    echo '<p class="card-text truncate">' . $message . '</p>';

    echo '<div class="my-2 d-flex justify-content-evenly">';
    echo '<a class="link-no-color" href="post.php?id=' . $postId. '">';
    echo '<button class="btn btn-primary btn-sm">';
    echo '<i class="fas fa-info"></i> View</button></a>';
    echo '<a class="link-no-color" href="favorites.php?id=' . $postId. '">';
    echo '<button class="btn btn-primary btn-sm">';
    echo '<i class="fas fa-heart"></i> Favorite</button></a>';
    echo '</div>';

    echo '</div>';

    echo '</a>';
    echo '</div>';
    echo '</div>';
}
