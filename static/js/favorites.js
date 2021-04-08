import * as localStorage from './localStorage.js';

$(document).ready(function () {
    var toast = new bootstrap.Toast($(".toast")[0]);
    var toastText = $("#toast-text")[0];
    loadFavoriteImages(toast, toastText);

    function unFavoriteImage(imageId) {
        localStorage.removeFromLocalStorage(imageId, 'favImages');
        loadFavoriteImages();

        toastText.innerText = "Removed image from favorites.";
        toast.show();
    }
});



function loadFavoriteImages(toast, toastText) {
    var favImages = localStorage.getFromLocalStorage('favImages');

    // workaround since empty arrays will not be sent in ajax request
    if (favImages.length === 0)
        favImages = [""];

    $.get("utils/createCard.php", { favImages: favImages }, function (response) {
        $("#fav-image-container").html(response);
    });
}
