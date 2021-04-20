<?php
// updates favorites in session

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(session_status() !== PHP_SESSION_ACTIVE)
        session_start();

    // set flag for showing toast
    $_SESSION['isAdding'] = true;

    // if image, add
    if (isset($_POST['imageId'])) {
        $_SESSION['showImageMessage'] = true;
        $imageId = $_POST['imageId'];

        if (isset($_SESSION['imageFavs'])) {
            print_r($_SESSION['imageFavs']);
            if (in_array($imageId, $_SESSION['imageFavs'])) {
                $imageIndex = array_search($imageId, $_SESSION['imageFavs']);
                unset($_SESSION['imageFavs'][$imageIndex]);
                $_SESSION['isAdding'] = false;
            } else {
                array_push($_SESSION['imageFavs'], $imageId);
            }
        } else {
            $imageFavs = array($imageId);
            $_SESSION['imageFavs'] = $imageFavs;
        }

        print_r($_SESSION['imageFavs']);
    }

    // else if post, add
    else if (isset($_POST['postId'])) {
        $_SESSION['showPostMessage'] = true;
        $postId = $_POST['postId'];

        if (isset($_SESSION['postFavs'])) {
            if (in_array($postId, $_SESSION['postFavs'])) {
                $postIndex = array_search($postId, $_SESSION['postFavs']);
                unset($_SESSION['postFavs'][$postIndex]);
                $_SESSION['isAdding'] = false;
            } else {
                array_push($_SESSION['postFavs'], $postId);
            }
        } else {
            $postFavs = array($postId);
            $_SESSION['postFavs'] = $postFavs;
        }
    }

    // go back
    header('Location: ' . $_SERVER['HTTP_REFERER']);
}
