<?php

// registration error
function showRegistrationErrorMessage($attribute)
{
    $message = "Incorrect input for " . $attribute . ".";

    echo    '<script type="text/javascript">
                $(document).ready(function () {
                    var toast = new bootstrap.Toast($(".toast")[0]);
                    var toastText = $("#toast-text")[0];
                    toastText.innerText = "' . $message . '";
                    toast.show();
                });
            </script>';
}

// login error
function showLoginErrorMessage()
{
    $message = "Incorrect credentials.";

    echo    '<script type="text/javascript">
                $(document).ready(function () {
                    var toast = new bootstrap.Toast($(".toast")[0]);
                    var toastText = $("#toast-text")[0];
                    toastText.innerText = "' . $message . '";
                    toast.show();
                });
            </script>';
}

// image in favorites
function showImageMessage($isAdding)
{
    $message = "Removed image from favorites.";
    if ($isAdding)
        $message = "Added image to favorites!";

    echo    '<script type="text/javascript">
                $(document).ready(function () {
                    var toast = new bootstrap.Toast($(".toast")[0]);
                    var toastText = $("#toast-text")[0];
                    toastText.innerText = "' . $message . '";
                    toast.show();
                });
            </script>';

    $_SESSION['showImageMessage'] = false;
}

// post in favorites
function showPostMessage($isAdding)
{
    $message = "Removed post from favorites.";
    if ($isAdding)
        $message = "Added post to favorites!";

    echo    '<script "text/javascript">
                $(document).ready(function () {
                    var toast = new bootstrap.Toast($(".toast")[0]);
                    var toastText = $("#toast-text")[0];
                    toastText.innerText = "' . $message . '";
                    toast.show();
                });
            </script>';

    $_SESSION['showPostMessage'] = false;
}

?>
