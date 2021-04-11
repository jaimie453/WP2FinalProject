<?php

// needed for ajax request on favorites.php
if (isset($_GET['favPosts'])) {
    $favPosts = $_GET['favPosts'];

    // empty array contains [""] in ajax request
    if ($favPosts[0] == "") {
        echo '<h3>You haven\'t favorited any posts yet.</h3>';
    } else {
        @include_once '../database/dao/usersDAO.php';
        @include_once '../database/dao/postsDAO.php';
        $users = new usersDAO();
        $posts = new postsDAO();

        foreach ($favPosts as $postId) {
            $post = $posts->getById($postId);
            $author = $users->getById($post->uId);

            createPostListing(
                $post->postId,
                $author->getName(),
                $post->title,
                $post->message,
                $post->postTime,
                $showUnfavoriteButton = true,
                $columns = "col-lg-6 col-md-4 col-sm-6 col-12"
            );
        }
    }
}

function createPostListing($postId, $userName, $title, $message, $postTime, 
                            $showUnfavoriteButton = false, $columns = "col-sm-12 col-md-6 col-lg-4 col-xl-3")
{
    $link = 'post.php?id=' . $postId;
    $message = str_replace("<p>", "", $message);
    $message = str_replace("</p>", "<br>", $message);

    echo '<div class="' . $columns . ' my-3">';
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

    if ($showUnfavoriteButton) {
        echo '<button class="btn btn-secondary mt-auto unfavorite-post m-3">Unfavorite</button>';
        echo '<input type="" value="' . $postId . '" hidden />';
    }
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
    echo '<a class="link-no-color" href="post.php?id=' . $postId . '">';
    echo '<button class="btn btn-primary btn-sm">';
    echo '<i class="fas fa-info"></i> View</button></a>';
    echo '<a class="link-no-color" href="favorites.php?id=' . $postId . '">';
    echo '<button class="btn btn-primary btn-sm">';
    echo '<i class="fas fa-heart"></i> Favorite</button></a>';
    echo '</div>';

    echo '</div>';

    echo '</a>';
    echo '</div>';
    echo '</div>';
}
