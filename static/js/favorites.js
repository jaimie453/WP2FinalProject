import * as localStorage from './localStorage.js';

$(document).ready(function () {
    loadFavoriteImages();
});

function unFavoriteImage() {
    $(".unfavorite-img").click(function () {
        var toast = new bootstrap.Toast($(".toast")[0]);
        var toastText = $("#toast-text")[0];

        // this is stupid but it works
        // there's a hidden input directly after the button for each image which contains the value of the image's id
        var id = parseInt($(this).next().attr('value'));
        localStorage.removeFromLocalStorage(id, 'favImages');
        loadFavoriteImages();

        toastText.innerText = "Removed image from favorites.";
        toast.show();
    });
}

function loadFavoriteImages() {
    var favImages = localStorage.getFromLocalStorage('favImages');

    // workaround since empty arrays will not be sent in ajax request
    if (favImages.length === 0)
        favImages = [""];

    $.get("utils/createCard.php", { favImages: favImages }, function (response) {
        $("#fav-image-container").html(response);
        unFavoriteImage(); 
    });
}
