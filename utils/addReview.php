<?php

if (
    isset($_POST['reviewRating']) && isset($_POST['reviewText'])
    && isset($_POST['imageId']) && isset($_POST['userId'])
) {
    @include_once __DIR__ . "/../database/dao/reviewsDAO.php";
    $reviews = new reviewsDAO();

    $imageId = $_POST['imageId'];
    $userId = $_POST['userId'];

    // model needs to be included here otherwise access $_SESSION['user'] won't work
    @include_once __DIR__ . "/../database/models/user.php";
    session_start();

    // double check that userId == session id before doing anything
    if ($userId == $_SESSION['user']->uId && !$reviews->hasUserReviewedImage($imageId, $userId)) {
        $reviews->addReview($imageId, $userId, $_POST['reviewRating'], $_POST['reviewText']);

        session_start();
        $_SESSION['isAdding'] = true;
        $_SESSION['showReviewMessage'] = true;   
    }

    header('Location: ../image.php?id=' . $imageId);
}
