<?php

// registration error
function showRegistrationErrorMessage($attribute)
{
    $message = "Incorrect input for " . $attribute . ".";

    showToastMessage($message);
}

// login error
function showLoginErrorMessage()
{
    $message = "Incorrect credentials.";

    showToastMessage($message);
}

// image in favorites
function showImageMessage($isAdding)
{
    $message = "Removed image from favorites.";
    if ($isAdding)
        $message = "Added image to favorites!";

    showToastMessage($message);

    $_SESSION['showImageMessage'] = false;
}

// post in favorites
function showPostMessage($isAdding)
{
    $message = "Removed post from favorites.";
    if ($isAdding)
        $message = "Added post to favorites!";

    showToastMessage($message);

    $_SESSION['showPostMessage'] = false;
}

// user added/removed a review for an image
function showReviewMessage($isAdding)
{
    $message = "Review removed successfully.";
    if ($isAdding)
        $message = "Your review was added successfully!";

    showToastMessage($message);

    $_SESSION['showReviewMessage'] = false;
}

// shows message in toast popup
function showToastMessage($message)
{
    echo    '<script "text/javascript">
                $(document).ready(function () {
                    var toast = new bootstrap.Toast($(".toast")[0]);
                    var toastText = $("#toast-text")[0];
                    toastText.innerText = "' . $message . '";
                    toast.show();
                });
            </script>';
}

?>
