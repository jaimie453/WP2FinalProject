<?php

if (isset($_POST['imageId']) && isset($_POST['userId'])) {
    @include_once __DIR__ . "/../database/dao/reviewsDAO.php";
    $reviews = new reviewsDAO();

    $imageId = $_POST['imageId'];
    $userId = $_POST['userId'];

    // model needs to be included here otherwise access $_SESSION['user'] won't work
    @include_once __DIR__ . "/../database/models/user.php";
    session_start();

    // double check that we are deleting the logged in users review or that the user is an admin
    if ($reviews->hasUserReviewedImage($imageId, $userId) && ($userId == $_SESSION['user']->uId || $_SESSION['user']->state == 2)) {
        $reviews->deleteReview($imageId, $userId);

        session_start();
        $_SESSION['isAdding'] = false;
        $_SESSION['showReviewMessage'] = true;
    }

    header('Location: ../image.php?id=' . $imageId);
}
