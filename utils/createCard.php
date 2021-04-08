<?php

function createImageCard($id, $fileName, $title, $photographer)
{
    $path = './static/travel-images/square-medium/' . $fileName;
    $link = 'image.php?id=' . $id;

    echo '<div class="card image-card flex-grow-1">';
    echo '<a class="link-no-color" image-card-link" href="' . $link . '">';
    echo '<img src="' . $path . '" class="card-img-top" alt="' . $title . '">';
    echo '<div class="card-body">';
    echo '<h5 class="card-title">' . $title . '</h5>';
    echo '<h6 class="card-subtitle mb-2 text-muted">By ' . $photographer . '</h6>';
    echo '</div>';
    echo '</a>';
    echo '</div>';
}