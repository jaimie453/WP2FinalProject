<?php

if (isset($_POST['imageId']) && isset($_POST['userId'])) {
    @include_once __DIR__ . "/../database/dao/reviewsDAO.php";
    $reviews = new reviewsDAO();

    $imageId = $_POST['imageId'];
    $userId = $_POST['userId'];
    // double check that userId == session id or logged in user is admin
    // before doing anything
    
    if ($reviews->hasUserReviewedImage($imageId, $userId)) {
        $reviews->deleteReview($imageId, $userId);

        session_start();
        $_SESSION['isAdding'] = false;
        $_SESSION['showReviewMessage'] = true;
    }

    header('Location: ../image.php?id=' . $imageId);
}
