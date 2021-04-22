<?php

if (isset($_POST['reviewRating']) && isset($_POST['reviewText']) && isset($_POST['imageId'])) {
    // add check if review has already been added
    @include_once __DIR__ . "/../database/dao/reviewsDAO.php";
    $reviews = new reviewsDAO();

    $reviews->addReview($_POST['imageId'], 1, $_POST['reviewRating'], $_POST['reviewText']);

    session_start();
    $_SESSION['isAdding'] = true;
    $_SESSION['showReviewMessage'] = true;

    header('Location: ../image.php?id=' . $_POST['imageId']);
}