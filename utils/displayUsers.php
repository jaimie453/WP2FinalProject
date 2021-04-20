<?php

// creates card for user
function createUserListing($uId, $userName, $dateJoined, $dateLastModified, $name)
{
    // initialize link var
    $link = 'user.php?id=' . $uId;

    echo '<div class="col-sm-12 col-md-6 col-lg-4 col-xl-3 my-3">';
    echo '<div class="card">';
    echo '<a class="link-no-color" href="' . $link . '">';

    echo '<div class="card-body">';

    echo '<h5 class="card-title">' . $name . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">';
    echo $userName . '<br>';
    echo '</h6>';

    echo '<p class="card-text">';
    echo 'Member since ' . $dateJoined . '<br>';
    echo 'Last active on ' . $dateLastModified;
    echo '</p>';


    echo '</div>';

    echo '</a>';
    echo '</div>';
    echo '</div>';
}
