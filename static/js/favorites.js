import * as localStorage from './localStorage.js';

$(document).ready(function () {
    loadDocument();
    loadFavoriteImages();
    loadFavoritePosts();
});

function loadDocument() {
    var toast = new bootstrap.Toast($(".toast")[0]);
    var toastText = $("#toast-text")[0];

    $(".unfavorite-img").click(function () {
        // this is stupid but it works
        // there's a hidden input directly after the button for each image which contains the value of the image's id
        var id = parseInt($(this).next().attr('value'));
        localStorage.removeFromLocalStorage(id, 'favImages');
        loadFavoriteImages();

        toastText.innerText = "Removed image from favorites.";
        toast.show();
    });

    $(".unfavorite-post").click(function () {
        // this is stupid but it works
        // there's a hidden input directly after the button for each image which contains the value of the image's id
        var id = parseInt($(this).next().attr('value'));
        localStorage.removeFromLocalStorage(id, 'favPosts');
        loadFavoritePosts();

        toastText.innerText = "Removed post from favorites.";
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
        loadDocument(); 
    });
}

function loadFavoritePosts() {
    var favPosts = localStorage.getFromLocalStorage('favPosts');

    // workaround since empty arrays will not be sent in ajax request
    if (favPosts.length === 0)
        favPosts = [""];

    $.get("utils/displayPosts.php", { favPosts: favPosts }, function (response) {
        $("#fav-posts-container").html(response);
        loadDocument(); 
    });
}
